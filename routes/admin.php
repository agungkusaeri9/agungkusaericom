<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PengaturanSeoController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectGallery;
use App\Http\Controllers\Admin\ProjectGalleryController;
use App\Http\Controllers\Admin\ProjectTagController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocmedController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UtangPiutangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

// users
Route::get('users/data', [UserController::class, 'data'])->name('users.data');
Route::resource('users', UserController::class)->except('show');
Route::post('users/change-status', [UserController::class, 'changeStatus'])->name('users.change-status');

// post category
Route::get('post-categories/data', [PostCategoryController::class, 'data'])->name('post-categories.data');
Route::resource('post-categories', PostCategoryController::class)->except('create', 'show', 'edit', 'update');

// post tag
Route::get('post-tags/data', [PostTagController::class, 'data'])->name('post-tags.data');
Route::resource('post-tags', PostTagController::class)->except('create', 'show', 'edit', 'update');

// roles
Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
Route::post('roles/get', [RoleController::class, 'get'])->name('roles.get');
Route::DELETE('roles/remove-permission', [RoleController::class, 'removePermission'])->name('roles.remove-permission');
Route::post('roles/add-permission', [RoleController::class, 'addPermission'])->name('roles.add-permission');
Route::resource('roles', RoleController::class)->except('create', 'show', 'edit', 'update');

// permissions
Route::get('permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
Route::post('permissions/get', [PermissionController::class, 'get'])->name('permissions.get');
Route::post('permissions/getByRole', [PermissionController::class, 'getByRole'])->name('permissions.getByRole');
Route::resource('permissions', PermissionController::class)->except('create', 'show', 'edit', 'update');

// posts
Route::get('posts/data', [PostController::class, 'data'])->name('posts.data');
Route::resource('posts', PostController::class);
Route::post('posts/change-status', [PostController::class, 'changeStatus'])->name('posts.change-status');


// filemanager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// socmed
Route::get('socmeds/data', [SocmedController::class, 'data'])->name('socmeds.data');
Route::resource('socmeds', SocmedController::class)->except('create', 'show', 'edit', 'update');

// setting
Route::get('setting', [SettingController::class, 'index'])->name('settings.index');

Route::post('setting', [SettingController::class, 'update'])->name('settings.update');


// project category
Route::get('project-categories/data', [ProjectCategoryController::class, 'data'])->name('project-categories.data');
Route::resource('project-categories', ProjectCategoryController::class)->except('create', 'show', 'edit', 'update');


// project tag
Route::get('project-tags/data', [ProjectTagController::class, 'data'])->name('project-tags.data');
Route::resource('project-tags', ProjectTagController::class)->except('create', 'show', 'edit', 'update');


// project
Route::get('projects/data', [ProjectController::class, 'data'])->name('projects.data');
Route::resource('projects', ProjectController::class);

// project galleries
Route::get('/projects/{id}/gallery', [ProjectGalleryController::class, 'index'])->name('projects.galleries.index');
Route::post('/projects/{id}/gallery', [ProjectGalleryController::class, 'store'])->name('projects.galleries.store');
Route::delete('/projects/{id}/gallery/delete', [ProjectGalleryController::class, 'destroy'])->name('projects.galleries.destroy');


// inbox
Route::get('inboxes/data', [InboxController::class, 'data'])->name('inboxes.data');
Route::resource('inboxes', InboxController::class)->only('index', 'destroy');



// service types
Route::get('service-types/data', [ServiceTypeController::class, 'data'])->name('service-types.data');
Route::resource('service-types', ServiceTypeController::class)->except('create', 'show', 'edit', 'update');
Route::get('service-types/get', [ServiceTypeController::class, 'getById'])->name('service-types.getById');

// payment
Route::get('payments/data', [PaymentController::class, 'data'])->name('payments.data');
Route::resource('payments', PaymentController::class)->except('create', 'show', 'edit', 'update');

// skills
Route::get('skills/data', [SkillController::class, 'data'])->name('skills.data');
Route::resource('skills', SkillController::class)->except('create', 'show', 'edit', 'update');

// sitemap update
Route::get('sitemap/update', [SitemapController::class, 'index'])->name('sitemap.update');

// invoice
Route::get('invoices/data', [InvoiceController::class, 'data'])->name('invoices.data');
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{code}/export', [InvoiceController::class, 'exportPdf'])->name('invoices.export-pdf');

// chart js
Route::post('/ajaxTransaction', [DashboardController::class, 'ajaxTransaction'])->name('ajaxTransaction');


// laporan income
Route::get('report/income', [ReportController::class, 'income'])->name('report.income.index');

Route::post('report/income', [ReportController::class, 'income_export'])->name('report.income.export');

// pengaturan-seo
Route::get('pengaturan-seo/data', [PengaturanSeoController::class, 'data'])->name('pengaturan-seo.data');
Route::get('pengaturan-seo/getByIdJson', [PengaturanSeoController::class, 'getByIdJson'])->name('pengaturan-seo.getByIdJson');
Route::resource('pengaturan-seo', PengaturanSeoController::class)->except('create', 'show', 'edit', 'update');

// utang
Route::get('utang-piutan/getById', [UtangPiutangController::class, 'getById'])->name('utang-piutang.getById');
Route::get('utang-piutang/data', [UtangPiutangController::class, 'data'])->name('utang-piutang.data');
Route::resource('utang-piutang', UtangPiutangController::class)->except('create', 'show', 'edit', 'update');
