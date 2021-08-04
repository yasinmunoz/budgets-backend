<?php

namespace App\Http\Controllers;

use App\Models\BudgetLineState;
use Illuminate\Http\Request;

class BudgetLineStatesController extends Controller
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

            // devuelve todos los BudgetLineState
            return response()->json(BudgetLineState::all());

        } catch (\Exception $ex) {
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
    public function store(Request $request)
    {

        try {

            //throw new \Exception('dfsdafsda');

            // creamos un BudgetLineState y le pasamos todos los valores
            return BudgetLineState::create($request->all());

        } catch (\Exception $ex) {
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

            return BudgetLineState::with('state', 'lines')->find($id);

        } catch (\Exception $ex) {
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
            //buscamos el budget state por su id
            $budgetState = BudgetLineState::findOrFail($id);

            //le pasamos a budget state los datos
            $budgetState->state_id = $request->name;
            $budgetState->name = $request->task_id;
            $budgetState->description = $request->description;

            //actualizamos
            $budgetState->update();

            return $budgetState;

        } catch (\Exception $ex) {
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
            //buscamos el budget state por su id
            $budgetState = BudgetLineState::findOrFail($request->get('id'));

            //borramos
            $budgetState->delete();

            return response()->json('ok');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
