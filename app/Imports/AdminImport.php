<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdminImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
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

        if ($user) {
            $user->update([
                'nisn' => $row['nisn'],
                'name' => $row['name'],
                'date_of_birth' => $row['date_of_birth'],
                'status' => strtolower($row['status']),
                'password' => $row['password'],
                'role' => 'adm',
            ]);
            return $user;
        } else {
            return new User([
                'nisn' => $row['nisn'],
                'name' => $row['name'],
                'date_of_birth' => $row['date_of_birth'],
                'status' => strtolower($row['status']),
                'password' => $row['password'],
                'role' => 'adm',
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}