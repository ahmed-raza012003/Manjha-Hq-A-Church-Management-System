<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    /**
     * Retrieve all members from the database.
     */
    public function collection()
    {
        return Member::select('id', 
         'first_name',
        'middle_name',
        'nick_name',
     
        'gender',
        'date_of_birth',
        'groups',
        'baptism_date',
        'member_status',
        'full_address',
        'city',
        'email',
        'phone_number',
        'job_title',
        'employer',
         )->get();
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'id',
          'first_name',
        'middle_name',
        'nick_name',
       
        'gender',
        'date_of_birth',
        'groups',
        'baptism_date',
        'member_status',
        'full_address',
        'city',
        'email',
        'phone_number',
        'job_title',
        'employer',
        ];
    }
}
