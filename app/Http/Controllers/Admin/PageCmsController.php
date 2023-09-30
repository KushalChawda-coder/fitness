<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\{ PagesCms, PagesSections };
use App\Models\Domain;
use Illuminate\Support\Facades\{ Auth, Validator };
use App\Services\AjaxPagination\AjaxPagination;

class PageCmsController extends Controller
{
    protected $AjaxPagination;

    public function __construct(AjaxPagination $AjaxPagination)
    {
        $this->AjaxPagination = $AjaxPagination;
    }

    public function index(){

        $PagesCms = PagesCms::paginate(10);
        return view('admin.PageCms.index',['data' => $PagesCms]);
    }

    public function create(){

        return view('admin.PageCms.create');
    }

    private function validator($data){
   
        $rules = [
            'main_heading' => ['required','string','max:255'],
            'menu_text' => ['required','string','max:255'],
            'meta_title' => ['max:255'],
            'meta_friendly_url' => ['max:255'],
            'meta_description' => ['max:255'],
            'tagsBasic' => ['max:255']

        ]; 

        if (isset($data['page_id'])) {
            $rules['page_id'] = ['required','integer'];
            $rules['page_slug'] = ['required','string'];
        }

        if (isset($data['page_slug']) && $data['page_slug'] != "default") {
          
            if ($data['page_slug'] === "home") {

                $rules['headerBanner_name'] = ['required','string','max:255'];
                $rules['headerBanner_title'] = ['required','string','max:255'];
                $rules['headerBanner_sub_text'] = ['required','string','max:255'];
                $rules['headerBanner_action_btn'] = ['required','string','max:255'];
                $rules['headerBanner_action_page'] = ['required','string','max:255'];
                $rules['HeaderBannerImage'] = ['string','max:255'];
                $rules['feature_label'] = ['required','string','max:255'];
                $rules['feature_heading'] =  ['required','array','max:100'];
                $rules['feature_heading.*'] = ['required','string'];
                $rules['feature_subHeading'] =  ['required','array','max:100'];
                $rules['feature_subHeading.*'] =  ['required','string'];
                $rules['feature_btnLink'] = ['required','array','max:100'];
                $rules['feature_btnLink.*'] =  ['required','string'];
                $rules['feature_btnAction'] = ['required','array','max:100'];
                $rules['feature_btnAction.*'] =  ['required','string'];
                $rules['feature_images'] = ['required','array','max:100'];
                $rules['feature_images.*'] =  ['required','string','max:255'];
                $rules['livePreview_label'] = ['required','string','max:255'];
                $rules['livePreview_title'] =  ['required','array','max:100'];
                $rules['livePreview_title.*'] = ['required','string'];
                $rules['livePreview_description'] =  ['required','array','max:100'];
                $rules['livePreview_description.*'] =  ['required','required','string'];
                $rules['livePreview_actionPage'] = ['required','array','max:100'];
                $rules['livePreview_actionPage.*'] =  ['required','string'];
                $rules['livePreview_images'] = ['required','array','max:100'];
                $rules['livePreview_images.*'] =  ['required','string','max:255'];
                $rules['package_type'] =  ['required','array','max:100'];
                $rules['package_type.*'] = ['required','string'];
                $rules['package_price'] =  ['required','array','max:100'];
                $rules['package_price.*'] = ['required','integer'];
                $rules['package_duration'] =  ['required','array','max:100'];
                $rules['package_duration.*'] =  ['required','string'];
                $rules['package_clients'] = ['required','array','max:100'];
                $rules['package_clients.*'] =  ['required','integer'];
                $rules['package_storage'] = ['required','array','max:100'];
                $rules['package_storage.*'] =  ['required','integer'];
                $rules['exercises_label'] = ['required','string','max:255'];
                $rules['exercise_heading'] = ['required','string','max:255'];
                $rules['exercise_pages'] = ['required','integer','max:255'];
                $rules['exercise_image'] = ['required','string','max:255'];
                $rules['articles_label'] = ['required','string','max:255'];

            } else if($data['page_slug'] === "feature_deatils") {

                $rules['feature_label'] = ['required','string','max:255'];
                $rules['feature_heading'] =  ['required','string','max:255'];
                $rules['feature_subHeading'] =  ['required','string','max:255'];
                $rules['feature_description'] = ['required','string'];
                $rules['feature_btnLink'] =  ['required','string','max:255'];
                $rules['feature_btnAction'] = ['required','string','max:255'];
                $rules['feature_image'] = ['required','string','max:255'];

            } else if($data['page_slug'] === "signup") {

                $rules['signup_label'] = ['required','string','max:255'];
                $rules['signup_image'] = ['required','string','max:255'];

            } else if($data['page_slug'] === "exercise_database") {
                
                $rules['exerciseDatabase_label'] = ['required','string','max:255'];

            } else if($data['page_slug'] === "terms") {

                $rules['terms_label'] = ['required','string','max:255'];
                $rules['terms_sub_title'] = ['required','string','max:255'];
                $rules['terms_description'] = ['required','string'];
            } else if($data['page_slug'] === "privacy") {

                $rules['privacy_label'] = ['required','string','max:255'];
                $rules['privacy_sub_title'] = ['required','string','max:255'];
                $rules['privacy_description'] = ['required','string'];

            } else if($data['page_slug'] === "footer") {

                $rules['footer_label'] = ['required','string','max:255'];
                $rules['footer_facebookLink'] = ['required','string','max:255'];
                $rules['footer_twittersLink'] = ['required','string','max:255'];
                $rules['footer_instagramLink'] = ['required','string','max:255'];
            }   
            
        } else {

            $rules['headerBanner_name'] = ['required','string','max:255'];
            $rules['headerBanner_title'] = ['required','string','max:255'];
            $rules['headerBanner_sub_text'] = ['required','string','max:255'];
            $rules['headerBanner_action_btn'] = ['required','string','max:255'];
            $rules['headerBanner_action_page'] = ['required','string','max:255'];
            $rules['HeaderBannerImages'] = ['required','array','max:100'];
            $rules['HeaderBannerImages.*'] =  ['required','string','max:255'];
            $rules['knowMore_name'] = ['required','string','max:255'];
            $rules['knowMore_content'] = ['required'];
            $rules['knowMore_action_btn'] = ['required','string','max:255'];
            $rules['knowMore_action_page'] = ['required','string','max:255'];
            $rules['whatWeDo_name'] = ['required','string','max:255'];
            $rules['WhatWeDo_description'] = ['required'];
            $rules['whatWeDo_package_type'] = ['required','array','max:100'];
            $rules['whatWeDo_package_type.*'] = ['required', 'string'];
            $rules['whatWeDo_action_btn_text'] = ['required','array','max:100'];
            $rules['whatWeDo_action_btn_text.*'] = ['required','string','max:255'];
            $rules['whatWeDo_action_page'] = ['required','array','max:100'];
            $rules['whatWeDo_action_page.*'] = ['required','string','max:255'];
            $rules['explore_name'] = ['required','string','max:255'];
            $rules['explore_banner_text'] = ['required','string','max:255'];
            $rules['ExploreGallery'] = ['required','array','max:100'];
            $rules['ExploreGallery.*'] =  ['required',  'string','max:255'];
        }
            

        return $validator = Validator::make($data, $rules);
    }

