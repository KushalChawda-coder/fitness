<?php

namespace App\Exports;

use App\Models\admin\ManageExercise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExerciseExport implements FromCollection, WithHeadings, WithMapping
{
   
    public function collection()
    {
        return ManageExercise::get(['status','exercise_id','exercise_name','equipments_ids','body_part_ids','exercise_type_ids','highlight_images']);
    }

    public function headings(): array
    {
        return [
            'Publish',
            'ID',
            'Exercise Name',
            'Equipment',
            'Body Part',
            'Exercise Type',
            'Additional Images and Videos'
        ];
    }   

    public function map($row): array
    {
        return [
            $row->status ? '1' : '0',
            $row->exercise_id,
            $row->exercise_name,
            $row->equipments_ids,
            $row->body_part_ids,
            $row->exercise_type_ids,
            $row->highlight_images
        ];
    }
}
