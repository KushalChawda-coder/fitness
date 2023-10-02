<?php

namespace App\Imports;

use App\Models\admin\ManageExercise;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\admin\ExerciseResponseLog;

class ExercisesDelete implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    public function model(array $row)
    {
        ManageExercise::where('exercise_id',$row['id'])->delete();
        ExerciseResponseLog::create([
            'exercise_id' => $row['id'] ?? null,
            'response_reason' => "Row deleted"
        ]);
        
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $i => $failure) {
            $values = $failure->values();
            ExerciseResponseLog::create([
                'row' => $failure->row(),
                'exercise_id' => $values['id'] ?? null,
                'response_reason' => $failure->errors()[0] ?? null
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:manage_exercise,exercise_id']
        ];
    }
}
