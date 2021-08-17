<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        try {
            // devuelve todos los users
            return Product::all();
        } catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // request -> valores que le pasamos por parametro

    public function store(Request $request)
    {
        try {

            // creamos un user y le pasamos todos los valores
            return Product::create($request->all());

        } catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        try {

            return Product::with('type')->find($id);

        }catch(\Exception $ex){

            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            //buscamos el user por su id
            $product = Product::findOrFail($id);

            //le pasamos a user los datos
            $product->id       = $request->id;
            $product->name     = $request->name;
            $product->quantity = $request->quantity;
            $product->type     = $request->type;
            $product->prio     = $request->prio;
            $product->price    = $request->price;

            //actualizamos
            $product->update();

            return $product;

        } catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {

        try {
            //buscamos el user por su id
            $product = Product::findOrFail($request->get('id'));

            //borramos
            $product->delete();

            return response()->json('ok');
        } catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
