<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
    echo "";
});

$app->get('/index', 'indexController@index');
$app->get('/products', 'ProductController@index');
$app->get('/inventory', 'InventoryController@index');
$app->get('/addScanInventory', 'InventoryController@addScanInventory');
$app->get('/delScanInventory', 'InventoryController@delScanInventory');
$app->post('/addConfirm', 'InventoryController@addConfirm');
$app->post('/delConfirm', 'InventoryController@delConfirm');
$app->post('/addInventory', 'InventoryController@addInventory');
$app->post('/delInventory', 'InventoryController@delInventory');
$app->get('/postItemNoList', 'postItemNoController@index');
$app->get('/addScanPostItemNo', 'postItemNoController@addScanPostItemNo');
$app->post('/addPostItemNoConfirm', 'postItemNoController@addPostItemNoConfirm');
