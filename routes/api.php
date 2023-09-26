<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseEnrollmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/students/{studentId}/courses/{courseId}/enroll', [CourseEnrollmentController::class, 'enrollStudent']);
Route::delete('/students/{studentId}/courses/{courseId}/unenroll', [CourseEnrollmentController::class, 'unenrollStudent']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/paginated', [StudentController::class, 'paginateIndex']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

