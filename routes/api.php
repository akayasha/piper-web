<?php

// System
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;

use App\Http\Controllers\API\V1\BranchController;
use App\Http\Controllers\API\V1\TesterController;
use App\Http\Controllers\API\V1\PaymentController;
use App\Http\Controllers\API\V1\FeedbackController;

use App\Http\Controllers\API\V1\RedeemCodeController;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\API\V1\PriceBranchController;


// Fallback System
// Route::fallback(function () {
//     return response()->json([
//         'status' => 'error',
//         'message' => 'Resource not found, (CARI APA? #DIMDEVS)',
//         'code' => 404,
//     ], 404);
// });

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function() {

    Route::prefix('payment')->group(function(){
        Route::post('/process', PaymentController::class);
        Route::get('/status/{invoiceNumber}', [PaymentController::class, 'checkPaymentStatus']);
        Route::get('/redeem-codes', [PaymentController::class, 'getRedeemCodes']);
        Route::get('/all-payments', [PaymentController::class, 'getPayments']);
        Route::get('/get-payment/{branchId}/strip/{strip}', [PaymentController::class, 'getPaymentBrach']);
        Route::delete('/delete/{invoiceNumber}', [PaymentController::class, 'deleteByInvoice']);

    });

    Route::prefix('redeem')->group(function(){
        Route::post('/generate-code', [RedeemCodeController::class, 'generate']);
        Route::post('/use-code/{code}', [RedeemCodeController::class, 'useCode']);
        Route::get('/status/{code}', [RedeemCodeController::class, 'checkCodeStatus']);
        Route::get('/all-redeem-codes', [RedeemCodeController::class, 'getAllRedeemCodes']);
        Route::get('/all-branch', [RedeemCodeController::class, 'getAllBranches']);
        Route::get('/branch-by{name}', [RedeemCodeController::class, 'getBranchByName']);
    });

    Route::post('/feedback', [FeedbackController::class, 'createFeedback']);

    Route::prefix('branches')->group(function(){
        Route::get('/', [BranchController::class, 'index']);
        Route::get('/detail/{id}', [BranchController::class, 'show']);
        Route::get('/get-price/{branch_id}', [PriceBranchController::class, 'getPriceByBranchId']);
        Route::post('create-price', [PriceBranchController::class, 'create']);


    });

    // Example
    // Route::prefix('/categories')->controller(CategoryController::class)->group(function() {
    //     Route::get('/' , 'index')->name('api.categories.index');
    //     Route::post('/create' , 'create')->name('api.categories.create');
    //     Route::post('/update/{id}', 'update')->name('api.categories.update');
    //     Route::get('/show/{id}', 'show')->name('api.categories.show');
    //     Route::delete('/destroy/{id}', 'destroy')->name('api.categories.destroy');
    // });
});
