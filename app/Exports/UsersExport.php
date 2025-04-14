<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0;

    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Role',
        ];
    }

    public function map($user): array
    {
        return [
            ++$this->counter,
            $user->name,
            $user->email,
            $user->role,
        ];
    }
}
