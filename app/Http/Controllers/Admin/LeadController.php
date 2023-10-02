<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\admin\{ Leads, LeadsNote, LeadWebsite, LeadsActivity, LeadsWebsiteExploreImage };
use App\Models\Domain;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use Illuminate\Support\{ Arr, Str };
use App\Services\Leads\LeadWebsiteService;
use App\Services\AjaxPagination\AjaxPagination;
use Illuminate\Support\Facades\Session;
use Faker\Factory as Faker;


class LeadController extends Controller
{

    protected $LeadWebsiteService;
    protected $AjaxPagination;

    public function __construct(LeadWebsiteService $LeadWebsiteService, AjaxPagination $AjaxPagination)
    {
        $this->leadWebsiteService = $LeadWebsiteService;
        $this->AjaxPagination = $AjaxPagination;
    }

    public function index(Request $request)
    {
        $locations = Leads::distinct('location')->pluck('location');
        $tags_data = LeadsNote::distinct('tags')->pluck('tags')->values()->toArray();
        // $tags_data = array_values(array_filter($tags_data)); // Remove empty values and reset indexes

        $tagArray = [];
        $requestData = [];

        foreach ($tags_data as $item) {
            $values = explode(',', $item);
            $tagArray = array_merge($tagArray, $values); 
        }

        $tags = array_unique($tagArray);
        $leads = Leads::latest()->paginate(10);
      
        return view('admin.Leads.index',['locations' => $locations, 'tags' => $tags]);
    }

    public function filter(Request $request){
        if ($request->has('filter_btn')) {
            $locations = Leads::distinct('location')->pluck('location');
            $tags_data = LeadsNote::distinct('tags')->pluck('tags')->values()->toArray();
            // $tags_data = array_values(array_filter($tags_data)); 
            
            $tagArray = [];
            $requestData = [];
            foreach ($tags_data as $item) {
                $values = explode(',', $item);
                $tagArray = array_merge($tagArray, $values);
            }
            $tags = array_unique($tagArray);
            $requestData = $request->except('_token');
            $allNull = true;
            foreach ($requestData as $value) {
                if ($value !== null) {
                    $allNull = false;
                }
            }
            if ($allNull) {
                return redirect()->route('leads.index');
            } else {
                $query = Leads::query();
                $filter_input = $requestData;
                if (empty($requestData['end'])) {
                    $requestData['end'] =  Carbon::now();
                }
                if (!empty($requestData['start'])) {
                    $start = Carbon::createFromFormat('m/d/Y', $requestData['start'])->startOfDay();
                    $end = Carbon::createFromFormat('m/d/Y', $requestData['end'])->endOfDay();
                    $query = $query->whereBetween('created_at', [$start, $end]);
                }
                $lead_index = array_filter([
                    $requestData['new_lead'] ?? null,
                    $requestData['hot_lead'] ?? null,
                    $requestData['follow_up'] ?? null,
                    $requestData['lost_lead'] ?? null,
                    $requestData['Not_Good_Lead'] ?? null,
                ]);
                if (!empty($lead_index)) {
                    $query = $query->whereIn('status', $lead_index);
                }
                if (!empty($requestData['tags'])) {
                    $leadIdArr = [];
                    foreach($requestData['tags'] as $s){
                        $search_LeadsId = LeadsNote::when($s,function ($q) use($s){
                            $q->where('tags', 'like', '%' . $s . '%' );
                        })->pluck('lead_id')->toArray();
                        array_push($leadIdArr,$search_LeadsId);
                    }
                    $query = $query->whereIn('id', array_unique(Arr::collapse($leadIdArr)));
                }
                if (!empty($requestData['area'])) {
                    $query = $query->where('location', $requestData['area']);
                }
                $leads = $query->latest()->paginate(10);
                // dd($leads);
                return view('admin.Leads.index',['data' => $leads,'locations' => $locations, 'tags' => $tags , 'filter' => $filter_input]);
            }
            
        } else {
            return redirect()->route('leads.index');
        }
    }

    public function addLeads()
    {
        return view('admin.Leads.create');
    }

