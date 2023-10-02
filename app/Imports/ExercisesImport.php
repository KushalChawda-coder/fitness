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

class ExercisesImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow ,SkipsOnFailure
{

    private $isUpdate;

    public function __construct($isUpdate = false)
    {
        $this->isUpdate = $isUpdate;
    }

    public function model(array $row)
    {   
        $rows = [
            'exercise_id' => $row['id'],
            'user_id' => auth()->user()->id,
            'exercise_name' => $row['exercise_name'],
            'body_part_ids' => $row['equipment'],
            'equipments_ids' => $row['body_part'],
            'exercise_type_ids' => $row['exercise_type'],
            'highlight_images' => $row['additional_images_and_videos'],
            'status' => $row['publish'],
        ];

        $exercise = ManageExercise::where('exercise_id', $row['id'])->first();

        if ($this->isUpdate) {
            $exercise->update($rows);
        } else {
            if ($exercise) {
                $exercise->update($rows);
            } else {
                $exercise = new ManageExercise($rows);
                $exercise->save();
            }
        }

        ExerciseResponseLog::create([
            'exercise_id' => $exercise->exercise_id ?? null,
            'response_reason' => 'Exercise loaded correctly'
        ]);

        return $exercise;
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $i => $failure) {
            $values = $failure->values();
            ExerciseResponseLog::create([
                'row' => $failure->row(),
                'exercise_id' => $values['id'] ?? null,
                'exercise_type' => $values['exercise_type'] ?? null,
                'category' =>   $values['bodypart'] ?? null,
                'equipments' => $values['equipment'] ?? null,
                'response_reason' => $failure->errors()[0] ?? null
            ]);
        }
    }


    public function rules(): array
    {
        return [
            'id' => ['required', $this->isUpdate ? 'exists:manage_exercise,exercise_id' : ''],
            'exercise_name' => ['required', 'string', 'max:255'],
            'equipment' => ['required', 'string', 'max:255'],
            'body_part' => ['required', 'string', 'max:255'],
            'exercise_type' => ['required', 'string', 'max:255'],
            'additional_images_and_videos' => ['required', 'string', 'max:255'],
            'publish' => ['required']
        ];
    }
}
