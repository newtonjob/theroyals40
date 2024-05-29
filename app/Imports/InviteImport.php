<?php

namespace App\Imports;

use App\Models\Invite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class InviteImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return Invite::make(['name' => $row[1], 'passes' => 1, 'category' => $row[2]]);
    }
}