    private function validator($data){
      $unique = isset($data['id']) ? Rule::unique('leads')->ignore($data['id']) : 'unique:leads';
   
        $rules = [
            'name' => ['required','string','max:255'],
            'status' => ['required','integer'],
            'tagsBasic' => ['required','string'],
            'company_name' => ['required','string','max:255'],
            'location' => ['required','string','max:255'],
            'address' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $unique],
            'phone' => ['required','min:5', 'max:20'],
            'profile_image' => ['image','mimes:jpeg,png,jpg']
        ];

        if (isset($data['id'])) {
            $rules['id'] = ['required', 'integer'];
        }

        return $validator = Validator::make($data, $rules);
    }

    public function store(Request $request)
    {
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput();
        } else {
            $name = $request->name;
            $status = $request->status;
            $location = $request->location;
            $company_name = $request->company_name;
            $address = $request->address;
            $email = $request->email;
            $phone = $request->phone;
            $url_json = $request->tagsBasic;
            $urlArray = json_decode($url_json);
            $arr = [];
            foreach ($urlArray as $url) {
                $arr[] = $url->value;
            }
            $urls = implode(',', $arr);

            if (!empty($request->file('profile_image'))) {
                $fileName = time().".".$request->file('profile_image')->getClientOriginalExtension();
                $path = $request->file('profile_image')->storeAs('leads_profile_image',$fileName,'public');
                $file_path = '/storage/'.$path;
            } else {
                $file_path =  'assets/admin/img/profile/profile-11.webp';
            }

        $leads_id = Leads::insertGetId([
                'name' => $name,
                'status' => $status,
                'url' => $urls,
                'location' =>$location,
                'company_name' => $company_name,
                'address' => $address,
                'email' => $email,
                'phone' => $phone,
                'profile_image' => "assets/admin/img/profile/profile-11.webp",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        if ($leads_id) { 
           
            LeadWebsite::create([
              'lead_id' => $leads_id,
              'domain_id' => 1,
              'brand_name' => $company_name,
              'brand_logo' => 'assets/admin/plan-img/logo-edit-removebg.png',
              'brand_bg_color' => '#d31876',
              'customer_claim_code' => Str::upper(Str::random(3, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')) .'-'. rand(1000, 9999) .'-'. rand(1000, 9999),
              'page_data' =>  $this->leadWebsiteService->getPageJson(),
              'plan_note' => 'The plan you have marked as visible from your product list will show up here.',
              'plan_description' => $this->leadWebsiteService->getDescription(),
              'plan_background_image' => '/assets/admin/img/product/large/product-1.webp',
              'class_note' => 'The classes you have marked as visible from your class list will show up here.',
              'class_description' => $this->leadWebsiteService->getDescription(),
              'class_background_image' => '/assets/admin/img/product/large/product-1.webp',
              'general_info' => $this->leadWebsiteService->getGenralInfoJson($email,$phone),
              'flyer_data' => $this->leadWebsiteService->getFlyerJson($phone, $name),
              'reason' => '',
              'wesite_status' => 1
            ]);

            LeadsActivity::create([
              'lead_id' => $leads_id,
              'status' => LeadsActivity::ACCOUNT_CREATED
            ]);

        }
            return to_route('leads.index')->with('success','Lead have been successfully inserted!');
        }
    }

    public function update(Request $request){

        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()));
        } else {
            $name = $request->name;
            $location = $request->location;
            $company_name = $request->company_name;
            $address = $request->address;
            $email = $request->email;
            $phone = $request->phone;
            $id = $request->id;


            $url_json = $request->tagsBasic;
            $urlArray = json_decode($url_json);
            $arr = [];
            foreach ($urlArray as $url) {
                $arr[] = $url->value;
            }
            $urls = implode(',', $arr);

            if (!empty($request->file('profile_image'))) {
                $fileName = time().".".$request->file('profile_image')->getClientOriginalExtension();
                $path = $request->file('profile_image')->storeAs('leads_profile_image',$fileName,'public');
                $file_path = '/storage/'.$path;
                
            } else {
                $file_path =  'assets/admin/img/profile/profile-11.webp';
            }

            Leads::find($request->id)->update([
                'name' => $name,
                'url' => $urls,
                'location' => $location,
                'company_name' => $company_name,
                'address' => $address,
                'email' => $email,
                'phone' => $phone,
                'profile_image' => $file_path,
                'updated_at' =>  Carbon::now()
            ]);
            return to_route('leads.details', ['id' => $id])->with('success','Leads have been successfully updated!');
        }

    }

    public function updateStatus(Request $request)
    {
        $lead_id = $request->lead_id;
        try{
            $lead = Leads::find($lead_id);
            if (!$lead) {
                return response()->json(['status' => false, 'message' => 'Lead not found.']);
            }
            Leads::find($lead_id)->update([
                'status' => $request->status
            ]);
            return response()->json(['status' => true, 'message' => 'Status Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }

    public function searchLeads(Request $request, AjaxPagination $AjaxPagination){
        if ($request->ajax()) {
            try{
                $s = $request->Search_text;
                if (empty($request->Search_text)) {
                    $search_lead = Leads::latest()->paginate($request->page_item_count);
                } else {
                    $search_lead = Leads::when($s,function ($query) use($s){
                        $query->where('name', 'like', '%' . $s . '%' )
                        ->orWhere('company_name', 'like', '%' . $s . '%' );
                    })->latest()->paginate($request->page_item_count);
                }
                if ($search_lead->isEmpty()) {
                    $lead_html='<p class="text-center mb-0 mt-5 pt-5">'. _('Data Not Found!') .'</p>';
                    $pagination_html='<div></div>';
                    return response()->json(['status' => true, 'lead_html' => $lead_html,
                        'pagination_html' => $pagination_html]);
                } else {
                    return response()->json(['status' => true, 'lead_html' => $this->getTable($search_lead),'pagination_html' => $this->AjaxPagination->getPagination($search_lead,$request->page)]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
            }
        }
    }

    public function getLeadAjax(Request $request){
        try{
            $page_count = $request->page_item_count;
            $s = $request->Search_text;
            $search_lead = Leads::when($s,function ($query) use($s){
                $query->where('name', 'like', '%' . $s . '%' )
                ->orWhere('company_name', 'like', '%' . $s . '%' );
            })->latest()->paginate($page_count);
            return response()->json(['status' => true, 'lead_html' => $this->getTable($search_lead),'pagination_html' => $this->AjaxPagination->getPagination($search_lead,$request->page)]);
        } catch (\Exception $e) {   
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }

    private function getTable($search_lead){
        $lead_html = "";
        foreach ($search_lead as $value) {
            $lead_html .= '<div class="card mb-2">
            <div class="card-body pt-0 pb-0 sh-35 sh-lg-12">
            <div class="row g-0 h-100 align-content-center">
            <a href="' . route('leads.details', ['id' => $value->id]) .'"
            class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
            <div class="text-muted text-small d-lg-none">Name</div>
            <div class="text-alternate">' . $value->name . '</div>
            <div class="text-small text-muted text-truncate position">' . $value->email . '</div>
            </a>
            <div
            class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-3">
            <div class="text-muted text-small d-lg-none">COMPANY</div>
            <div class="text-alternate">' . $value->company_name . '</div>
            </div>
            <div
            class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-4">
            <div class="text-muted text-small d-lg-none">Phone</div>
            <div class="text-alternate">' . $value->phone . '</div>
            </div>
            <div
            class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
            <div class="text-muted text-small d-lg-none">AREA</div>
            <div class="text-alternate">' . $value->location . '</div>
            </div>
            <div
            class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
            <div class="text-muted text-small d-lg-none">Create Date</div>
            <div class="text-alternate">' . $value->created_at->format('d M, Y') . '</div>
            </div>
            <div
            class="col-12 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-5">
            <div class="text-muted text-small d-lg-none mb-1">Status</div>
            <div>
            <input type="hidden" id="lead_id" value="' . $value->id . '">
            <select class="form-select form-select-sm Status">
            <option value="' . \App\Models\admin\Leads::HOT_LEAD . '" ' . ($value->status == 1 ? 'selected' : '') . '>Hot Lead</option>
            <option value="' . \App\Models\admin\Leads::NOT_GOOD_LEAD . '" ' . ($value->status == 2 ? 'selected' : '') . '>Not Good Lead</option>
            <option value="' . \App\Models\admin\Leads::LOST_LEAD . '" ' . ($value->status == 3 ? 'selected' : '') . '>Lost Lead</option>
            <option value="' . \App\Models\admin\Leads::NEW_LEAD . '" ' . ($value->status == 4 ? 'selected' : '') . '>New Lead</option>
            <option value="' . \App\Models\admin\Leads::FOLLOW_UP . '" ' . ($value->status == 5 ? 'selected' : '') . '>Follow Up</option>
            </select>
            </div>
            </div>
            </div>
            </div>
            </div>';
        }
        return $lead_html;
    }


    public function leadView($id)
    {
        $lead = Leads::with(['leadNotes', 'leadsActivity', 'leadWebsite.getDomain'])->find($id);
        $char = '';
        $nameParts = explode(' ', $lead->name, 2);
        foreach ($nameParts as $part) {
            $char .= strtoupper(substr($part, 0, 1));
        } 

        $urlArray = explode(',', $lead->url);

        $explore_image = LeadsWebsiteExploreImage::where('lead_website_id',$id)->get();
        if (Session::has('tab_name')) {
            $tab_name = Session('tab_name');
        } else {
            $tab_name = 'activity';  
        }

        Session::flash('tab', $tab_name);
        $data = [
            'data' => $lead, 
            'char' => $char, 
            'lead_notes' => $lead->leadNotes,
            'urls' => $urlArray,
            'leadWeb' =>  $lead->leadWebsite,
            'leadsActivity' => $lead->leadsActivity,
            'page_data' => json_decode($lead->leadWebsite->page_data),
            'generalInfo' => json_decode($lead->leadWebsite->general_info),
            'flyerData' => json_decode($lead->leadWebsite->flyer_data),
            'explore_image' => $explore_image
        ];

        return view('admin.Leads.view',$data);
    }

    public function edit($id){
        $lead_data = Leads::find($id);
        return view('admin.Leads.edit',['data' => $lead_data]);
    }

    public function addNotes(Request $request){

        $validator = Validator::make($request->all(),[
            'lead_id' => ['required','integer'],
            'note' => ['required','string'],
            'tagsBasic' => ['required','string','max:255'],
        ]);

        $request->session()->flash('tab_name', 'notes');
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $tagsString = $request->tagsBasic;
            $tagsArray = json_decode($tagsString);
            $arr = [];
            foreach ($tagsArray as $tag) {
                $arr[] = $tag->value;
            }
            $tags = implode(',', $arr);

            $id  =  LeadsNote::insert([
                        'lead_id' => $request->lead_id,
                        'note' => $request->note,
                        'tags' => $tags,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
            
            return back()->with('success','Notes have been successfully inserted!');
        }

    }

    public function importExcel(Request $request){

        $validator = Validator::make($request->all(), [
        'excel_file' => ['required', 'file', 'mimes:xls,xlsx']
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Error importing Excel file');
        } else {
            try {
                $leadWebsiteService = new LeadWebsiteService();
                Excel::import(new LeadsImport($leadWebsiteService), $request->file('excel_file'));
                return back()->with('success', 'Excel file has been imported successfully!');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                 if ($e->failures()) {

                      $failures = $e->failures();
                        $allErrors = [];
                         foreach ($failures as $failure) {
                             
                            $errors = $failure->errors();
                            $attribute = $failure->attribute();

                            $values = $failure->values();
                            $rows = $failure->row();
                            $arr_add = [$errors, $attribute, $values ,$rows];
                            array_push($allErrors, $arr_add);
                         }
                    $request->session()->flash('error', 'Validation Errors');
                    return back()->with('import_errors', $allErrors);
                 } else {
                   return back()->with('error', 'Something Went wrong !');
                 }
                
            }
        }  
    }

    public function updateWebsite(Request $request)
    {   
        if ($request->domain_id != 1) {
          $unique = Rule::unique('leads_website')->ignore($request->id);
        } else {
          $unique ='';
        }
        $rules =[
            'id' => ['required', 'integer'],
            'pageLink' => ['required', 'string'],
            'brand_name' => ['required', 'string'],
            'brand_bg_color' => ['required', 'string'],
            'customer_claim_code' => ['required', 'string','min:13'],
            'domain_id' => ['required','integer', $unique],
            'Heading' => ['required','string','max:255'],
            'SubText' => ['required','string','max:255'],
            'header_image' => ['image','mimes:jpeg,png,jpg'],
            'package_type' => ['required', 'string'],
            'About' => ['required','string'],
            'page_video' => ['file','mimes:mp4'],
            'video_link_1' => ['required','string'],
            'video_link_2' => ['required','string'],
            'plan_description' => ['required','string'],
            'plan_note' => ['required','string'],
            'class_description' => ['required','string'],
            'class_note' => ['required','string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'facebook_link' => ['required','string'],
            'twitter_link' => ['required','string'],
            'instagram_link' => ['required','string'],
            'flyer_URL' => ['required','string'],
            'flyer_type' => ['required','string'],
            'flyer_header_img' => ['image','mimes:jpeg,png,jpg'],
            'flyer_image_2' => ['image','mimes:jpeg,png,jpg'],
            'flyer_image_3' => ['image','mimes:jpeg,png,jpg'],
            'flyer_color' => ['required','string'],
            'flyer_phone' => ['required','string'],
            'lead_name' => ['required','string'],
            'flyer_message' => ['required','string'],
            'branded_site' => ['required','string'],
            'app' => ['required','string'],
        ];

        $validator = Validator::make($request->all(), $rules);
        $request->session()->flash('tab_name', 'brand_page');
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $id = $request->id;
            $pageLink = $request->pageLink;
            $brand_name = $request->brand_name;
            $brand_bg_color = $request->brand_bg_color;
            $customer_claim_code = $request->customer_claim_code;
            $domain_id = $request->domain_id;
            $heading = $request->Heading;
            $subText = $request->SubText;
            $header_image = $request->header_image;
            $package_type = $request->package_type;
            $about = $request->About;
            $page_video = $request->page_video;
            $video_link_1 = $request->video_link_1;
            $video_link_2 = $request->video_link_2;
            $plan_description = $request->plan_description;
            $plan_note = $request->plan_note;
            $class_description = $request->class_description;
            $class_note = $request->class_note;
            $email = $request->email;
            $phone = $request->phone;
            $facebook_link = $request->facebook_link;
            $twitter_link = $request->twitter_link;
            $instagram_link = $request->instagram_link;
            $flyer_URL = $request->flyer_URL;
            $flyer_type = $request->flyer_type;
            $flyer_header_img = $request->flyer_header_img;
            $flyer_image_2 = $request->flyer_image_2;
            $flyer_image_3 = $request->flyer_image_3;
            $flyer_color = $request->flyer_color;
            $flyer_phone = $request->flyer_phone;
            $lead_name = $request->lead_name;
            $flyer_message = $request->flyer_message;
            $branded_site = $request->branded_site;
            $app = $request->app;

            if ($pageLink == 'leadsdemo') {
                $domainId = 1;
            } else {
                $domain_length = Domain::where([['domain_name', '=', $pageLink],['id', '!=', $domain_id]])->count();

                if ($domain_length > 0) {
                    return back()->with('error','Domain name alredy taken');
                } else {
                    $domain_exist = Domain::where([['domain_name', '=', $pageLink]])->count();
                    if ($domain_exist > 0) {
                        $domainId = Domain::where('domain_name', $pageLink)->first()->id;
                    } else {
                        $domain = Domain::create([
                            'domain_name' => $pageLink,
                            'is_domain_type' => Domain::DOMAIN_LEAD_PAGE,
                            'status' => Domain::ACTIVE
                        ]);
                        $domainId = $domain->id;
                    }
                }
            } 

            if ($domainId) {

                $leadWeb = LeadWebsite::where('lead_id',$id)->first();

                if (!empty($header_image)) {
                    $headerName = time().".".$request->file('header_image')->getClientOriginalExtension();
                    $headerPath = $request->file('header_image')->storeAs('header_image',$headerName,'public');
                    $header_file_path = '/storage/'.$headerPath;
                } else {
                    $header_file_path = json_decode($leadWeb->page_data)->Header->HeaderImage;
                }

                if (!empty($page_video)) {
                    $pageVideo = time().".".$request->file('page_video')->getClientOriginalExtension();
                    $pageVideoPath = $request->file('page_video')->storeAs('page_video',$pageVideo,'public');
                    $page_video_file_path = '/storage/'.$pageVideoPath;
                } else {
                    $page_video_file_path = json_decode($leadWeb->page_data)->Video[0];
                }

                if (!empty($flyer_header_img)) {
                    $flyer_header_name = time().".".$request->file('flyer_header_img')->getClientOriginalExtension();
                    $flyer_header_path = $request->file('flyer_header_img')->storeAs('flyer_img',$flyer_header_name,'public');
                    $flyer_header_file_path = '/storage/'.$flyer_header_path;
                } else {
                    $flyer_header_file_path = json_decode($leadWeb->flyer_data)->HeaderImage;
                }

                 if (!empty($flyer_image_2)) {
                    $flyer_image_2 = time().".".$request->file('flyer_image_2')->getClientOriginalExtension();
                    $flyer_image_2_path = $request->file('flyer_image_2')->storeAs('flyer_img',$flyer_image_2,'public');
                    $flyer_image_2_file_path = '/storage/'.$flyer_image_2_path;
                } else {
                    $flyer_image_2_file_path = json_decode($leadWeb->flyer_data)->FlyerImage2;
                }

                if (!empty($flyer_image_3)) {
                    $flyer_image_3 = time().".".$request->file('flyer_image_3')->getClientOriginalExtension();
                    $flyer_image_3_path = $request->file('flyer_image_3')->storeAs('flyer_img',$flyer_image_3,'public');
                    $flyer_image_3_file_path = '/storage/'.$flyer_image_3_path;
                } else {
                    $flyer_image_3_file_path = json_decode($leadWeb->flyer_data)->FlyerImage3;
                }

                $page_array = ['Header' => ['Heading' => $heading,
                                            'SubText' => $subText,
                                            'HeaderImage' => $header_file_path ],
                               'PlanTypes' => [ $package_type ],
                               'About' => $about,
                               'Video' => [ 
                                            $page_video_file_path, 
                                            $video_link_1,
                                            $video_link_2 
                                          ] ];
                $page_data  =   json_encode($page_array);

                $genralInfoArray =  ['GeneralContact' => [
                                        'Email' => $email,
                                        'Phone' => $phone
                                    ],
                                    'SocialMedia' => [
                                        'FacebookLink' => $facebook_link,
                                        'TwitterLink' => $twitter_link,
                                        'InstagramLink' => $instagram_link
                                    ]
                                    ];
                $genralInfoData = json_encode($genralInfoArray);

                $flyer_array = [
                    'FlyerType' => $flyer_type,
                    'HeaderImage' => $flyer_header_file_path,
                    'FlyerImage2' => $flyer_image_2_file_path,
                    'FlyerImage3' => $flyer_image_3_file_path,
                    'FlyerURL' => $flyer_URL,
                    'color' => $flyer_color,
                    'Phone' => $flyer_phone,
                    'LeadName' => $lead_name,
                    'WelcomeMessage' => $flyer_message,
                    'BrandedSite' => $branded_site,
                    'APP' => $app
                ];

                $flyer_data = json_encode($flyer_array); 

                LeadWebsite::find($id)->update([
                    'domain_id' => $domainId,
                    'brand_name' => $brand_name,
                    'brand_bg_color' => $brand_bg_color,
                    'customer_claim_code' => $customer_claim_code,
                    'page_data' => $page_data,
                    'plan_description' => $plan_description,
                    'plan_note' => $plan_note,
                    'class_note' => $class_note,
                    'class_description' => $class_description,
                    'general_info' => $genralInfoData,
                    'flyer_data' => $flyer_data
                ]);

                return back()->with('success','successfully updated !');
            } 
        }
    }

    public function uploadExploreImage(Request $request){
        try{
            $web_id = $request->id;
            $explore_image = time().".".$request->file('file')->getClientOriginalExtension();
            $explore_image_path = $request->file('file')->storeAs('explore_image',$explore_image,'public');
            $explore_image_file_path = '/storage/'.$explore_image_path;

            LeadsWebsiteExploreImage::create([
                            'lead_website_id' => $web_id,
                            'explore_images' => $explore_image_file_path,
                        ]);
            
            return response()->json(['status' => true, 'message' => 'Image Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }    
    }


    public function deleteExploreImage(Request $request){
        try{
            $explore_image_id = $request->id;
          
            $ExploreImage = LeadsWebsiteExploreImage::find($explore_image_id);

            if (!$ExploreImage) {
                return response()->json(['status' => false, 'message' => 'Explore image not found']);
            }
            
            LeadsWebsiteExploreImage::find($explore_image_id)->delete();

            return response()->json(['status' => true, 'message' => 'Explore image deleted successfully!']);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }    
    }

    public function uploadPlanBgImage(Request $request){
        $web_id = $request->id;
        try{
            $LeadWebsite = LeadWebsite::find($web_id);
            if (!$LeadWebsite) {
                return response()->json(['status' => false, 'message' => 'Lead not found.']);
            }
            $plan_bg_image = time().".".$request->file('file')->getClientOriginalExtension();
            $plan_bg_image_path = $request->file('file')->storeAs('plan_bg_image',$plan_bg_image,'public');
            $plan_bg_image_file_path = '/storage/'.$plan_bg_image_path;

            LeadWebsite::find($web_id)->update([
                'plan_background_image' => $plan_bg_image_file_path
            ]);
            return response()->json(['status' => true, 'message' => 'Background image Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }    
    }

    public function uploadClassBgImage(Request $request){
        $web_id = $request->id;
        try{
            $LeadWebsite = LeadWebsite::find($web_id);
            if (!$LeadWebsite) {
                return response()->json(['status' => false, 'message' => 'Lead not found.']);
            }
            $class_bg_image = time().".".$request->file('file')->getClientOriginalExtension();
            $class_bg_image_path = $request->file('file')->storeAs('class_bg_image',$class_bg_image,'public');
            $class_bg_image_file_path = '/storage/'.$class_bg_image_path;

            LeadWebsite::find($web_id)->update([
                'class_background_image' => $class_bg_image_file_path
            ]);
            return response()->json(['status' => true, 'message' => 'Background image Updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }    
    }

    public function test(){

    $faker = Faker::create();

    // Use a loop to generate and insert fake data
    for ($i = 0; $i < 2000; $i++) { // Change 10 to the number of fake data records you want
        // $name = $faker->name;
        // $status = $faker->randomElement(['2', '1','3','4','5']); // Assuming 'status' is a random choice between 'Active' and 'Inactive'
        // $urls = $faker->url;
        // $location = $faker->city;
        // $company_name = $faker->company;
        // $address = $faker->address;
        // $email = $faker->unique()->safeEmail;
        // $phone = $faker->phoneNumber;

        // $leads_id = Leads::insertGetId([
        //     'name' => $name,
        //     'status' => $status,
        //     'url' => $urls,
        //     'location' => $location,
        //     'company_name' => $company_name,
        //     'address' => $address,
        //     'email' => $email,
        //     'phone' => $phone,
        //     'profile_image' => "assets/admin/img/profile/profile-11.webp",
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $tags = implode(',', $faker->words(rand(1, 5))); // Generate random words and join them with commas

        LeadsNote::insert([
            'lead_id' => $faker->numberBetween(1, 100), // Modify as needed
            'note' => $faker->paragraph(),
            'tags' => $tags,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    return "Fake data inserted into the 'leads' table.";

    }
}