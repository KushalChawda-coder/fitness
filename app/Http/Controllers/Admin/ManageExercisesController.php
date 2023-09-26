<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\AjaxPagination\AjaxPagination;
use App\Models\admin\{ManageExercise, ExerciseResponseLog};
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\{ExercisesImport, BenifitsDirectionsImport, ExercisesMetaImport, ExercisesDelete};
use App\Exports\{ExerciseExport, BenifitsDirectionsExport, MetaExport};

class ManageExercisesController extends Controller
{
    protected $ajaxPagination;

    public function __construct(AjaxPagination $ajaxPagination)
    {
        $this->ajaxPagination = $ajaxPagination;
    }


    public function index()
    {
        $exercises = ManageExercise::latest()->paginate(10);

        return view('admin.ManageExercises.index',['data' => $exercises]);
    }

    public function create()
    {   
        return view('admin.ManageExercises.create');
    }

    private function validator($data)
    {

        $rules = [
            'exercise_name' => ['required', 'string', 'max:255'],
            'body_part_ids' => ['required', 'string', 'max:255'],
            'equipments_ids' => ['required', 'string', 'max:255'],
            'exercise_type_ids' => ['required', 'string', 'max:255'],
            'highlight_images' => ['required', 'array', 'max:3'],
            'highlight_images.*' => ['required', 'string', 'max:255'],
            'benefits' => ['required', 'string'],
            'directions' => ['required', 'array', 'max:100'],
            'directions.*' => ['required'],
            'direction_videos' => ['required', 'array', 'max:3'],
            'direction_videos.*' => ['required', 'string', 'max:255'],
            'video_link' => ['required', 'url', 'max:255'],
            'meta_title' => ['max:255'],
            'meta_friendly_url' => ['max:255'],
            'meta_description' => ['max:255'],
            'tagsBasic' => ['max:255']
        ];

        if (isset($data['id'])) {
            $rules['id'] = ['required', 'integer'];
        }

        if (isset($data['status'])) {
            $rules['status'] = ['required', 'integer'];
        }

        return $validator = Validator::make($data, $rules);
    }


