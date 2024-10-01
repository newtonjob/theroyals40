<?php

namespace App\Exports;

use App\Models\Invite;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InviteExport implements FromCollection, Responsable, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public $fileName = 'InviteList.xlsx';

    public function __invoke(): static
    {
        return $this;
    }

    public function collection(): Collection
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
