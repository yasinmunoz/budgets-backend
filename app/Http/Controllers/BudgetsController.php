<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BudgetsController extends Controller
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

            // devuelve todos los budgets
            return Budget::all();

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            //throw new \Exception('dfsdafsda');

            // creamos un budget y le pasamos todos los valores
            return Budget::create($request->all());

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {

            return Budget::with('state', 'lines')->find($id);

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //buscamos el budget por su id
            $budget = Budget::findOrFail($id);

            //le pasamos a budget los datos
            $budget->title = $request->title;
            $budget->task = $request->task;
            $budget->state = $request->state;
            $budget->description = $request->description;
            $budget->total = $request->total;

            //actualizamos
            $budget->update();

            return $budget;

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            //buscamos el budget por su id
            $budget = Budget::findOrFail($request->get('id'));

            //borramos
            $budget->delete();

            return response()->json('ok');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'linea' => $ex->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
