<?php

namespace App\Exports;

use App\Models\Invite;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InviteExport implements FromCollection, Responsable, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public $fileName = 'InviteList.xlsx';

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invite::all()->map(fn (Invite $invite) => [
            $invite->name,
            $invite->email,
            $invite->category,
            $invite->passes,
        ]);
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Category', 'Passes'];
    }
}