    public function store(Request $request)
    {
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput()->with('error', 'Validation Error Detected !');
        } else {

            $bodyPartTags = implode(',', array_column(json_decode($request->body_part_ids), 'value'));
            $equipmentsTags = implode(',', array_column(json_decode($request->equipments_ids), 'value'));
            $exerciseTypeTags = implode(',', array_column(json_decode($request->exercise_type_ids), 'value'));
            $highlightImages = implode(',', array_values($request->highlight_images));
            $directions = implode(',', array_values($request->directions));
            $directionVideos = implode(',', array_values($request->direction_videos));

            $lastId = ManageExercise::select('id','exercise_id')->latest('id')->first();
            $increment_id = Null;
            if(!empty($lastId)){
                $increment_id = $lastId->exercise_id+1;
            } 
            while (ManageExercise::where('exercise_id', $increment_id)->exists()) {
                $increment_id++;
            }

            ManageExercise::create([
                'exercise_id' => $increment_id ?? Null, 
                'user_id' => auth()->user()->id,
                'exercise_name' => $request->exercise_name,
                'body_part_ids' => $bodyPartTags,
                'equipments_ids' => $equipmentsTags,
                'exercise_type_ids' => $exerciseTypeTags,
                'highlight_images' => $highlightImages,
                'benefits' => $request->benefits,
                'directions' => $directions,
                'direction_videos' => $directionVideos,
                'video_link' => $request->video_link,
                'meta_title' => $request->meta_title,
                'meta_friendly_url' => $request->meta_friendly_url,
                'meta_description' => $request->meta_description,
                'meta_tags' => !empty($request->tagsBasic) ? implode(',', array_column(json_decode($request->tagsBasic), 'value')) : null,
                'status' => $request->status ?? 0
            ]);

            return to_route('manageExercises.index')->with('success', 'Exercise created successfully!');
        }
    }


    public function edit(Request $request)
    {
        $exercise = ManageExercise::find($request->id);

        abort_if(empty($exercise), 403, 'Exercise not found');

        if (!empty($exercise->highlight_images)) {
            $data['highlight_img'] = explode(',', $exercise->highlight_images);
        }

        if (!empty($exercise->direction_videos)) {
            $data['direction_videos'] = explode(',', $exercise->direction_videos);
        }

        $data['directions'] = explode(',', $exercise->directions);
        $data['exercise'] = $exercise;
        return view('admin.ManageExercises.edit', $data);
    }


    public function update(Request $request)
    {
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput()->with('error', 'Validation Error Detected !');
        } else {

            $bodyPartTags = implode(',', array_column(json_decode($request->body_part_ids), 'value'));
            $equipmentsTags = implode(',', array_column(json_decode($request->equipments_ids), 'value'));
            $exerciseTypeTags = implode(',', array_column(json_decode($request->exercise_type_ids), 'value'));
            $highlightImages = implode(',', array_values($request->highlight_images));
            $directions = implode(',', array_values($request->directions));
            $directionVideos = implode(',', array_values($request->direction_videos));

            ManageExercise::find($request->id)->update([
                'user_id' => auth()->user()->id,
                'exercise_name' => $request->exercise_name,
                'body_part_ids' => $bodyPartTags,
                'equipments_ids' => $equipmentsTags,
                'exercise_type_ids' => $exerciseTypeTags,
                'highlight_images' => $highlightImages,
                'benefits' => $request->benefits,
                'directions' => $directions,
                'direction_videos' => $directionVideos,
                'video_link' => $request->video_link,
                'meta_title' => $request->meta_title,
                'meta_friendly_url' => $request->meta_friendly_url,
                'meta_description' => $request->meta_description,
                'meta_tags' => !empty($request->tagsBasic) ? implode(',', array_column(json_decode($request->tagsBasic), 'value')) : null,
                'updated_at' => now()
            ]);

            return to_route('manageExercises.index')->with('success', 'Exercise updated successfully !');
        }
    }

    public function delete(Request $request)
    {

        try {

            $exercise = ManageExercise::find($request->id);
            if (!$exercise) {
                return to_route('manageExercises.index')->with('error', 'Exercise not found !');
            }
            $exercise->delete();

            return to_route('manageExercises.index')->with('success', 'Exercise deleted successfully !');
        } catch (\Exception $e) {
            return to_route('manageExercises.index')->with('error', 'Something Went Wrong !');
        }
    }

    public function uploadFile(Request $request)
    {
        if ($request->ajax()) {
            try {

                $fileName = time() . "." . $request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')->storeAs('manage_exercises_files', $fileName, 'public');
                $file_path = '/storage/' . $path;

                return response()->json(['status' => true, 'file_path' => $file_path]);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something went wrong !']);
            }
        }
    }


    public function setStatus(Request $request)
    {
        $exercise_id = $request->exercise_id;
        try {
            $exercise = ManageExercise::find($exercise_id);
            if (!$exercise) {
                return response()->json(['status' => false, 'message' => 'Exercise not found.']);
            }
            $exercise->update([
                'status' => $request->status
            ]);
            return response()->json(['status' => true, 'message' => 'Status Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }


    public function search(Request $request, AjaxPagination $ajaxPagination)
    {
        if ($request->ajax()) {
            try {
                $s = $request->search_text;
                if (empty($request->search_text)) {
                    $exercises = ManageExercise::latest()->paginate(10);
                } else {
                    $exercises = ManageExercise::when($s, function ($query) use ($s) {
                        $query->where('exercise_name', 'like', '%' . $s . '%');
                    })->latest()->paginate(10);
                }
                if ($exercises->isEmpty()) {
                    $exercise_html = '<p class="text-center mb-0 mt-5 pt-5">' . _('Data Not Found!') . '</p>';
                    $pagination_html = '<div></div>';
                    return response()->json([
                        'status' => true, 'table' => $exercise_html,
                        'pagination' => $pagination_html
                    ]);
                } else {
                    return response()->json(['status' => true, 'table' => $this->getTable($exercises), 'pagination' => $this->ajaxPagination->getPagination($exercises, $request->page)]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
            }
        }
    }


    private function getTable($search)
    {
        $html = "";

        foreach ($search as $exercise) {
            $html .= '<div class="card mb-2">
          <div class="card-body pt-md-0 pb-md-0 sh-md-8">
            <div class="row g-0 h-100 align-content-center">
              <div class="col-4 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 h-lg-100 position-relative">
                <div class="text-muted text-small d-lg-none">Id</div>
                <a href="' . route('manageExercises.edit', ['id' => $exercise->id]) . '"
                  class="text-truncate h-100 d-flex align-items-center">' . $exercise->id . '</a>
              </div>
              <div class="col-8 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Name</div>
                <div class="text-alternate">
                  <a href="' . route('manageExercises.edit', ['id' => $exercise->id]) . '">' . ucfirst($exercise->exercise_name) . '</a>
                </div>
              </div>
              <div class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Status</div>
                <div class="text-alternate">
                  <span class="badge rounded-pill bg-outline-primary">' . ($exercise->status === 1 ? 'PUBLISH' : 'DRAFT') . '</span>
                </div>
              </div>
              <div class="col-8 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Action</div>
                <div class="text-alternate">
                  <!-- Dropdown Button Start -->
                  <div class="ms-1">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light" data-bs-offset="0,3"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-submenu>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-more-horizontal undefined"><path d="M9 10C9 9.44772 9.44772 9 10 9V9C10.5523 9 11 9.44772 11 10V10C11 10.5523 10.5523 11 10 11V11C9.44772 11 9 10.5523 9 10V10zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM16 10C16 9.44772 16.4477 9 17 9V9C17.5523 9 18 9.44772 18 10V10C18 10.5523 17.5523 11 17 11V11C16.4477 11 16 10.5523 16 10V10z"></path></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="' . route('manageExercises.delete', ['id' => $exercise->id]) . '" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
        }

        return $html;
    }


    public function getPage(Request $request)
    {
        try {
            $s = $request->search_text;
            $exercises = ManageExercise::when($s, function ($query) use ($s) {
                $query->where('exercise_name', 'like', '%' . $s . '%');
            })->latest()->paginate(10);
            return response()->json(['status' => true, 'html' => $this->getTable($exercises), 'pagination' => $this->ajaxPagination->getPagination($exercises, $request->page)]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }


    public function getTags(Request $request)
    {

        try {

            $bodyTags = ManageExercise::pluck('body_part_ids')->flatMap(fn ($item) => explode(',', $item))->unique()->values();
            $equipmentTags = ManageExercise::pluck('equipments_ids')->flatMap(fn ($item) => explode(',', $item))->unique()->values();
            $exerciseTags = ManageExercise::pluck('exercise_type_ids')->flatMap(fn ($item) => explode(',', $item))->unique()->values();

            $tagsArray = [$bodyTags, $equipmentTags, $exerciseTags];

            return response()->json(['status' => true, 'data' => $tagsArray]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }


    public function importExcel(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'excel_file' => ['required', 'file', 'mimes:xls,xlsx'],
            'action_input' => ['required'],
            'action_data_input' => ['required']
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Error importing Excel file');
        } else {
            try {

                ExerciseResponseLog::truncate();
                $file = $request->file('excel_file');

                if ($request->action_input == 'create') {

                    if ($request->action_data_input == 'exercise_details') {
                        Excel::import(new ExercisesImport(), $file);
                    } else if ($request->action_data_input == 'benifits_directions') {
                        Excel::import(new BenifitsDirectionsImport(), $file);
                    } else {
                        Excel::import(new ExercisesMetaImport(), $file);
                    }
                } else if ($request->action_input == 'update') {

                    $isUpdate = true;

                    if ($request->action_data_input == 'exercise_details') {
                        Excel::import(new ExercisesImport($isUpdate), $file);
                    } else if ($request->action_data_input == 'benifits_directions') {
                        Excel::import(new BenifitsDirectionsImport($isUpdate), $file);
                    } else {
                        Excel::import(new ExercisesMetaImport($isUpdate), $file);
                    }
                } else {
                    Excel::import(new ExercisesDelete(), $file);
                }

                return back()->with('success', 'The Excel file ' . $request->action_input . ' process has been successfully imported.');
            } catch (\Exception $e) {
                return back()->with('error', 'Something Went wrong !');
            }
        }
    }

    public function getLogs()
    {
        $logs = ExerciseResponseLog::all();
        $successLogsCount = $logs->where('response_reason', 'Exercise loaded correctly')->count();
        $deleteLogsCount = $logs->where('response_reason', 'Row deleted')->count();
        $errorLogs = $logs->whereNotIn('response_reason', ['Exercise loaded correctly', 'Row deleted']);

        $data = [
            'successLogsCount' => $successLogsCount,
            'errorLogs' => $errorLogs,
            'deleteLogsCount' => $deleteLogsCount
        ];

        return view('admin.ManageExercises.logs', $data);
    }

    public function exportExcel(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'action_data_export' => ['required']
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Error exporting Excel file');
        } else {
            try {
                $actionData = $request->action_data_export;
                if ($actionData == 'exercise_details') {
                    return Excel::download(new ExerciseExport, 'Exercise-DB.xlsx');
                } else if ($actionData == 'benifits_directions') {
                    return Excel::download(new BenifitsDirectionsExport, 'Benefits and Directions.xlsx');
                } else {
                    return Excel::download(new MetaExport, 'META SEO.xlsx');
                }
               
                return back()->with('success', 'The Excel file ' . $actionData . ' process has been successfully imported.');
            } catch (\Exception $e) {
                dd($e);
                return back()->with('error', 'Something Went wrong !');
            }
        }

        dd($request->all());
        
    }

}
