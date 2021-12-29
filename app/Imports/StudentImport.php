<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = new User();
        $user = $user->where('nisn', $row['nisn'])
            ->orWhere('name', 'like', "%" . $row['name'] . "%")
            ->orWhere('name', $row['name'])
            ->first();

        $exp = explode('/', $row['date_of_birth']);
        $date = $exp[0] . '-' . $exp[1] . '-' . $exp[2];

        if ($user) {
            $user->update([
                'nisn' => $row['nisn'],
                'name' => $row['name'],
                // 'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d'),
                'date_of_birth' => $date,
                'status' => 'siswa',
                'password' => $row['password'],
                'class' => strtoupper($row['class']),
                'major' => strtoupper($row['major']),
                'role' => strtolower($row['role']),
            ]);
            return $user;
        } else {
            return new User([
                'nisn' => $row['nisn'],
                'name' => $row['name'],
                'date_of_birth' => $date,
                'status' => 'siswa',
                'password' => $row['password'],
                'class' => strtoupper($row['class']),
                'major' => strtoupper($row['major']),
                'role' => strtolower($row['role']),
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}