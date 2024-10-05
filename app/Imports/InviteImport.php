<?php

namespace App\Imports;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InviteImport implements ToModel, WithHeadingRow//, WithValidation
{
    use Importable;

    public function __invoke(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        $this->import($request->file);

        return ['message' => 'Imported successfully!'];
    }

    public function model(array $row)
    {
        //return Invite::make(Arr::only($row, ['name', 'email', 'passes', 'category']));

        return Invite::make(['name' => $row[0]. ' '.$row[1], 'passes' => 1, 'category' => 'General Guest']);
    }

    public function rules(): array
    {
        return [
            'name'     => 'required',
            'email'    => 'nullable|email',
            'passes'   => 'numeric|min:0',
            'category' => 'required',
        ];
    }
}
