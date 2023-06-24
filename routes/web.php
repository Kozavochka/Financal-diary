<?php

use App\Http\Controllers\Guest\StockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/pdf', [HomeController::class,'pdf_export'])->name('general_pdf');

Route::get('/start-tg',[HomeController::class,'telegram']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function (){
    Route::get('stocks/export', [StockController::class, 'excel_export'])->name('excel_export');
    Route::resource('/stocks',StockController::class)->names('stocks');
});

/*Route::post('/bot/webhook', function (Request $request) {
    $update = Telegram::bot('worker')->commandsHandler(true);
    return response('OK', 200);
});*/

/*Route::post('/webhook', function () {
   $telegram = Telegram::getFacadeRoot();

    $telegram->commandsHandler(true);

    $update = new \Telegram\Bot\Objects\Update([
        "update_id" => 123456789,
        "message" => [
            "message_id" => 1,
            "chat" => [
                "id" => env('TELEGRAM_MY_CHAT_ID'),
                "type" => "private",
            ],
            "date" => 1641297154,
            "text" => "/start",
            "entities" => [
                [
                    "offset" => 0,
                    "length" => 6,
                    "type" => "bot_command",
                ],
            ],
        ],
    ]);


    Telegram::bot('worker')->processCommand($update);


    return '123';
});*/
Route::post('/webhook', [TelegramController::class,'index']);

