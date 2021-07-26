<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        try {

            //throw new \Exception('dfsdafsda');

            // devuelve todos los users
            return User::all();

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

            //throw new \Exception('dfsdafsda');

            // creamos un user y le pasamos todos los valores
            return User::create($request->all());

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

            return User::with('type')->find($id);

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
            $user = User::findOrFail($id);

            //le pasamos a user los datos
            $user->code = $request->code;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->phone = $request->phone;

            //actualizamos
            $user->update();

            return $user;

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
            $user = User::findOrFail($request->get('id'));

            //borramos
            $user->delete();

            return response()->json('ok');
        } catch (\Exception $ex){
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