    public function store(Request $request){
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput();
        } else {

            $main_heading = $request->main_heading;  
            $menu_text = $request->menu_text;  
            $headerBanner_name = $request->headerBanner_name; 
            $headerBanner_status = $request->headerBanner_status; 
            $headerBanner_title = $request->headerBanner_title;  
            $headerBanner_sub_text = $request->headerBanner_sub_text;  
            $headerBanner_action_btn = $request->headerBanner_action_btn;  
            $headerBanner_action_page = $request->headerBanner_action_page;  
            $HeaderBannerImages = array_values($request->HeaderBannerImages);
            $knowMore_name = $request->knowMore_name;  
            $knowMore_status = $request->knowMore_status;  
            $knowMore_content = $request->knowMore_content;  
            $knowMore_action_btn = $request->knowMore_action_btn;  
            $knowMore_action_page = $request->knowMore_action_page;  
            $whatWeDo_name = $request->whatWeDo_name;  
            $whatWeDo_status = $request->whatWeDo_status;  
            $WhatWeDo_description = $request->WhatWeDo_description;  
            $whatWeDo_package_type = $request->whatWeDo_package_type;  
            $whatWeDo_action_btn_text = $request->whatWeDo_action_btn_text;  
            $whatWeDo_action_page = $request->whatWeDo_action_page;  
            $explore_name = $request->explore_name;  
            $explore_status = $request->explore_status;  
            $explore_banner_text = $request->explore_banner_text; 
            $ExploreGallery = array_values($request->ExploreGallery); 
            $page_title = $request->page_title;  
            $friendly_url = $request->friendly_url;  
            $meta_description = $request->meta_description;  
            $tagsBasic = $request->tagsBasic; 

            $metaTagArray = json_decode($tagsBasic);
            $arr = [];
            foreach ($metaTagArray as $tag) {
                $arr[] = $tag->value;
            }
            $metaTags = implode(',', $arr);


            $pages_cms = PagesCms::create([
              'user_id' => Auth::user()->id,
              'name' => $main_heading,
              'slug' => 'default',
              'meta_title' => $page_title,
              'meta_friendly_url' => $friendly_url,
              'meta_description' => $meta_description,
              'meta_tags' => $metaTags,
              'status' => 1
            ]);

            if ($pages_cms) {

                $packages = [];
                foreach($whatWeDo_package_type as $i => $value){
                    $package_arr = [
                        'PackageType' => $value,
                        'ActionBtn' => $whatWeDo_action_btn_text[$i],
                        'ActionPage' => $whatWeDo_action_page[$i]
                    ];

                array_push($packages, $package_arr);

                }
                $data = [
                        'PageContent' => [
                                'MainHeading' => $main_heading,
                                'MenuText' => $menu_text
                            ],
                            'Section' => [
                                'HeaderBanner' => [
                                    'LabelName' => $headerBanner_name,
                                    'Status' => $headerBanner_status,
                                    'Title' => $headerBanner_title,
                                    'SubText' => $headerBanner_sub_text,
                                    'ActionBtn' => $headerBanner_action_btn,
                                    'ActionPage' => $headerBanner_action_page,
                                    'Images' =>  $HeaderBannerImages 
                                ],
                                'KnowMore' => [
                                    'LabelName' => $knowMore_name,
                                    'Status' => $knowMore_status,
                                    'Description' => $knowMore_content,
                                    'ActionBtn' => $knowMore_action_btn,
                                    'ActionPage' => $knowMore_action_page
                                ],
                                'WhatWeDo' => [
                                    'LabelName' => $whatWeDo_name,
                                    'Status' => $whatWeDo_status,
                                    'Description' => $WhatWeDo_description,
                                    'Packages'=> $packages
                                ],
                                'Explore' => [
                                    'LabelName' => $explore_name,
                                    'Status' => $explore_status,
                                    'HeaderText' => $explore_banner_text,
                                    'Images' =>  $ExploreGallery 
                                ]
                            ]
                        ];

                $pages_cms_json = json_encode($data);

                PagesSections::create([
                  'page_cms_id' => $pages_cms->id,
                  'section_id' => '1',
                  'page_section_data' => $pages_cms_json,
                  'status' => 1
                ]);
            }

            return back()->with('success','New page has been successfully inserted!');
        }
        
    }

    public function UploadImage(Request $request){

        if ($request->ajax()) {
            try{

                $fileName = time().".".$request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')->storeAs('page_cms_image',$fileName,'public');
                $file_path = '/storage/'.$path;

                return response()->json(['status' => true,'file_path' => $file_path]);
               
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something went wrong !']);
            }
        }
        
    }

    public function edit($id){

        try{
            $page = PagesCms::with('getPageSection')->find($id);
            $domain_list = Domain::select('domain_name')->whereNull('coach_id')->where('is_domain_type', Domain::DOMAIN_LANDING_PAGE)->orWhere('is_domain_type', Domain::DOMAIN_STATIC_PAGE)->get();
            $data = [
                     'page' => $page,
                     'page_section' => json_decode($page->getPageSection->page_section_data),
                     'domains' => $domain_list
                 ];
            return view('admin.PageCms.view.'.$page->slug,$data);
               
        } catch (\Exception $e) {
            dd($e);
             return back()->with('error','Something Went wrong !');
        }
        
    }

    public function update(Request $request){
        
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->with('error','Validation Error Detected !');
        } else {

            $page_cms = PagesCms::find($request->page_id)->first();

            $page_section = PagesSections::where('page_cms_id', $request->page_id)->first();
            $page_section_data = json_decode($page_section->page_section_data);

            $page_content =  [
                                'MainHeading' => $request->main_heading,
                                'MenuText' => $request->menu_text
                            ];

            if ($request->page_slug === "home") {
                
                $features = [];
                foreach($request->feature_heading as $i => $value){
                    $feature_arr = [
                        'Image' => $request->feature_images[$i] ?? null,
                        'Heading' => $value,
                        'SubHeading' => $request->feature_subHeading[$i],
                        'ButtonLink' => $request->feature_btnLink[$i],
                        'ActionPage' => $request->feature_btnAction[$i]
                    ];

                    array_push($features, $feature_arr);
                }

                $livePreviews = [];
                foreach($request->livePreview_title as $i => $value){
                    $livePreview_arr = [
                        'Title' => $value,
                        'Description' => $request->livePreview_description[$i],
                        'Image' => $request->livePreview_images[$i] ?? null,
                        'ActionPage' => $request->livePreview_actionPage[$i]
                    ];

                    array_push($livePreviews, $livePreview_arr);
                }

                $packages = [];
                foreach($request->package_type as $i => $value){
                    $package_arr = [
                        'PackageType' => $value,
                        'Price' => $request->package_price[$i],
                        'Duration' => $request->package_duration[$i],
                        'UpToClients' => $request->package_clients[$i],
                        'Storage' => $request->package_storage[$i]
                    ];

                    array_push($packages, $package_arr);
                }

                $homeSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'HeaderBanner' => [
                                    'LabelName' => $request->headerBanner_name,
                                    'Status' =>  $request->headerBanner_status ?? false,
                                    'Title' => $request->headerBanner_title,
                                    'SubText' => $request->headerBanner_sub_text,
                                    'ActionBtn' => $request->headerBanner_action_btn,
                                    'ActionPage' => $request->headerBanner_action_page,
                                    'file' => !empty($request->HeaderBannerImage) ? $request->HeaderBannerImage : $page_section_data->Section->HeaderBanner->file

                                ],
                                'Feature' => [
                                    'LabelName' => $request->feature_label,
                                    'Status' => $request->feature_status ?? false,
                                    'Content' =>  $features 
                                ],
                                'LivePreview' => [
                                    'LabelName' => $request->livePreview_label,
                                    'Status' =>  $request->livePreview_labelStatus ?? false,
                                    'Content' =>  $livePreviews 
                                ],
                                'Pricing' =>  $packages,
                                'Exercises' => [
                                    'LabelName' => $request->exercises_label,
                                    'Status' =>  $request->exercises_labelStatus ?? false,
                                    'Image' => !empty($request->exercise_image) ? $request->exercise_image : $page_section_data->Section->Exercises->Image,
                                    'Heading' => $request->exercise_heading,
                                    'Pages' => $request->exercise_pages
                                ],
                                'Articles' => [
                                    'LabelName' => $request->articles_label,
                                    'Status' => $request->articles_labelStatus ?? false
                                ]
                            ]
                        ];
                $data  = json_encode($homeSection);
                
            } else if ($request->page_slug === "feature_deatils") {

                $featureSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'Feature' => [
                                    'LabelName' => $request->feature_label,
                                    'Content' => [
                                            'Image' => !empty($request->feature_image) ? $request->feature_image : $page_section_data->Section->feature->Content->Image,
                                            'Heading' => $request->feature_heading,
                                            'SubHeading' => $request->feature_subHeading,
                                            'Description' => $request->feature_description,
                                            'ButtonLink' => $request->feature_btnLink,
                                            'ActionPage' => $request->feature_btnAction
                                    ]
                                ]
                            ]
                        ];
                $data  = json_encode($featureSection);
                
            } else if ($request->page_slug === "signup") {

                $signupSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'Signup' => [
                                    'LabelName' => $request->signup_label,
                                    'Content' => [
                                            'Image' => !empty($request->signup_image) ? $request->signup_image : $page_section_data->Section->Signup->Content->Image,
                                    ]
                                ]
                            ]
                        ];
                $data  = json_encode($signupSection);
                
            } else if ($request->page_slug === "exercise_database") {

                $exerciseDatabaseSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'ExerciseDatabase' => [
                                    'LabelName' => $request->exerciseDatabase_label
                                ]
                            ]
                        ];
                $data  = json_encode($exerciseDatabaseSection);
                
            } else if ($request->page_slug === "terms") {

                $termsSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'Terms' => [
                                    'LabelName' => $request->terms_label,
                                    'Content' => [
                                            'Title' => $request->terms_sub_title,
                                            'Description' => $request->terms_description
                                    ]
                                ]
                            ]
                        ];
                $data  = json_encode($termsSection);

            } else if ($request->page_slug === "privacy") {

                $privacySection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'Privacy' => [
                                    'LabelName' => $request->privacy_label,
                                    'Content' => [
                                            'Title' => $request->privacy_sub_title,
                                            'Description' => $request->privacy_description
                                    ]
                                ]
                            ]
                        ];
                $data  = json_encode($privacySection);
                
            } else if ($request->page_slug === "footer") {

                $footerSection = [
                            'PageContent' => $page_content,
                            'Section' => [
                                'Footer' => [
                                    'LabelName' => $request->footer_label,
                                    'Content' => [
                                            'Facebook' => $request->footer_facebookLink,
                                            'Twitters' => $request->footer_twittersLink,
                                            'Instagram' => $request->footer_instagramLink
                                    ]
                                ]
                            ]
                        ];
                $data  = json_encode($footerSection);
                
            } else if ($request->page_slug === "default") {

                $packages = [];
                foreach($request->whatWeDo_package_type as $i => $value){
                    $package_arr = [
                        'PackageType' => $value,
                        'ActionBtn' => $request->knowMore_action_btn[$i],
                        'ActionPage' => $request->whatWeDo_action_page[$i]
                    ];
                }
                array_push($packages, $package_arr);

                $defaultSection = [
                                    'PageContent' => $page_content,
                                        'Section' => [
                                            'HeaderBanner' => [
                                                'LabelName' => $request->headerBanner_name,
                                                'Status' => $request->headerBanner_status ?? false,
                                                'Title' => $request->headerBanner_title,
                                                'SubText' => $request->headerBanner_sub_text,
                                                'ActionBtn' => $request->headerBanner_action_btn,
                                                'ActionPage' => $request->headerBanner_action_page,
                                                'Images' => array_values($request->HeaderBannerImages)
                                            ],
                                            'KnowMore' => [
                                                'LabelName' => $request->knowMore_name,
                                                'Status' => $request->knowMore_status,
                                                'Description' => $request->knowMore_content,
                                                'ActionBtn' => $request->knowMore_action_btn,
                                                'ActionPage' => $request->knowMore_action_page
                                            ],
                                            'WhatWeDo' => [
                                                'LabelName' => $request->whatWeDo_name,
                                                'Status' => $request->whatWeDo_status ?? false,
                                                'Description' => $request->WhatWeDo_description,
                                                'Packages' => $packages

                                            ],
                                            'Explore' => [
                                                'LabelName' => $request->explore_name,
                                                'Status' => $request->explore_status ?? false,
                                                'HeaderText' => $request->explore_banner_text,
                                                'Images' => array_values($request->ExploreGallery) 
                                            ]
                                        ]
                                    ];
                $data  = json_encode($defaultSection);
            }

            $metaTagArray = json_decode($request->tagsBasic);
            $arr = [];
            foreach ($metaTagArray as $tag) {
                $arr[] = $tag->value;
            }
            $metaTags = implode(',', $arr);


            PagesCms::find($request->page_id)->update([
                'meta_title' =>  $request->meta_title ?? $page_cms->meta_title ,
                'meta_friendly_url' =>  $request->meta_friendly_url ?? $page_cms->meta_friendly_url ,
                'meta_description' =>   $request->meta_description ?? $page_cms->meta_description ,
                'meta_tags' =>   $metaTags ?? $page_cms->meta_tags 
            ]);

         
            PagesSections::where('page_cms_id', $request->page_id)->update([
              'page_section_data' => $data,
            ]);

            return back()->with('success','Page has been successfully updated!');
        }

    }


    public function search(Request $request, AjaxPagination $AjaxPagination){
        if ($request->ajax()) {
            try{
                $s = $request->Search_text;
                if (empty($request->Search_text)) {
                    $pageCms = PagesCms::paginate(10);
                } else {
                    $pageCms = PagesCms::when($s,function ($query) use($s){
                        $query->where('name', 'like', '%' . $s . '%' );
                    })->paginate(10);
                }
                if ($pageCms->isEmpty()) {
                    $pageCms_html='<p class="text-center mb-0 mt-5 pt-5">'. _('Data Not Found!') .'</p>';
                    $pagination_html='<div></div>';
                    return response()->json(['status' => true, 'pageCms_html' => $pageCms_html,
                        'pagination_html' => $pagination_html]);
                } else {
                    return response()->json(['status' => true, 'pageCms_html' => $this->getTable($pageCms),'pagination_html' => $this->AjaxPagination->getPagination($pageCms,$request->page)]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Something went wrong !']);
            }
        }
    }

    private function getTable($search) {
        $pageCms = "";

        foreach ($search as $page) {
            $pageCms .= '<div class="card mb-2">
            <div class="card-body pt-md-0 pb-md-0 sh-md-8">
                <div class="row g-0 h-100 align-content-center">
                    <div class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                        <div class="text-muted text-small d-md-none">Name</div>
                        <div class="text-alternate">
                            <a href="' . route('pagecms.edit', ['id' => $page->id]) . '">' . $page->name . '</a>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                        <div class="text-muted text-small d-md-none">Status</div>
                        <div class="text-alternate">
                            <span class="badge rounded-pill bg-outline-primary">' . ($page->status == 1 ? 'PUBLISH' : 'DRAFT') . '</span>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                        <div class="text-muted text-small d-md-none">Action</div>
                        <div class="text-alternate">
                            <!-- Dropdown Button Start -->
                            <div class="ms-1">
                                <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light"
                                    data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-submenu>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-more-horizontal undefined"><path d="M9 10C9 9.44772 9.44772 9 10 9V9C10.5523 9 11 9.44772 11 10V10C11 10.5523 10.5523 11 10 11V11C9.44772 11 9 10.5523 9 10V10zM2 10C2 9.44772 2.44772 9 3 9V9C3.55228 9 4 9.44772 4 10V10C4 10.5523 3.55228 11 3 11V11C2.44772 11 2 10.5523 2 10V10zM16 10C16 9.44772 16.4477 9 17 9V9C17.5523 9 18 9.44772 18 10V10C18 10.5523 17.5523 11 17 11V11C16.4477 11 16 10.5523 16 10V10z"></path></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button">Copy</button>
                                    <button class="dropdown-item" type="button">Delete</button>
                                </div>
                            </div>
                            <!-- Dropdown Button End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }

        return $pageCms;
    }


    public function setRedirectPage(Request $request)
    {
        $page_id = $request->page_id;
        $page_name = $request->page_name;
        $status = $request->status;

        try{
            $page = PagesCms::find($page_id);
            if (!$page) {
                return response()->json(['status' => false, 'message' => 'Page not found.']);
            }

            $update = [];
            $update['is_redirect'] = ($status == 0) ? false : true;
            if (!empty($page_name)) {
                $update['redirect_at'] = $page_name;
            }

            $page->update($update);

            return response()->json(['status' => true, 'message' => 'Redirect set successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went wrong !']);
        }
    }



}
