<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetLine;
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

            // devuelve todos los budgets con la relacion con state
            return Budget::with(['state:id,name,code',
                'lines'/* => function($query) {
                    $query->select('id', 'name', 'budget_id', 'created_at')
                        ->whereNotNull('id');
                }*/
            ])->get();

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

            $data = $request->all();
            $budget = new Budget($data);

            // TODO: eliminar esto en cuanto haya login
            $budget->user_id = 1;

            $budget->save();
            $lines= [];
            foreach ($budget->lines as $line){
                $lines[] = new BudgetLine($line);
            }

            $budget->lines()->saveMany($lines);


            return response()->json($budget);

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
            $budget->name = $request->name;
            $budget->task_id = $request->task_id;
            $budget->state_id = $request->state_id;
            $budget->description = $request->description;
            $budget->total_in_hour = $request->total_in_hour;
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
