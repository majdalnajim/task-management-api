<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
        use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,Task $task)
    {
        $query=auth()->user()->tasks();
        if($request->search)  {
            $query->where(function($q) use ($request){
                $q->where("title","like","%".$request->search."%")->orwhere("description","like","%".$request->search."%");
            });
        } 
        if($request->has("status")){
            $query->where("isCompleted",$request->status);
        }
        return TaskResource::collection( $query->paginate(5));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $task=auth()->user()->tasks()->create([
        'title'=>$request->title,   
        'description'=>$request->description,
        'isCompleted'=>$request->isCompleted,

       ]);
       return response()->json($task,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize("view",$task);
        return new TaskResource($task) ;
        
        // return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
         $this->authorize("update",$task);
        $task->update($request->all());
        return new TaskResource($task) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

$this->authorize('delete',$task);
$task->delete();
return response()->json(['massage'=>'Deleted']);
    }
    
}

// 1|ZlrhVulKURbZY4RxzNVLxupr5dLDFo5Dx3zDxawT98d30b16
// 2|vhY4Q8o1FU4IR988CdFbsDnCVnUETA8pnfzdxtjo5a7cab52