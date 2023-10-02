<?php

namespace App\Imports;

use App\Models\admin\Leads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use App\Models\admin\ { LeadWebsite, LeadsActivity };
use App\Services\Leads\LeadWebsiteService;

class LeadsImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
{

    protected $LeadWebsiteService;

    public function __construct(LeadWebsiteService $LeadWebsiteService)
    {
        $this->leadWebsiteService = $LeadWebsiteService;
    }

    public function model(array $row)
    {
        $lead = new Leads([
            'name' => $row['name'],
            'url'  => $row['url'],
            'company_name' => $row['company_name'],
            'location' => $row['location'],
            'address' => $row['address'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'status' => $row['status'],
            'profile_image' => 'assets/admin/img/profile/profile-11.webp'
        ]);

        $lead->save(); 
        $lead_id = $lead->id; 

        LeadWebsite::create([
            'lead_id' => $lead_id,
            'domain_id' => 1,
            'brand_name' => $row['company_name'], 
            'brand_logo' => 'assets/admin/plan-img/logo-edit-removebg.png',
            'brand_bg_color' => '#d31876',
            'customer_claim_code' => Str::upper(Str::random(3, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')) . '-' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'page_data' => $this->leadWebsiteService->getPageJson(),
            'plan_note' => 'The plan you have marked as visible from your product list will show up here.',
            'plan_description' => $this->leadWebsiteService->getDescription(),
            'plan_background_image' => '/assets/admin/img/product/large/product-1.webp',
            'class_note' => 'The classes you have marked as visible from your class list will show up here.',
            'class_description' => $this->leadWebsiteService->getDescription(),
            'class_background_image' => '/assets/admin/img/product/large/product-1.webp',
            'general_info' => $this->leadWebsiteService->getGenralInfoJson($row['email'], $row['phone']),
            'flyer_data' => $this->leadWebsiteService->getFlyerJson($row['phone'], $row['name']),
            'reason' => '',
            'wesite_status' => 1,
        ]);

        LeadsActivity::create([
            'lead_id' => $lead_id,
            'status' => LeadsActivity::ACCOUNT_CREATED,
        ]);

        return $lead;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'company_name' => 'required',
            'location' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'required|unique:leads,phone',
            'status' => 'required',
        ];
    }


}
