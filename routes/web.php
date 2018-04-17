<?php

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

//Vista tienda
Route::get('/tiendas', function () {
   	
   	$tienda = DB::table('tienda')->get();
   	return $tienda;
});

//Vista producto
Route::get('/productos', function () {
    $producto = DB::table('producto')->get();

    return $producto;
});

//Vista cliente
Route::get('/clientes', function () {
    $cliente = DB::table('cliente')->get();

    return $cliente;
});

//Vista ventas por cliente
Route::get('/ventasPorCliente/{idCliente}', function ($idCliente) {
    $ventas = DB::table('ventas')
    ->select('ventas.fecha', 'detalle.idProducto', 'cliente.nombre', 'ventas.idTienda',
    	'detalle.cantidad')
    ->join('detalle','detalle.idVentas', '=','ventas.id')
    ->join('cliente','cliente.id', '=', 'ventas.idCliente')
    ->where('idCliente', $idCliente)
    ->get();
    dd($ventas);
    return $ventas;
});

//Vista ventasPorTienda
Route::get('/ventasPorTienda/{idTienda}', function ($idTienda) {
    $ventas = DB::table('ventas')
    ->select('ventas.fecha', 'ventas.idCliente',
    	'tienda.nombre', 'detalle.idVentas', 'detalle.idProducto', 'detalle.cantidad')
    ->join('tienda','tienda.id', '=','ventas.idTienda')
    ->join('detalle', 'detalle.idVentas', '=', 'ventas.id')
    ->where('idTienda', $idTienda)
    ->get();
    dd($ventas);
    return view('ventasPorTienda');
});


//Vista ventas por producto
Route::get('/ventasPorProducto/{idProducto}', function ($idProducto) {
    $ventas = DB::table('producto')
    ->select('producto.id', 'producto.nombre', 'producto.precio', 'detalle.idVentas',
    	'detalle.cantidad', 'detalle.idVentas')
    ->join('detalle','detalle.idProducto', '=','producto.id')
    ->where('idProducto', $idProducto)
    ->get();
    dd($ventas);
    return $ventas;
});


/*
//Vista detalle
Route::get('/detallePorProducto/{idProducto}', function ($idProducto) {
    $detalle = DB::table('detalle')->where('idProducto', $idProducto)->get();
    dd($detalle);
    return $detalle;
});
*/

/*
//Vista producto
Route::get('/detallePor/{idCliente}', function ($idProducto) {
    $detalle = DB::table('detalle')
    ->select(detalle.)
    ->join('ventas', 'ventas.id', '=', 'detalle.idVentas')
    ->where('idProducto', $idProducto)->get();
    dd($detalle);
    return $ventas;
});
*/

Route::get('/', function () {
    return view('welcome');
});