<?php

namespace App\Exports;

use App\Models\Field;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FieldsExport implements FromCollection, WithMapping, WithHeadings
{
    private $noRow=0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Field::all();
    }

    public function headings(): array{
        return ['No','Nama Lapangan', 'Deskripsi', 'Jenis','Status'];
    }

    public function map($field): array{
        return[
            ++$this->noRow,
            $field->name,
            $field->description,
            $field->type,
            $field->status
        ];
    }
}
