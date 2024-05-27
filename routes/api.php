<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-pixel', function () {
    ini_set('memory_limit', '-1');
    $gridSize = 5;
    $canvasHeight = 12000;
    $canvasWidth = 12000;
    $rows = $canvasHeight / $gridSize;
    $cols = $canvasWidth / $gridSize;

    if (Cache::getRedis()->exists("pixel")) {
        $data = json_decode(Cache::getRedis()->get("pixel"));
        return response()->json([
            "data" => $data,
            "gridSize" =>  $gridSize,
            "canvasHeight" =>  $canvasHeight,
            "canvasWidth" =>  $canvasWidth,
            "rows" =>  $rows,
            "cols" =>  $cols,
        ]);
    }
    $data =  [];
    for ($row = 0; $row < $rows; $row++) {
        $data[$row] = [];
        for ($col = 0; $col < $cols; $col++) {
            $data[$row][$col] = "#FFFFFF";
        }
    }
    Cache::getRedis()->set("pixel", json_encode($data), "ex", 6 * 30 * 24 * 60 * 60);
    return response()->json([
        "data" => $data,
        "gridSize" =>  $gridSize,
        "canvasHeight" =>  $canvasHeight,
        "canvasWidth" =>  $canvasWidth,
        "rows" =>  $rows,
        "cols" =>  $cols,
    ]);
});
Route::get('send-pixel', function () {
    $data = json_decode(Cache::getRedis()->get("pixel"));
    $data[request()->clickedRow][request()->clickedCol] = "#" . request()->selectedColor;
    Cache::getRedis()->set("pixel", json_encode($data), "ex", 6 * 30 * 24 * 60 * 60);
});
