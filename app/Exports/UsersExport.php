<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\RegisteredCourses;

class UsersExport implements 
 FromCollection, 
ShouldAutoSize, 
WithMapping, 
WithHeadings
// WithColumnFormatting,
//FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::with('RegisteredCourses')->get();
        return User::all();
    }

    public function map($user): array
    {
        return[
      
        ];
    }

    public function headings(): array
    {
        return[
            'User ID',
            'User Name',
            'User Role',
            'User Email',
            'User course',
        ];
    }

    public static function qweq($role_id)
    {
        return [
            '1' => 'Student',
            '2' => 'Admin',
            '3' => 'Staff',
        ];
    }
}
