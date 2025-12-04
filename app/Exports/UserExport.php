<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithMapping, WithHeadings
{
    private $number= 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array{
        return['No','Name','Email','Role'];
    }

    public function map($user): array{
        return [
            ++$this->number,
            $user->name,
            $user->email,
            $user->role
        ];
    }
}
