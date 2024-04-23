<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\ConnectsController;
use App\Http\Controllers\CostsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfessionalsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ReplysController;
use App\Http\Controllers\ServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[AuthController::class, 'logout']);
    //Route::get("/profile", [CommunitiesController::class, 'readAllProfiles']);

    // return $request->user();
});
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);



Route::post("/profile", [ProfilesController::class, 'createProfile']);
Route::get("/profile", [ProfilesController::class, 'readAllProfiles']);
Route::get("/profile/{id}", [ProfilesController::class, 'readProfile']);
Route::post("/profile/{id}", [ProfilesController::class, 'updateProfile']);
Route::delete("/profile/{id}", [ProfilesController::class, 'deleteProfile']);

Route::post("/post", [PostsController::class, 'createPost']);
Route::get("/post", [PostsController::class, 'readAllPosts']);
Route::get("/post/{id}", [PostsController::class, 'readPost']);
Route::post("/post/{id}", [PostsController::class, 'updatePost']);
Route::delete("/post/{id}", [PostsController::class, 'deletePost']);

Route::post("/like", [LikesController::class, 'createLike']);
Route::get("/like", [LikesController::class, 'readAllLikes']);
Route::get("/like/{id}", [LikesController::class, 'readLike']);
Route::post("/like/{id}", [LikesController::class, 'updateLike']);
Route::delete("/like/{id}", [LikesController::class, 'deleteLike']);


Route::post("/comment", [CommentsController::class, 'createComment']);
Route::get("/comment", [CommentsController::class, 'readAllComments']);
Route::get("/comment/{id}", [CommentsController::class, 'readComment']);
Route::post("/comment/{id}", [CommentsController::class, 'updateComment']);
Route::delete("/comment/{id}", [CommentsController::class, 'deleteComment']);

Route::post("/analytic", [AnalyticsController::class, 'createAnalytic']);
Route::get("/analytic", [AnalyticsController::class, 'readAllAnalytics']);
Route::get("/analytic/{id}", [AnalyticsController::class, 'readAnalytic']);
Route::post("/analytic/{id}", [AnalyticsController::class, 'updateAnalytic']);
Route::delete("/analytic/{id}", [AnalyticsController::class, 'deleteAnalytic']);

Route::post("/connect", [ConnectsController::class, 'createConnect']);
Route::get("/connect", [ConnectsController::class, 'readAllConnects']);
Route::get("/connect/{id}", [ConnectsController::class, 'readConnect']);
Route::post("/connect/{id}", [ConnectsController::class, 'updateConnect']);
Route::delete("/connect/{id}", [ConnectsController::class, 'deleteConnect']);

Route::post("/event", [EventsController::class, 'createEvent']);
Route::get("/event", [EventsController::class, 'readAllEvents']);
Route::get("/event/{id}", [EventsController::class, 'readEvent']);
Route::post("/event/{id}", [EventsController::class, 'updateEvent']);
Route::delete("/event/{id}", [EventsController::class, 'deleteEvent']);

Route::post("/cost", [CostsController::class, 'createCost']);
Route::get("/cost", [CostsController::class, 'readAllCosts']);
Route::get("/cost/{id}", [CostsController::class, 'readCost']);
Route::post("/cost/{id}", [CostsController::class, 'updateCost']);
Route::delete("/cost/{id}", [CostsController::class, 'deleteCost']);


Route::post("/service", [ServicesController::class, 'createService']);
Route::get("/service", [ServicesController::class, 'readAllServices']);
Route::get("/service/{id}", [ServicesController::class, 'readService']);
Route::post("/service/{id}", [ServicesController::class, 'updateService']);
Route::delete("/service/{id}", [ServicesController::class, 'deleteService']);





