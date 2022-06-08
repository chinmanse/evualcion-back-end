<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pagina)
    {
        //
        $skip = $pagina * 5;
        $productos = Producto::where("estado", "1")->skip($skip)->take(5)->get();
        //dd($productos);
        return response()->json($productos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $image = $data["ruta"];
        $subString = substr($image, 0, strpos($image, ";"));
        $primerExplode = explode(":", $subString)[1];
        $extension = explode("/", $primerExplode)[1];
        $nombre = time().".".$extension;
        \Image::make($image)->save("productos/{$nombre}");
        $data = $request->all();
        $data["ruta"] = "productos/" . $nombre;
        $producto = Producto::create($data);

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoRequest  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, $id_producto)
    {
        $data = $request->all();
        $producto = Producto::where('id', $id_producto)->first();
        $image = $data["ruta"];
        if($image !=""){
            $subString = substr($image, 0, strpos($image, ";"));
            $primerExplode = explode(":", $subString)[1];
            $extension = explode("/", $primerExplode)[1];
            $nombre = time().".".$extension;
            \Image::make($image)->save("productos/{$nombre}");
            $data["ruta"] = "productos/" . $nombre;
        }else{
            $data["ruta"] = $producto->ruta;
        }
        $producto->update($data);
        return response()->json($producto, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_producto)
    {
        Producto::where('id', $id_producto)->update(["estado" => 2]);
        return response()->json(null, 201);
    }

    public function getProduct($idProducto){
        $producto = Producto::find($idProducto);
        return response()->json($producto, 200);
    }
}
