<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domain::insert([
            [
                'domain_name'    => 'leadsdemo',
                'is_domain_type'    => Domain::DOMAIN_LEAD_PAGE,
                'status'     => Domain::ACTIVE
            ],
            [
                'domain_name'    => 'flyerdemo',
                'is_domain_type'    => Domain::DOMAIN_FLYER_PAGE,
                'status'     => Domain::ACTIVE
            ]
        ]);

    }
}
