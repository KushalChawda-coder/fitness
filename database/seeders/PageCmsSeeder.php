<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin\PagesCms;

class PageCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pages = [
            [
             'id' => 1,
             'user_id' => 1,
             'name' => 'Home',
             'slug' => 'home',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 2,
             'user_id' => 1,
             'name' => 'Client Management',
             'slug' => 'feature_deatils',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 3,
             'user_id' => 1,
             'name' => 'Personalize Your Brand',
             'slug' => 'feature_details',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 4,
             'user_id' => 1,
             'name' => 'Seamless Payment Integration',
             'slug' => 'feature_details',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 5,
             'user_id' => 1,
             'name' => 'Versatile Workout Library',
             'slug' => 'feature_details',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 6,
             'user_id' => 1,
             'name' => 'Signup',
             'slug' => 'signup',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 7,
             'user_id' => 1,
             'name' => 'Exercise Database',
             'slug' => 'exercise_database',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 8,
             'user_id' => 1,
             'name' => 'Terms',
             'slug' => 'terms',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 9,
             'user_id' => 1,
             'name' => 'Privacy',
             'slug' => 'privacy',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ],
            [
             'id' => 10,
             'user_id' => 1,
             'name' => 'Footer',
             'slug' => 'footer',
             'meta_title' => 'Fitness Plan App',
             'meta_friendly_url' => 'fitnessandmealplans.com',
             'meta_description' => 'This is a place where user can go and get their website to host their Fitness Plan App.',
             'meta_tags' => 'Meal Plans, Fitness Plan',
             'status' => 1
            ]
            ];

            foreach ($pages as $pageData) {
                PagesCms::create($pageData);
            }


    }
}
