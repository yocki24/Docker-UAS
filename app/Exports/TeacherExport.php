<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TeacherExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('status', 'guru')->get();
    }

    public function headings(): array
    {
        return ["nisn", "name", "date_of_birth", "role", "password"];
    }

    /**
     * @var Invoice $invoice
     */
    public function map($user): array
    {
        $exp = explode('-', $user->date_of_birth);
        $date = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
        return [
            $user->nisn,
            $user->name,
            $date,
            $user->role,
            $user->password,
        ];
    }
}