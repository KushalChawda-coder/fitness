<?php

namespace App\Exports;

use App\Models\admin\ManageExercise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BenifitsDirectionsExport implements FromCollection , WithHeadings
{
   
    public function collection()
    {
        return ManageExercise::get(['exercise_id','exercise_name','benefits','directions']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Exercise Name',
            'Benefits',
            'Directions'
        ];
    }
}
