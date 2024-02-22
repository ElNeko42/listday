<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checklist;
use Carbon\Carbon;
class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        
        $tasks = $user->tasks()->whereDate('due_date', $today)->get();

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'date' => 'nullable|date',

        ]);

        $task = Checklist::create([
            'user_id' => auth()->id(),
            'task' => $request->task,
            'completed' => false,
            'priority' => 0,
            'due_date' => $request->date,
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Checklist $task)
    {
        $task->update([
            'task' => $request->task,

        ]);
        return response()->json($task);
    }

    public function updateCheck(Request $request, Checklist $task)
    {
        echo $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $task)
    {
        // Aquí va la lógica para eliminar la tarea
        $task->delete();
    
        return response()->json(['message' => 'Tarea eliminada con éxito']);
    }
    /**
     * Buscar tareas por rango de fechas
     */
    public function search(Request $request)
    {
        $startDate = $request->start;
        $endDate = $request->end;

        $user = auth()->user();
        
        $tasks = Checklist::where('user_id', $user->id)
                          ->whereDate('due_date', '>=', $startDate)
                          ->whereDate('due_date', '<=', $endDate)
                          ->get();

        return response()->json($tasks);
    }
}
