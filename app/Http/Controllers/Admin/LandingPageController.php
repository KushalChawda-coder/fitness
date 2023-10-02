<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\{LandingPage, DigitalFiles};
use App\Models\Domain;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\AjaxPagination\AjaxPagination;


class LandingPageController extends Controller
{
    protected $ajaxPagination;


    public function __construct(AjaxPagination $ajaxPagination)
    {
        $this->ajaxPagination = $ajaxPagination;
    }


    public function index(){

        $LandingPage = LandingPage::latest()->paginate(10);
        return view('admin.LandingPages.index',['data' => $LandingPage]);

    }

    private function validator($data){
      $uniqueDomain = isset($data['id']) ? Rule::unique('landing_page_cms')->ignore($data['id']) : 'unique:landing_page_cms';
      
      $rules  = [
            'main_heading' => ['required','string','max:255'],
            'menu_text' => ['required','string','max:255'],
            'brand_name' => ['required','string'],
            'banner_image' => ['image','mimes:jpeg,png,jpg,gif'],
            'lead_collection_column' => ['required','array','max:255'],
            'meta_page_title' => ['string','string','max:255'],
            'meta_friendly_url' => ['string','max:255'],
            'meta_description' => ['string'],
            'tagsBasic' => ['max:255'],
            'domain_name' => ['required','string'],
        ];

        if (isset($data['id'])) {
            $rules['id'] = ['required', 'integer'];
        }
        if (isset($data['bar_text'])) {
            $rules['bar_text'] = ['required', 'string'];
        }
        if (isset($data['sub_text'])) {
            $rules['sub_text'] = ['required','string'];
        }
        if (isset($data['lead_collection'])) {
            $rules['lead_collection'] = ['required','string','max:255'];
        }
        if (isset($data['service_name'])) {
            $rules['service_name'] = ['required','string','max:255'];
        }
        if (isset($data['app_name'])) {
            $rules['app_name'] = ['required','string','max:255'];
        }
        if (isset($data['action_button_name'])) {
            $rules['action_button_name'] = ['required','string','max:255'];
        }
        if (isset($data['digital_files'])) {
            $rules['digital_files'] = ['required','string'];
        }

        if (isset($data['domain_id'])) {
            $rules['domain_id'] = ['required', 'integer', $uniqueDomain];
        }

        return $validator = Validator::make($data, $rules);
    }

    public function edit(Request $request){

        $LandingPage = LandingPage::with('getDomain')->find($request->id);
        $lead_collection_column = explode(',', $LandingPage->lead_collection_column);

        return view('admin.LandingPages.edit',['LandingPage' => $LandingPage, 'lead_collection_column' => $lead_collection_column]);
    }

