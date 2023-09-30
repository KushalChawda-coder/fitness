<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\admin\{ LandingPage, PagesSections ,PagesCms } ;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = PagesCms::with('getPageSection')->find(1);
        if ($page->is_redirect == 0) {

            $section = json_decode($page->getPageSection->page_section_data)->Section;
            $data = [
                     // 'page' => $page,
                     'page_section' => json_decode($page->getPageSection->page_section_data),
                     'HeaderBanner'  => $section->HeaderBanner,
                     'Feature'  => $section->Feature,
                     'LivePreview'  => $section->LivePreview,
                     'Pricing'  => $section->Pricing,
                     'Exercises'  => $section->Exercises,
                     'Articles'  => $section->Articles,
                 ];

           return view('front.index',$data);
            
        } else {
            return redirect($page->redirect_at);
        }
    }


    public function checkDomain($domain)
    {
       if ($domain) {
            $getDomain = Domain::where('domain_name',$domain)->first();
            if (!empty($getDomain) && !isset($getDomain->coach_id)) {
                $data = LandingPage::where('domain_id',$getDomain->id)->where('status', LandingPage::PUBLISHED)->first();
                if (!$data) {
                    return redirect()->back()->with('error','Page data not found');
                }
                $column_name = explode(',', $data->lead_collection_column);
                $pageName = 'landing_'.$data->landing_page_type;

                return view('landingTemplate.'.$pageName,  compact('data','column_name'));
            } else {
                return redirect()->route('home');
            }
       } else {
            return redirect()->route('home');
       }
    }

}
