<?php

namespace App\Imports;

use App\Models\admin\ManageExercise;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\admin\ExerciseResponseLog;

class BenifitsDirectionsImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow ,SkipsOnFailure
{

    private $isUpdate;

    public function __construct($isUpdate = false)
    {
        $this->isUpdate = $isUpdate;
    }

    public function model(array $row)
    {

        $exercise = ManageExercise::where('exercise_id',$row['id'])->first();;
        $rows =[
                'exercise_id' => $row['id'],
                'benefits' => $row['benefits'],
                'directions'  => $row['directions']
        ];

        if ($this->isUpdate == true) {
            $exercise->update($rows);
        } else {
            if ($exercise) {
                $exercise->update($rows);
                
            } else {
                $exercise = new ManageExercise($rows);
            }
        }

        ExerciseResponseLog::create([
            'exercise_id' => $exercise->exercise_id,
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
                'response_reason' => $failure->errors()[0] ?? null
            ]);
        }
    }

    public function rules(): array
    {
        
        return [
            'id' => ['required','exists:manage_exercise,exercise_id'],
            'benefits'=> ['required'],
            'directions'=> ['required'],
        ];
    }


}
