<?php

namespace App\Exports;

use App\Models\SchoolPartner;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchoolPartnersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SchoolPartner::select('id', 'school_name', 'contact_person', 'email', 'num_students', 'status', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'School Name',
            'Contact Person',
            'Email',
            'Number of Students',
            'Status',
            'Created At',
        ];
    }
}
