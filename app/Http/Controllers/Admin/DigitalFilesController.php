<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use App\Models\admin\DigitalFiles;
use App\Services\AjaxPagination\AjaxPagination;
use Faker\Factory as Faker;


class DigitalFilesController extends Controller
{
    protected $ajaxPagination;


    public function __construct(AjaxPagination $ajaxPagination)
    {
        $this->ajaxPagination = $ajaxPagination;
    }


    public function index()
    {   
        $digitalFiles = DigitalFiles::latest()->paginate(10);
        return view('admin.DigitalFiles.index',['data' => $digitalFiles]);
    }


    private function validator($data){
      
      $rules  = [
            'file_name' => ['required','string','max:255'],
            'upload_file' => ['required','mimes:pdf,doc']
        ];

        return $validator = Validator::make($data, $rules);
    }

    private function formatFileSize($bytes){

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes, 1024));
        return round($bytes / (1024 ** $i), 2) . ' ' . $units[$i];
    }



    public function store(Request $request)
    {   
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput();
        } else {

            $file_path = '';
            $formattedSize = '0';
            if (!empty($request->file('upload_file'))) {
                $fileName = time().".".$request->file('upload_file')->getClientOriginalExtension();
                $path = $request->file('upload_file')->storeAs('DigitalFiles',$fileName,'public');
                $fileSize = $request->file('upload_file')->getSize();
                $formattedSize = $this->formatFileSize($fileSize);
                $file_path = '/storage/'.$path;
            }

            DigitalFiles::create([
                'file_name' => $request->file_name,
                'upload_file' => $file_path,
                'file_size' => $formattedSize,
            ]);

            return redirect()->route('digitalFiles.index')->with('success','Digital file create successfully!');
        }

    }

    public function search(Request $request){
        if ($request->ajax()) {
            try{
                $s = $request->Search_text;
                if (empty($request->Search_text)) {
                    $search_lead = DigitalFiles::latest()->paginate($request->page_item_count);
                } else {
                    $search_lead = DigitalFiles::when($s,function ($query) use($s){
                        $query->where('file_name', 'like', '%' . $s . '%' );
                    })->latest()->paginate($request->page_item_count);
                }
                if ($search_lead->isEmpty()) {
                    $digital_file_html='<p class="text-center mb-0 mt-5 pt-5">'. _('Data Not Found!') .'</p>';
                    $pagination_html='<div></div>';
                    return response()->json(['status' => true, 'digital_file_html' => $digital_file_html,
                        'pagination_html' => $pagination_html]);
                } else {
                    return response()->json(['status' => true, 'digital_file_html' => $this->getTable($search_lead),'pagination_html' => $this->ajaxPagination->getPagination($search_lead,$request->page)]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
            }
        }
    }

    public function getfilesAjax(Request $request){
        try{
            $page_count = $request->page_item_count;
            $s = $request->Search_text;
            $search_data = DigitalFiles::when($s,function ($query) use($s){
                $query->where('file_name', 'like', '%' . $s . '%' );
            })->latest()->paginate($page_count);
            return response()->json(['status' => true, 'digital_file_html' => $this->getTable($search_data),'pagination_html' => $this->ajaxPagination->getPagination($search_data,$request->page)]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }


    private function getTable($search_data){
        $digital_file_html = "";
        foreach ($search_data as $value) {
            $digital_file_html .= '<div class="card mb-2">
              <div class="card-body pt-md-0 pb-md-0 sh-md-8">
                <div class="row g-0 h-100 align-content-center">
                  <div
                    class="col-12 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                    <div class="text-muted text-small d-md-none">Name</div>
                    <div class="text-alternate">' . $value->file_name . '</div>
                  </div>
                  <div
                    class="col-6 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                    <div class="text-muted text-small d-md-none">File Size</div>
                    <div class="text-alternate">'. $value->file_size .'</div>
                  </div>
                  <div
                    class="col-6 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                    <div class="text-muted text-small d-md-none">Action</div>
                    <div class="text-alternate">
                      <div class="ms-1">
                        <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light"
                          data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                          data-submenu>
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-more-horizontal undefined"><path d="M9 10C9 9.44772 9.44772 9 10 9V9C10.5523 9 11 9.44772 11 10V10C11 10.5523 10.5523 11 10 11V11C9.44772 11 9 10.5523 9 10V10zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM16 10C16 9.44772 16.4477 9 17 9V9C17.5523 9 18 9.44772 18 10V10C18 10.5523 17.5523 11 17 11V11C16.4477 11 16 10.5523 16 10V10z"></path></svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <button class="dropdown-item" type="button">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
        }
        return $digital_file_html;
    }

    public function delete($id){
        try{
            $result = DigitalFiles::find($id)->delete();
            if ($result) {
                return back()->with('success','Digital file successfully deleted!');
            }  
            
        } catch (\Exception $e) {
              return back()->with('error','Something Went wrong !');
        }
    }

    public function edit($id)
    {   
        try{
            $digitalFiles = DigitalFiles::find($id);
            if (!$digitalFiles) {
                return redirect()->back()->with('error','Data not found!');
            }  

            return view('admin.DigitalFiles.edit',['data' => $digitalFiles]);

            
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Something Went wrong !');
        }
    }

    public function update(Request $request)
    {   
        $rules  = [
            'file_name' => ['required','string','max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {

            $file_path = '';
            $formattedSize = '0';
            if (!empty($request->file('upload_file'))) {
                $fileName = time().".".$request->file('upload_file')->getClientOriginalExtension();
                $path = $request->file('upload_file')->storeAs('DigitalFiles',$fileName,'public');
                $fileSize = $request->file('upload_file')->getSize();
                $formattedSize = $this->formatFileSize($fileSize);
                $file_path = '/storage/'.$path;
            }

            $update = [];
            $update['file_name'] = $request->file_name;
            if ($file_path) {
                $update['upload_file'] = $file_path;
            }

            DigitalFiles::where('id', $request->id)->update($update);

            return redirect()->route('digitalFiles.index')->with('success','Update successfully!');
        }
    }

       public function test()
    {
        $faker = Faker::create('nl_NL');

        for ($i = 0; $i < 100; $i++) {
            $name = $faker->name;
            $status = $faker->randomElement(['1', '2', '3']);
            $url = $faker->url;
            $location = $faker->address;
            $company_name = $faker->company;
            $address = $faker->address;
            $email = $faker->email;
            $phone = $faker->phoneNumber;

             DigitalFiles::create([
                'file_name' => $name,
                'upload_file' => $url,
                'file_size' => $phone,
            ]);
             
            echo "Inserted fake data for lead: $name\n";
        }
    }


}