<?php

namespace App\Exports;

use App\Models\Group;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve the groups and add 'Members' in the visibility column for all rows
        return Group::all(['name', 'description'])->map(function ($group) {
            // Add 'Members' in the visibility column
            $group->visibility = 'Members';
            return $group;
        });
    }

    /**
     * Define the headings for the Excel export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name', // Heading for 'name' column
            'Description', // Heading for 'description' column
            'Visibility', // Heading for 'visibility' column
        ];
    }
}
