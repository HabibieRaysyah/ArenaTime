<?php

namespace App\Exports;

use App\Models\field;
use App\Models\schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScheduleExport implements FromCollection, WithHeadings, WithMapping
{
    private $num= 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return schedule::with("field")->get();
    }

    public function headings(): array
    {
        return ['no','nama lapangan','jadwal','harga perjam'];
    }

    public function map($schedule): array{
        return [
            ++$this->num,
            $schedule->field->name,
            $schedule->hour,
            $schedule->hourly_price,
        ];
    }
}
