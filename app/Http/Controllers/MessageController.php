<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMessageMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client; // If using Twilio, otherwise use your preferred SMS service

class MessageController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'recipientType' => 'required|in:all,selected',
            'subject' => 'required|string|max:255',
            'message' => 'required_unless:msgType,voice,video|string',
            'msgType' => 'required|in:text,voice,video',
            'voice' => 'nullable|file|mimes:mp3,wav,m4a',
            'video' => 'nullable|file|mimes:mp4,avi,mov',
            'selectedMembers' => 'nullable|array',
        ]);

        try {
            // Determine recipients
            $recipients = $this->determineRecipients($validated);

            // Handle file attachment
            $attachmentPath = $this->handleAttachment($request, $validated['msgType']);

            // Send emails
            $this->sendEmails($recipients, $validated, $attachmentPath);

            return response()->json([
                'success' => true, 
                'message' => 'Emails sent successfully!',
                'recipients_count' => count($recipients)
            ], 200);

        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Failed to send emails: ' . $e->getMessage()
            ], 500);
        }
    }

    private function determineRecipients(array $validated)
    {
        if ($validated['recipientType'] === 'all') {
            return Member::all();
        }

        return Member::whereIn('id', $validated['selectedMembers'] ?? [])->get();
    }

    private function handleAttachment(Request $request, string $messageType)
    {
        $attachmentPath = null;
        
        if ($request->hasFile('voice')) {
            $attachmentPath = $request->file('voice')->store('attachments/voice', 'public');
        } elseif ($request->hasFile('video')) {
            $attachmentPath = $request->file('video')->store('attachments/video', 'public');
        }

        return $attachmentPath ? storage_path('app/public/' . $attachmentPath) : null;
    }

    private function sendEmails($recipients, array $validated, ?string $attachmentPath)
    {
        foreach ($recipients as $member) {
            Mail::to($member->email)->send(
                new SendMessageMail(
                    $validated['message'], 
                    'Church', 
                    $validated['subject'], 
                    $validated['msgType'], 
                    $attachmentPath
                )
            );
        }
    }


    public function sendSMS(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string|max:160',
                'recipients' => 'required|array',
                'recipients.*' => 'exists:members,id'
            ]);
    
            $recipients = Member::whereIn('id', $request->input('recipients'))->get();
            $successCount = 0;
            $failedNumbers = [];
    
            foreach ($recipients as $member) {
                try {
                    // Actual SMS sending logic
                    $this->sendTwilioSMS($member->phone_number, $request->input('message'));
                    $successCount++;
                } catch (\Exception $e) {
                    $failedNumbers[] = $member->phone_number;
                    \Log::error('SMS sending failed for ' . $member->phone_number . ': ' . $e->getMessage());
                }
            }
    
            return response()->json([
                'success' => true,
                'message' => "SMS sent to {$successCount} recipients",
                'failed_numbers' => $failedNumbers,
                'recipients_count' => $successCount
            ]);
        } catch (\Exception $e) {
            \Log::error('SMS sending error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'SMS sending failed: ' . $e->getMessage()
            ], 500);
        }
    }
    private function sendTwilioSMS($phoneNumber, $message)
{
    try {
        $formattedNumber = $this->formatPhoneNumber($phoneNumber);
        
        $twilio = new \Twilio\Rest\Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        
        $twilio->messages->create(
            $formattedNumber,
            [
                'from' => config('services.twilio.from_number'),
                'body' => $message
            ]
            );
        
        return $response;
    } catch (\Twilio\Exceptions\TwilioException $e) {
        \Log::error('Twilio SMS Error: ' . $e->getMessage());
        throw $e;
    }
}
    private function formatPhoneNumber($phoneNumber)
    {
        // Remove non-digit characters
        $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Validate number length and format
        if (strlen($cleaned) == 10) {
            return '+1' . $cleaned; // US number
        }
        
        if (strlen($cleaned) == 11 && $cleaned[0] == '1') {
            return '+' . $cleaned; // Number starts with 1
        }
        
        if (strlen($cleaned) >= 10 && strlen($cleaned) <= 15) {
            return '+' . $cleaned; // International number
        }
        
        throw new \Exception("Invalid phone number format: {$phoneNumber}");
    }
    
   
}
