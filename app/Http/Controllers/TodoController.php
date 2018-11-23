<?php

namespace App\Http\Controllers;

use App\Todo;
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
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->project = $request->project;
        $todo->save();
        return response(null, RESPONSE::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TOdo::destroy($id);
        return response(null, RESPONSE::HTTP_OK);
    }
}
