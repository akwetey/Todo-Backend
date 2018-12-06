<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response(Todo::all()->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // generate title name and project name with faker
    public function create(Generator $faker)
    {
       $todo = new Todo ();
       $todo -> title = $faker->sentence(1);
       $todo-> project = $faker->sentence(1);
       $todo->save();
       return response($todo->jsonSerialize(), Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request ->title;
        $todo->project = $request->project;
        $todo->save();
        return response($todo->jsonSerialize(), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->title = $request->title;
        $todo->project = $request->project;
        $todo->save();
        return response($todo->jsonSerialize(), RESPONSE::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->destroy($id);
        return response($todo->jsonSerialize(), RESPONSE::HTTP_NO_CONTENT);
        //return response($todo);
    }

    public function show($id){
        $todo = Todo::findOrFail($id);
       return response ($todo->jsonSerialize(),RESPONSE::HTTP_OK);
       //echo $id;
    }

    public function getlist(){
     return    DB::table('todos')->get();
    }

     public function saveTodo(Request $request){
        $title   = $request->post('data')['title'];
        $project = $request->post('data')['project'];
        $done    = $request->post('data')['done'];
        DB::table('todos')->insert(['title' => $title, 'project' => $project,'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
        return json_encode(['status'=>201,'message'=>'todo created successfully']);
    }

}
