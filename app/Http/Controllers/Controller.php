<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;



abstract class Controller
{
   public function completed(){

        return TaskResource::collection( Task::where("isCompleted",true)->get());
    }
    public function unCompleted(){
        return TaskResource::collection( Task::where("isCompleted",false)->get());
    }
    public function search(Request $request ){
        $search=$request->search ?? ""; 
        if($search){
        return TaskResource::collection (Task::where("isCompleted",false)->where(function($q) use ($search){
            $q->where("title","like","%" .$search. "%")
            ->orWhere("description","like","%" .$search. "%");})->get());

        }
        return response()->json([
            "masage"=>"please provide search value"
        ]);
    }

}
