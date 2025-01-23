<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h2>{{ $subject }}</h2>
    
    @if($messageType === 'text')
        <p>{{ $messageContent }}</p>
    @elseif($messageType === 'voice')
        <p>A voice message has been attached.</p>
    @elseif($messageType === 'video')
        <p>A video message has been attached.</p>
    @endif
</body>
</html>