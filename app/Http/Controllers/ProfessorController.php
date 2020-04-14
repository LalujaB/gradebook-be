<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\CreateProfessor;
use App\Professor;
use App\Image;
use App\User;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Professor::with('user.professor','diary','professorHasManyImages')->get();

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
    public function store(CreateProfessor $request)
    {
        $user = new User();
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->save();


        $professor = new Professor();
        $professor->user_id = $user->id;
        $professor->save();

        $imagesArray = [];

        foreach ($request->url as $imageLink) {
            array_push($imagesArray, new Image(['url' => $imageLink]));
        }

        $professor->professorHasManyImages()->saveMany($imagesArray);


        return response()->json(['success'=> true, 'message'=> 'Images Saved!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return Professor::with(['user','diary.students','professorHasManyImages'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //
    }
}
