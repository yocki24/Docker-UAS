<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{

    public function __construct(string $class)
    {
        $this->class = $class;
    }

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
        return User::where(['status' => 'siswa', 'class' => $this->class])->get();
    }

    public function headings(): array
    {
        return ["nisn", "name", "date_of_birth", "class", "major", "role", "password"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
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
            $user->class,
            $user->major,
            $user->role,
            $user->password,
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'C' => NumberFormat::FORMAT_DATE_YYYYMMDD,
    //     ];
    // }
}