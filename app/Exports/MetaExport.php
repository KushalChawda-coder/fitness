<?php

namespace App\Exports;

use App\Models\admin\ManageExercise;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MetaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ManageExercise::get(['exercise_id','exercise_name','meta_title','meta_friendly_url','meta_description','meta_tags']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Exercise Name',
            'Page Title',
            'Friendly URL',
            'Meta Description',
            'Tags'
        ];
    }
}
