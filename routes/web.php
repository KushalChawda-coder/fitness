<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageCmsController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\ManageExercisesController;
use App\Http\Controllers\Front\LeadController as FrontLeadController;
use App\Http\Controllers\Coach\DashboardController as CoachDashboardController;
use App\Http\Controllers\Admin\DigitalFilesController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });.

// Normal Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);
Route::get('/verify-email/{id}', [VerificationController::class, 'index'])->name('verify-email');
Route::post('/verify-success', [VerificationController::class, 'verifyEmail'])->name('register-verify-email');
Route::post('/request_mail_again', [VerificationController::class, 'requestEmailAgain'])->name('request_mail_again');

Route::post('/generate_lead', [FrontLeadController::class, 'store'])->name('generate_lead');
Route::post('/lead_email_verify', [FrontLeadController::class, 'emailVerify'])->name('lead_email_verify');
Route::post('/request_email_again', [FrontLeadController::class, 'requestEmailAgain'])->name('request_email_again');


// Subdomain
Route::get('/{domain}', [App\Http\Controllers\HomeController::class, 'checkDomain'])->name('checkDomain');






Route::middleware('auth')->group(function () {
    /* Admin */
    Route::middleware('role:1')->group(function (){
        Route::prefix('admin')->group(function () {

            Route::prefix('dashboard')->group(function (){
                Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
            });

            Route::prefix('leads')->group(function (){
                Route::any('/', [LeadController::class, 'index'])->name('leads.index');
                Route::get('/leads-add', [LeadController::class, 'addLeads'])->name('leads.add');
                Route::post('/store', [LeadController::class, 'store'])->name('leads.store');
                Route::post('/lead_status', [LeadController::class, 'updateStatus'])->name('leads.status');
                Route::post('/lead_search', [LeadController::class, 'searchLeads'])->name('leads.search');
                Route::get('/lead_page', [LeadController::class, 'getLeadAjax'])->name('leads.page');
                Route::get('/lead_details/{id}', [LeadController::class, 'leadView'])->name('leads.details');
                Route::get('/edit/{id}', [LeadController::class, 'edit'])->name('leads.edit');
                Route::post('/update', [LeadController::class, 'update'])->name('leads.update');
                Route::post('/add_notes', [LeadController::class, 'addNotes'])->name('leads.add-notes');
                Route::post('/import-excel', [LeadController::class, 'importExcel'])->name('leads.import-excel');   
                Route::any('/lead-filter', [LeadController::class, 'filter'])->name('leads.lead-filter');
                Route::post('/update-website', [LeadController::class, 'updateWebsite'])->name('leads.update-website');
                Route::post('/upload-exploreImage', [LeadController::class, 'uploadExploreImage'])->name('leads.upload-exploreImage');
                Route::post('/delete-exploreImage', [LeadController::class, 'deleteExploreImage'])->name('leads.delete-exploreImage');


                Route::post('/upload-planBgImage', [LeadController::class, 'uploadPlanBgImage'])->name('leads.upload-planBgImage');
                Route::post('/upload-classBgImage', [LeadController::class, 'uploadClassBgImage'])->name('leads.upload-classBgImage');

            });

            Route::prefix('userinfo')->group(function (){
                Route::get('/', [UserController::class, 'index'])->name('userinfo.index');
            });

            Route::prefix('landingPages')->group(function (){
                Route::get('/', [LandingPageController::class, 'index'])->name('landing_pages.index');
                Route::get('/edit/{id}', [LandingPageController::class, 'edit'])->name('landing_pages.edit');
                Route::post('update', [LandingPageController::class, 'update'])->name('landing_pages.update');
                Route::post('/update-status', [LandingPageController::class, 'updateStatus'])->name('landing_pages.update-status');
                Route::post('/check-domain', [LandingPageController::class, 'checkDomain'])->name('landing_pages.check-domain');
                Route::get('delete/{id}',[LandingPageController::class, 'delete'])->name('landing_pages.delete');
                Route::get('/create/{landing_type}', [LandingPageController::class, 'create'])->name('landing_pages.create');
                 Route::post('/store', [LandingPageController::class, 'store'])->name('landing_pages.store');
                 Route::post('/search', [LandingPageController::class, 'search'])->name('landing_pages.search');
                 Route::get('/landing_page', [LandingPageController::class, 'getDataAjax'])->name('landing_pages.list');
                 Route::get('/get_digital_file', [LandingPageController::class, 'getDigitalFile'])->name('landing_pages.digital_file');
            });


            Route::prefix('digitalFiles')->group(function (){
                Route::get('/', [DigitalFilesController::class, 'index'])->name('digitalFiles.index');
                Route::post('/store', [DigitalFilesController::class, 'store'])->name('digitalFiles.store');
                Route::post('/search', [DigitalFilesController::class, 'search'])->name('digitalFiles.search');
                Route::get('/file_page', [DigitalFilesController::class, 'getfilesAjax'])->name('digitalFiles.list');
                Route::get('delete/{id}',[DigitalFilesController::class, 'delete'])->name('digitalFiles.delete');
                Route::get('edit/{id}',[DigitalFilesController::class, 'edit'])->name('digitalFiles.edit');
                Route::post('update',[DigitalFilesController::class, 'update'])->name('digitalFiles.update');

                 Route::get('/test', [DigitalFilesController::class, 'test'])->name('digitalFiles.test');

            });

            Route::prefix('pagecms')->group(function (){
                Route::get('/', [PageCmsController::class, 'index'])->name('pagecms.index');
                Route::get('/create', [PageCmsController::class, 'create'])->name('pagecms.create');
                Route::post('/store', [PageCmsController::class, 'store'])->name('pagecms.store');
                Route::post('/UploadImage', [PageCmsController::class, 'UploadImage'])->name('pagecms.UploadImage');
                Route::get('/edit/{id}', [PageCmsController::class, 'edit'])->name('pagecms.edit');
                Route::post('/update', [PageCmsController::class, 'update'])->name('pagecms.update');
                Route::post('/create-emptySection', [PageCmsController::class, 'createEmptySection'])->name('pagecms.create-emptySection');
                Route::post('/delete-section', [PageCmsController::class, 'deleteSection'])->name('pagecms.delete-section');
                Route::post('/search', [PageCmsController::class, 'search'])->name('pagecms.search');
                Route::post('/set-redirect', [PageCmsController::class, 'setRedirectPage'])->name('pagecms.set-redirect');
                
            });

            Route::prefix('manageExercises')->controller(ManageExercisesController::class)->name('manageExercises.')->group(function (){
                Route::get('/','index')->name('index');
                Route::get('/create','create')->name('add');
                Route::post('/store','store')->name('store');
                Route::get('/edit/{id}','edit')->name('edit');
                Route::post('/update','update')->name('update');
                Route::post('/set-status','setStatus')->name('set-status');
                Route::get('/delete/{id}','delete')->name('delete');
                Route::post('/search','search')->name('search');
                Route::get('/get-page','getPage')->name('get-page');
                Route::post('/upload-file','uploadFile')->name('upload-file');
                Route::get('/get-parts','getTags')->name('get-parts');
                Route::post('/import-excel','importExcel')->name('import-excel');
                Route::get('/logs','getLogs')->name('logs');
                Route::post('/export-excel', 'exportExcel')->name('export-excel');
            });

        });
    });


    Route::middleware('role:2')->group(function (){
        Route::prefix('coach')->group(function () {

            Route::prefix('dashboard')->group(function (){
                Route::get('/', [CoachDashboardController::class, 'index'])->name('coach_dashboard.index');
            });

        });
    });
    
});