    public function update(Request $request){

        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()));
        } else {

            $meta_tags = null;
            if (isset($request->tagsBasic)) {
                $json = $request->tagsBasic;
                $tagArray = json_decode($json);
                $arr = [];
                foreach ($tagArray as $tag) {
                    $arr[] = $tag->value;
                }
                $meta_tags = implode(',', $arr);
            }
            
            $file_path = '';
            if (!empty($request->file('banner_image'))) {
                $fileName = time().".".$request->file('banner_image')->getClientOriginalExtension();
                $path = $request->file('banner_image')->storeAs('LandingPages_images',$fileName,'public');
                $file_path = '/storage/'.$path;
                
            }

            $update = [];
            $update['main_heading'] = $request->main_heading;
            $update['menu_text'] = $request->menu_text;
            $update['brand_name'] = $request->brand_name;
            $update['service_name'] = $request->service_name;
            $update['app_name'] = $request->app_name;
            $update['bar_text'] = $request->bar_text;
            $update['sub_text'] = $request->sub_text;
            $update['lead_collection'] = $request->lead_collection;
            $update['lead_collection_column'] = implode(',',$request->lead_collection_column);
            $update['meta_page_title'] = $request->meta_page_title;
            $update['meta_friendly_url'] = $request->meta_friendly_url;
            $update['meta_description'] = $request->meta_description;
            $update['meta_tags'] = $meta_tags;
            $update['domain_id'] = $request->domain_id;

            if ($file_path) {
                $update['banner_image'] = $file_path;
            }

            LandingPage::find($request->id)->update($update);

            Domain::find($request->domain_id)->update([
                'domain_name' => $request->domain_name,
                'status' => Domain::ACTIVE
            ]);
            return redirect()->route('landing_pages.index')->with('success','Landing pages have been successfully updated!');
        }

    }

    public function updateStatus(Request $request){

        $LandingPageId = $request->LandingPageId;
        try{
            $LandingPage = LandingPage::find($LandingPageId);
            if (!$LandingPage) {
                return response()->json(['status' => false, 'message' => 'Landing page not found.']);
            }
            LandingPage::find($LandingPageId)->update([
                'status' => $request->status
            ]);
            return response()->json(['status' => true, 'message' => 'Status Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }

    public function checkDomain(Request $request){

        $url = $request->url;
        $domain_id = $request->domain_id ?? '';

        try{
            $qurey = Domain::where('domain_name',$url);
            if (isset($domain_id)) {
                $qurey->where('id', '!=', $domain_id);
            }
            $domain = $qurey->count();

            if ($domain > 0) {
                return response()->json(['status' => false, 'error' => 'That Page Name is Taken. Try another.']);
            }  

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }

    public function delete(Request $request){

        $landingPageId = $request->id;
        $pageDetails = LandingPage::find($landingPageId);

        try{
                $landingPage = LandingPage::find($landingPageId)->delete();
                Domain::where('id', $pageDetails->domain_id)->delete();

                if ($landingPage) {
                    return back()->with('success','Page delete successfully !');
                }  
            
        } catch (\Exception $e) {
              return back()->with('error','Something Went wrong !');
        }
    }

    public function create($landing_type){

        if (!$landing_type) {
            return redirect()->back()->with('error', 'Something Went wrong !');
        }

        return view('admin.LandingPages.create',compact('landing_type'));
    }


    public function store(Request $request){

        $rules  = [
            'main_heading' => ['required','string','max:255'],
            'menu_text' => ['required','string','max:255'],
            'brand_name' => ['required','string'],
            'lead_collection_column' => ['required','array','max:255'],
            'meta_page_title' => ['string','string','max:255'],
            'meta_friendly_url' => ['string','max:255'],
            'meta_description' => ['string'],
            'tagsBasic' => ['max:255'],
            'domain_name' => ['required','string'],
        ];

        if (isset($request->bar_text)) {
            $rules['bar_text'] = ['required', 'string'];
        }
        if (isset($request->sub_text)) {
            $rules['sub_text'] = ['required','string'];
        }
        if (isset($request->lead_collection)) {
            $rules['lead_collection'] = ['required','string','max:255'];
        }
        if (isset($request->service_name)) {
            $rules['service_name'] = ['required','string','max:255'];
        }
        if (isset($request->app_name)) {
            $rules['app_name'] = ['required','string','max:255'];
        }
        if (isset($request->action_button_name)) {
            $rules['action_button_name'] = ['required','string','max:255'];
        }
        if (isset($request->digital_files)) {
            $rules['digital_files'] = ['required','string'];
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {

            $meta_tags = null;
            if (isset($request->tagsBasic)) {
                $json = $request->tagsBasic;
                $tagArray = json_decode($json);
                $arr = [];
                foreach ($tagArray as $tag) {
                    $arr[] = $tag->value;
                }
                $meta_tags = implode(',', $arr);
            }

            $digital_files = null;
            if (isset($request->digital_files)) {
                $json = $request->digital_files;
                $tagArray = json_decode($json);
                $arr = [];
                foreach ($tagArray as $tag) {
                    $arr[] = $tag->value;
                }
                $digital_files = implode(',', $arr);
            }

            
            if (!empty($request->file('banner_image'))) {
                $fileName = time().".".$request->file('banner_image')->getClientOriginalExtension();
                $path = $request->file('banner_image')->storeAs('LandingPages_images',$fileName,'public');
                $file_path = '/storage/'.$path;
                
            } else {
                $file_path =  ($request->landing_page_type == 1) ? '/assets/admin/plan-img/hero_iphone_14.jpg' : '/assets/admin/plan-img/free-ebook.jpg';
            }

            $domainData = Domain::create([
                'domain_name' => $request->domain_name,
                'is_domain_type' => Domain::DOMAIN_LANDING_PAGE,
                'status' => Domain::ACTIVE
            ]);

            $create = [];
            $create['main_heading'] = $request->main_heading;
            $create['menu_text'] = $request->menu_text;
            $create['brand_name'] = $request->brand_name;
            $create['banner_image'] = $file_path;
            $create['lead_collection_column'] = implode(',',$request->lead_collection_column);
            $create['meta_page_title'] = $request->meta_page_title;
            $create['meta_friendly_url'] = $request->meta_friendly_url;
            $create['meta_description'] = $request->meta_description;
            $create['meta_tags'] = $meta_tags;
            $create['domain_id'] = $domainData->id;
            $create['landing_page_type'] = $request->landing_page_type;
            $create['status'] = ($request->status == 1) ? LandingPage::PUBLISHED : LandingPage::DRAFT;

            if ($request->service_name) {
                $create['service_name'] = $request->service_name;
            }
            if ($request->app_name) {
                $create['app_name'] = $request->app_name;
            }
            if ($request->bar_text) {
                $create['bar_text'] = $request->bar_text;
            }
            if ($request->sub_text) {
                $create['sub_text'] = $request->sub_text;
            }
            if ($request->lead_collection) {
                $create['lead_collection'] = $request->lead_collection;
            }
            if ($request->action_button_name) {
                $create['action_button_name'] = $request->action_button_name;
            }
            if ($request->digital_files) {
                $create['digital_files'] = $digital_files;
            }

            LandingPage::create($create);
            
            return redirect()->route('landing_pages.index')->with('success','Landing pages create successfully!');
        }

    }


    public function search(Request $request){
        if ($request->ajax()) {
            try{
                $s = $request->Search_text;
                if (empty($request->Search_text)) {
                    $search_lead = LandingPage::latest()->paginate($request->page_item_count);
                } else {
                    $search_lead = LandingPage::when($s,function ($query) use($s){
                        $query->where('main_heading', 'like', '%' . $s . '%' );
                    })->latest()->paginate($request->page_item_count);
                }
                if ($search_lead->isEmpty()) {
                    $html='<p class="text-center mb-0 mt-5 pt-5">'. _('Data Not Found!') .'</p>';
                    $pagination_html='<div></div>';
                    return response()->json(['status' => true, 'html' => $html,
                        'pagination_html' => $pagination_html]);
                } else {
                    return response()->json(['status' => true, 'html' => $this->getTable($search_lead),'pagination_html' => $this->ajaxPagination->getPagination($search_lead,$request->page)]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
            }
        }
    }


    public function getDataAjax(Request $request){
        try{
            $page_count = $request->page_item_count;
            $s = $request->Search_text;
            $search_data = LandingPage::when($s,function ($query) use($s){
                $query->where('main_heading', 'like', '%' . $s . '%' );
            })->latest()->paginate($page_count);
            return response()->json(['status' => true, 'html' => $this->getTable($search_data),'pagination_html' => $this->ajaxPagination->getPagination($search_data,$request->page)]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }


    private function getTable($search_data){
        $landing_html = "";
        foreach ($search_data as $value) {
            $landing_html .= '<div class="card mb-2">
            <div class="card-body pt-md-0 pb-md-0 sh-md-8">
              <div class="row g-0 h-100 align-content-center">
                <div
                  class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                  <div class="text-muted text-small d-md-none">Name</div>
                  <div class="text-alternate">
                    <a href="' . route('landing_pages.edit', ['id' => $value->id]) .'">'. ucwords($value->main_heading) .' </a>
                  </div>
                </div>
                <div
                  class="col-3 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0">
                  <div class="text-muted text-small d-md-none">Status</div>
                  <div class="text-alternate">
                    <span class="badge rounded-pill bg-outline-primary">' . ($value->status == 1 ? 'PUBLISH' : 'DRAFT') . '</span>
                  </div>
                </div>
                <div
                  class="col-2 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0">
                  <div class="text-muted text-small d-md-none">Action</div>
                  <div class="text-alternate">
                    <div class="ms-1">
                      <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light"
                        data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-submenu>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-more-horizontal undefined"><path d="M9 10C9 9.44772 9.44772 9 10 9V9C10.5523 9 11 9.44772 11 10V10C11 10.5523 10.5523 11 10 11V11C9.44772 11 9 10.5523 9 10V10zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM16 10C16 9.44772 16.4477 9 17 9V9C17.5523 9 18 9.44772 18 10V10C18 10.5523 17.5523 11 17 11V11C16.4477 11 16 10.5523 16 10V10z"></path></svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a href="' . route('landing_pages.delete', ['id' => $value->id]) .'" class="dropdown-item">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        }
        return $landing_html;
    }


    public function getDigitalFile(){

        $digitalFiles = DigitalFiles::select('file_name')->get();

        if (!empty($digitalFiles)) {
            $setvalue = [];
            foreach ($digitalFiles as $key => $value) {
                $setvalue[] = $value->file_name;
            }
            return response()->json(['status' => true, 'message' => 'Data fetch successfully', 'data' => $setvalue]);
        }
        return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
    }


}
