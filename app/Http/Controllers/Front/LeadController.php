<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\admin\{ Leads, LeadsNote, LeadWebsite ,LeadsActivity, DigitalFiles };
use Illuminate\Validation\Rule;
use App\Notifications\{ LeadVerifyEmail, ThankyouEmail };
use App\Notifications\DigitalFileEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\{ Arr, Str };
use App\Services\Leads\LeadWebsiteService;
use App\Rules\Recaptcha;


class LeadController extends Controller
{
    protected $LeadWebsiteService;

    public function __construct(LeadWebsiteService $LeadWebsiteService)
    {

        $this->leadWebsiteService = $LeadWebsiteService;
    }

    private function validator($data){
      
      $rules  = [
            'name' => ['required','string','max:255'],
            'company_name' => ['max:255'],
            'email' => ['required','string','max:255'],
            'phone' => ['max:12'],
            'current_website' => ['max:255'],
            'instagram_url' => ['max:255'],
            'facebook_url' => ['max:255'],
            'other_social_link' => ['max:255'],
            'additional_info' => ['max:255'],
            'g-recaptcha-response' => [new Recaptcha],
        ];
       
        return $validator = Validator::make($data, $rules);
    }



    public function store(Request $request)
    {   
        if ($this->validator($request->all())->fails()) {
            return back()->withErrors($this->validator($request->all()))->withInput();
        } else {

            $urls = $request->current_website;
            $verification_code = rand(100000,999999);
            $name = $request->name;
            $company_name = $request->company_name ?? '';
            $email = $request->email ?? '';
            $phone = $request->phone ?? '';
            $here_about_us = $request->here_about_us ?? '';
            $instagram_url = $request->instagram_url ?? '';
            $facebook_url = $request->facebook_url ?? '';
            $other_social_link = $request->other_social_link ?? '';
            $additional_info = $request->additional_info ?? '';
            $digital_files = $request->digital_files ?? '';
            $status = $request->status ?? LeadsActivity::LEAD_ADDED_LANDING;

            $checkLead = Leads::where('email', $email)->first();

            if (empty($checkLead)) {
                $leadDeatils = Leads::create([
                    'name' => $name,
                    'status' => Leads::NEW_LEAD,
                    'url' => $urls,
                    'location' =>'USA',
                    'company_name' => $company_name,
                    'address' => 'USA',
                    'email' => $email,
                    'phone' => $phone,
                    'profile_image' => "assets/admin/img/profile/profile-11.webp",
                    'here_about_us' => $here_about_us,
                    'here_about_description' => $here_about_us == 'other' ? $request->here_about_description : '',
                    'instagram_url' => $instagram_url ?? '',
                    'facebook_url' => $facebook_url ?? '',
                    'other_social_link' => $other_social_link ?? '',
                    'additional_info' => $additional_info ?? '',
                    'digital_files' => $digital_files ?? '',
                    'verification_code' => $verification_code
                ]);
                $lead_id = $leadDeatils->id;
                if ($lead_id) { 
                   
                    LeadWebsite::create([
                      'lead_id' => $leadDeatils->id,
                      'domain_id' => 1,
                      'brand_name' => $company_name,
                      'brand_logo' => 'assets/admin/plan-img/logo-edit-removebg.png',
                      'brand_bg_color' => '#d31876',
                      'customer_claim_code' => Str::random(3) .'-'. rand(1000, 9999) .'-'. rand(1000, 9999),
                      'page_data' =>  $this->leadWebsiteService->getPageJson(),
                      'plan_note' => 'The plan you have marked as visible from your product list will show up here.',
                      'plan_description' => $this->leadWebsiteService->getDescription(),
                      'plan_background_image' => 'cupcake.jpg',
                      'class_note' => 'The classes you have marked as visible from your class list will show up here.',
                      'class_description' => $this->leadWebsiteService->getDescription(),
                      'class_background_image' => 'cupcake.jpg',
                      'general_info' => $this->leadWebsiteService->getGenralInfoJson($email,$phone),
                      'flyer_data' => $this->leadWebsiteService->getFlyerJson($phone, $name),
                      'reason' => '',
                      'wesite_status' => 1
                    ]);

                    LeadsActivity::create([
                      'lead_id' => $leadDeatils->id,
                      'status' => $status
                    ]);

                }
            } else {
                $lead_id = $checkLead->id;
                $leadDeatils = Leads::find($checkLead->id)->update([
                    'name' => $name,
                    'status' => Leads::NEW_LEAD,
                    'url' => $urls,
                    'company_name' => $company_name,
                    'email' => $email,
                    'phone' => $phone,
                    'here_about_us' => $here_about_us,
                    'here_about_description' => $here_about_us == 'other' ? $request->here_about_description : '',
                    'instagram_url' => $instagram_url ?? '',
                    'facebook_url' => $facebook_url ?? '',
                    'other_social_link' => $other_social_link ?? '',
                    'additional_info' => $additional_info ?? '',
                    'digital_files' => $digital_files ?? '',
                    'verification_code' => $verification_code
                ]);

                LeadsActivity::create([
                  'lead_id' => $lead_id,
                  'status' => $status
                ]);

                $leadDeatils = Leads::where('id',$checkLead->id)->first();
            }

            $leadDeatils->notify(new LeadVerifyEmail($leadDeatils) );
            if ($status == LeadsActivity::REQUEST_E_BOOK) {
                $files = explode(',', $digital_files);
                $file_link = [];
                foreach ($files as $key => $value) {
                    $data = DigitalFiles::select('upload_file')->where('file_name', $value)->first();
                    if($data->upload_file){
                        array_push($file_link, $data->upload_file);
                    }
                }
                $leadDeatils->notify(new DigitalFileEmail($file_link) );
            }
            

            $previousUrl = url()->previous(); // Get the previous URL
            $queryParameters = [
                'lead_id' => $lead_id
            ];

            $redirectUrl = $previousUrl . '?' . http_build_query($queryParameters);
            return Redirect::to($redirectUrl);

        }

    }


    public function emailVerify(Request $request)
    {
        $lead_id = $request->id;
        $verify_code = $request->verify_code;
        $redirectUrl = $request->page_url;

        $lead_data = Leads::where('id', $lead_id)->where('verification_code', $verify_code)->first();

        if(!$lead_data){
            return redirect()->back()->with('error','Verify Code invalid.');
        }
        $lead_data->email_verified_at = Carbon::now();
        $lead_data->verification_code = null;
        $lead_data->save();

        $lead_data->notify(new ThankyouEmail());

        return redirect($redirectUrl)->with('success','Your Email verify successfully verified');
       
    }


    public function requestEmailAgain(Request $request)
    {
        $lead_id = $request->id;
        $verification_code = rand(100000,999999);

        $lead_data = Leads::where('id', $lead_id)->update(['verification_code' => $verification_code]);
        $leadDeatils = Leads::where('id',$lead_id)->first();

        $leadDeatils->notify(new LeadVerifyEmail($leadDeatils) );

        if(!$lead_data){
            return response()->json(['status' => false, 'message' => 'Something Went Wrong !']);
        }
        return response()->json(['status' => true, 'message' => 'Verification code sent successfully']);   
    }


}