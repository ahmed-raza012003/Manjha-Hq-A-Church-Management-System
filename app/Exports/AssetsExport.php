<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection, WithHeadings
{
    /**
     * Retrieve the data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch all assets with specific fields
        return Asset::all(['name', 'asset_id', 'category', 'price', 'status', ]);
    }

    /**
     * Define the headings for the Excel export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',        // Heading for 'name' column
            'Asset ID',    // Heading for 'asset_id' column
            'Category',    // Heading for 'category' column
            'Price',       // Heading for 'price' column
            'Status',      // Heading for 'status' column
        ];
    }
}
