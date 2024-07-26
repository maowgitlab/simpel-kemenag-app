<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReportController;

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
Route::fallback(fn () => view('404'));

Route::get('/', [BlogController::class, 'home'])->name('home');

Route::get('/auth', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/otentikasi', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/verifikasi/{username}', [AuthController::class, 'verify'])->name('verify');
Route::get('/verifikasi-akun/{email}', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('/aktivasi-akun', [AuthController::class, 'activate'])->name('activate');
Route::get('/pelayanan/{id}', [BlogController::class, 'getServicesByCategory']);
Route::get('/file-layanan/{id}', [BlogController::class, 'getServiceDetail']);
Route::get('/detail-permohonan', [BlogController::class, 'detailApplicant']);
Route::post('/status-layanan', [BlogController::class, 'serviceStatus'])->name('serviceStatus');
Route::post('/buat-permohonan-baru', [BlogController::class, 'createNewApplicant'])->name('createNewApplicant');
Route::post('/kirim-komentar', [BlogController::class, 'sendComment'])->middleware('throttle.comments')->name('sendComment');
Route::get('/unique-id', [BlogController::class, 'setUniqueID'])->name('setUniqueID');
Route::get('/laporkan-komentar/{id}', [BlogController::class, 'reportComment'])->name('reportComment');


Route::middleware('auth', 'role:admin', 'status:aktif')->group(function () {

  // Cms Route
  Route::get('/dashboard', [CmsController::class, 'dashboard'])->name('dashboard');
  Route::get('/profil', [CmsController::class, 'profile'])->name('profile');
  Route::put('/update-profil/{id}', [CmsController::class, 'profileUpdate'])->name('profileUpdate');
  Route::get('/hapus-profil/{id}', [CmsController::class, 'removeProfile'])->name('removeProfile');
  Route::post('/ganti-password/{id}', [CmsController::class, 'changePassword'])->name('changePassword');

  // Post Route
  Route::get('/data-media', [CmsController::class, 'media'])->name('media');
  Route::get('/input-media', [CmsController::class, 'createMedia'])->name('createMedia');
  Route::post('/upload-media', [CmsController::class, 'mediaStore'])->name('mediaStore');
  Route::get('/edit-media/{slug}', [CmsController::class, 'editMedia'])->name('editMedia');
  Route::put('/reupload-media/{id}', [CmsController::class, 'reuploadMedia'])->name('reuploadMedia');
  Route::delete('/hapus-media/{id}', [CmsController::class, 'deleteMedia'])->name('deleteMedia');

  // Category Route
  Route::get('/data-kategori', [CmsController::class, 'category'])->name('category');
  Route::get('/input-kategori', [CmsController::class, 'createCategory'])->name('createCategory');
  Route::post('/simpan-kategori', [CmsController::class, 'categoryStore'])->name('categoryStore');
  Route::get('/edit-kategori/{id}', [CmsController::class, 'editCategory'])->name('editCategory');
  Route::put('/update-kategori/{id}', [CmsController::class, 'updateCategory'])->name('updateCategory');
  Route::delete('/hapus-kategori/{id}', [CmsController::class, 'deleteCategory'])->name('deleteCategory');

  // Tag Route
  Route::get('/data-tag', [CmsController::class, 'tag'])->name('tag');
  Route::get('/input-tag', [CmsController::class, 'createTag'])->name('createTag');
  Route::post('/simpan-tag', [CmsController::class, 'tagStore'])->name('tagStore');
  Route::get('/edit-tag/{id}', [CmsController::class, 'editTag'])->name('editTag');
  Route::put('/update-tag/{id}', [CmsController::class, 'updateTag'])->name('updateTag');
  Route::delete('/hapus-tag/{id}', [CmsController::class, 'deleteTag'])->name('deleteTag');

  // User Route
  Route::get('/data-user', [CmsController::class, 'user'])->name('user');
  Route::get('/input-user', [CmsController::class, 'createUser'])->name('createUser');
  Route::post('/simpan-user', [CmsController::class, 'userStore'])->name('userStore');
  Route::get('/edit-user/{id}', [CmsController::class, 'editUser'])->name('editUser');
  Route::put('/update-user/{id}', [CmsController::class, 'updateUser'])->name('updateUser');
  Route::delete('/hapus-user/{id}', [CmsController::class, 'deleteUser'])->name('deleteUser');

  // List Service Route
  Route::get('/data-list-pelayanan', [CmsController::class, 'listService'])->name('listService');
  Route::get('/input-list-pelayanan', [CmsController::class, 'createListService'])->name('createListService');
  Route::post('/simpan-list-pelayanan', [CmsController::class, 'listServiceStore'])->name('listServiceStore');
  Route::get('/edit-list-pelayanan/{id}', [CmsController::class, 'editListService'])->name('editListService');
  Route::put('/update-list-pelayanan/{id}', [CmsController::class, 'updateListService'])->name('updateListService');
  Route::delete('/hapus-list-pelayanan/{id}', [CmsController::class, 'deleteListService'])->name('deleteListService');

  // Service Route
  Route::get('/data-pelayanan', [CmsController::class, 'service'])->name('service');
  Route::get('/input-pelayanan', [CmsController::class, 'createService'])->name('createService');
  Route::post('/simpan-pelayanan', [CmsController::class, 'serviceStore'])->name('serviceStore');
  Route::get('/edit-pelayanan/{id}', [CmsController::class, 'editService'])->name('editService');
  Route::put('/update-pelayanan/{id}', [CmsController::class, 'updateService'])->name('updateService');
  Route::delete('/hapus-pelayanan/{id}', [CmsController::class, 'deleteService'])->name('deleteService');

  // Applicant Inbox Route
  Route::get('/kota-masuk', [CmsController::class, 'inbox'])->name('inbox');
  Route::delete('/hapus-kotak-masuk/{id}', [CmsController::class, 'deleteInbox'])->name('deleteInbox');
  Route::post('/update-permohonan', [CmsController::class, 'updateApplicant'])->name('updateApplicant');
  Route::post('/kirim-status-email', [CmsController::class, 'sendStatusEmail']);

  // Comment Route
  Route::get('/komentar', [CmsController::class, 'comment'])->name('comment');
  Route::get('/abaikan-komentar/{id}', [CmsController::class, 'refuseComment'])->name('refuseComment');
  Route::delete('/hapus-komentar/{id}', [CmsController::class, 'deleteComment'])->name('deleteComment');

  // Route View Report
  Route::get('/semua-media', [CmsController::class, 'allMedia'])->name('allMedia');
  Route::get('/semua-media-output', [ReportController::class, 'allPostOutput'])->name('allPostOutput');

  Route::get('/media-dari-kategori', [CmsController::class, 'mediaByCategory'])->name('mediaByCategory');
  Route::get('/media-dari-kategori-output', [ReportController::class, 'mediaByCategoryOutput'])->name('mediaByCategoryOutput');

  Route::get('/media-rentang-waktu', [CmsController::class, 'mediaByTime'])->name('mediaByTime');
  Route::get('/media-rentang-waktu-output', [ReportController::class, 'mediaByTimeOutput'])->name('mediaByTimeOutput');

  Route::get('/media-populer', [CmsController::class, 'popularMedia'])->name('popularMedia');
  Route::get('/media-populer-output', [ReportController::class, 'popularPostOutput'])->name('popularPostOutput');

  Route::get('/kategori-media-terbanyak', [CmsController::class, 'mostMediaCategory'])->name('mostMediaCategory');
  Route::get('/kategori-media-terbanyak-output', [ReportController::class, 'mostMediaCategoryOutput'])->name('mostMediaCategoryOutput');

  Route::get('layanan-masuk', [CmsController::class, 'serviceIn'])->name('serviceIn');
  Route::get('layanan-masuk-output', [ReportController::class, 'serviceInOutput'])->name('serviceInOutput');

  Route::get('layanan-berdasarkan-kategori', [CmsController::class, 'serviceByCategory'])->name('serviceByCategory');
  Route::get('layanan-berdasarkan-kategori-output', [ReportController::class, 'serviceByCategoryOutput'])->name('serviceByCategoryOutput');

  Route::get('status-layanan', [CmsController::class, 'serviceStatuses'])->name('serviceStatuses');
  Route::get('status-layanan-output', [ReportController::class, 'serviceStatusesOutput'])->name('serviceStatusesOutput');

});

Route::middleware('auth', 'role:admin,penulis', 'status:aktif')->group(function () {

  // Cms Route
  Route::get('/dashboard', [CmsController::class, 'dashboard'])->name('dashboard');
  Route::get('/profil', [CmsController::class, 'profile'])->name('profile');
  Route::put('/update-profil/{id}', [CmsController::class, 'profileUpdate'])->name('profileUpdate');
  Route::get('/hapus-profil/{id}', [CmsController::class, 'removeProfile'])->name('removeProfile');
  Route::post('/ganti-password/{id}', [CmsController::class, 'changePassword'])->name('changePassword');

  // Post Route
  Route::get('/data-media', [CmsController::class, 'media'])->name('media');
  Route::get('/input-media', [CmsController::class, 'createMedia'])->name('createMedia');
  Route::post('/upload-media', [CmsController::class, 'mediaStore'])->name('mediaStore');
  Route::get('/edit-media/{slug}', [CmsController::class, 'editMedia'])->name('editMedia');
  Route::put('/reupload-media/{id}', [CmsController::class, 'reuploadMedia'])->name('reuploadMedia');
  Route::delete('/hapus-media/{id}', [CmsController::class, 'deleteMedia'])->name('deleteMedia');

  // Tag Route
  Route::get('/data-tag', [CmsController::class, 'tag'])->name('tag');
  Route::get('/input-tag', [CmsController::class, 'createTag'])->name('createTag');
  Route::post('/simpan-tag', [CmsController::class, 'tagStore'])->name('tagStore');
});
