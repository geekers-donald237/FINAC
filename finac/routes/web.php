<?php

use App\Http\Controllers\Armory\ArmoryController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Declaration\WeaponLostDeclarationController;
use App\Http\Controllers\Declaration\WeaponPossesionDeclarationController;
use App\Http\Controllers\Home\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['web'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('home');
    Route::get('/info', [WelcomeController::class, 'infoAndContactPage'])->name('info_contact');
    Route::get('/create', [WelcomeController::class, 'goTocreateArmory'])->name('add_armory');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout_dashboard'])->name('logout_dashboard');

    Route::resource('armory', ArmoryController::class);


    Route::get('/declaration/loss-weapon', [WeaponLostDeclarationController::class, 'index'])->name('declaration.loss_weapon');
    Route::post('declaration/save', [WeaponLostDeclarationController::class, 'store'])->name('declaration.store');
    Route::post('declaration/lost-weapon', [WeaponLostDeclarationController::class, 'checkIfweaponExistOrNot'])->name('declaration.check');

    Route::get('/declaration/weapons-declaration', [WeaponPossesionDeclarationController::class, 'index'])->name('declaration.weapons_declaration');
    Route::post('declarationarmes/store', [WeaponPossesionDeclarationController::class, 'store'])->name('declarationarmes.store');
});


Route::middleware(['check.auth'])->group(function () {
    // Admin Routes
    Route::resource('admin', \App\Http\Controllers\Admin\AdminController::class);

    // SubAdmin Routes
    Route::resource('governor', \App\Http\Controllers\Admin\subAdmin\GovernorController::class);
    Route::resource('minatd', \App\Http\Controllers\Admin\subAdmin\MinatdController::class);
    Route::resource('ammunition', \App\Http\Controllers\weapons\AmmunitionController::class);

    // Armory Routes
    Route::get('armory_details/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'getArmorySytemdetails'])->name('armory.details');
    Route::get('minatd_armory_details/{id}', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'getArmoryMinatdDetails'])->name('minatd.armory.details');
    Route::get('governor_armory_details/{id}', [\App\Http\Controllers\Admin\subAdmin\GovernorController::class, 'getArmoryGovernorDetails'])->name('governor.armory.details');
    Route::get('add_sheet', [App\Http\Controllers\Armory\ArmoryController::class, 'gotoAddWeaponsSheet'])->name('add_arm_sheet');
    Route::post('save_sheet', [App\Http\Controllers\Armory\ArmoryController::class, 'addFicheArm'])->name('armory.add_arm_sheet');

    // Weapons Type Routes
    Route::resource('weapons_type', App\Http\Controllers\weapons\WeaponsTypeController::class);

    // Helpers Routes
    Route::get('prefecture_details', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'getAllPrefectures'])->name('minatd_prefecture');
    Route::get('governor_details', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'getAllGovernorsServices'])->name('minatd_governor');
    Route::get('agovernor_details', [\App\Http\Controllers\Admin\AdminController::class, 'getAllGovernorsServices'])->name('admin_governor');
    Route::get('holder_details/{id}', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'gotoHolderWeaponsDetails'])->name('holders.details');
    Route::get('gholder_details/{id}', [\App\Http\Controllers\Admin\subAdmin\GovernorController::class, 'gotoHolderWeaponsDetails'])->name('governor.holders.details');
    Route::get('holder_details_copy/{id}', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'gotoHolderWeaponsDetailsCopy'])->name('holders.details_copy');

    Route::get('gholder_details_copy/{id}', [\App\Http\Controllers\Admin\subAdmin\GovernorController::class, 'gotoHolderWeaponsDetailsCopy'])->name('governor.holders.details_copy');
    Route::get('valid_weapons_sheet/{id}', [\App\Http\Controllers\Helpers\HelpersFunction::class, 'generateFINACCode'])->name('generate.finac');
    Route::post('reject_weapons_sheet/{id}', [\App\Http\Controllers\Helpers\HelpersFunction::class, 'rejectPermissionsPort'])->name('submit.reject');
    Route::get('lost_weapon', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'gotoLostArm'])->name('lost_arm');
    Route::get('declared_weapon', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'gotoDeclaredArm'])->name('declared_arm');
    Route::get('resend_governor/{id}', [\App\Http\Controllers\Admin\subAdmin\GovernorController::class, 'resendEmail'])->name('resend');
    Route::post('/save-pdf', [\App\Http\Controllers\Helpers\HelpersFunction::class, 'savePdf'])->name('save-pdf');
    Route::get('test_route', [\App\Http\Controllers\Admin\subAdmin\MinatdController::class, 'index2'])->name('minatd_armory');
    Route::get('gtest_route', [\App\Http\Controllers\Admin\subAdmin\GovernorController::class, 'index2'])->name('governor_armory');
    Route::get('goto', [\App\Http\Controllers\weapons\WeaponsTypeController::class, 'index2'])->name('goto');
    Route::get('sale_ammunition', [\App\Http\Controllers\Armory\ArmoryController::class, 'gotoSalesAmmunition'])->name('sale_ammunition');

    Route::post('/sale-ammunitions', [\App\Http\Controllers\weapons\AmmunitionController::class, 'SaleAmmunitions'])->name('sale-ammunitions');

});



