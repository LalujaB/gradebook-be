<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use App\Comment;
use App\Student;
use App\Image;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Diary::with(['professor.user', 'students'])->paginate(10);
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, Diary::STORE_RULES);
        $diary = new Diary();
        $diary->title = $request->input('title');
        $diary->professor_id = $request->input('professor_id');
        $diary->save();
        return $diary;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Diary::with(['professor.user','students','comments.user'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $diary = Diary::find($id);
        $diary->title = $request->input('title');
        $diary->professor_id = $request->input('professor_id');

        $diary->save();
        return $diary;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diary $diary)
    {
        //
    }

    public function commentStore(Request $request, $id)
    {
        $comment = new Comment();
        $comment->text = $request->input('text');
        $comment->user_id = Auth::user()->id;
        $comment->diary_id = $id;
        $comment->save();
        return $comment;
    }
    public function commentDestroy($id)
    {
        $comment = Comment::find($id);

        if(!isset($comment)) {
            abort(404, "Comment not found");
        }

        $comment->delete();
    }
    public function studentStore(Request $request, $id)
    {
        $student = new Student();
        $student->firstName = $request->input('firstName');
        $student->lastName = $request->input('lastName');
        $student->diary_id = $id;

        $student->save();
        $imagesArray = [];

        foreach ($request->url as $imageLink) {
            array_push($imagesArray, new Image(['url' => $imageLink],['student_id' => $student->id]));
        }

        $student->studentHasManyImages()->saveMany($imagesArray);

        return response()->json(['success'=> true, 'message'=> 'Gallery Saved!!']);
    }

    public function myDiary($id)
    {
        return Diary::with(['professor.user', 'students', 'comments.user'])->where('professor_id', $id)->first();
    }
    public function search(Request $request)
    {
        $searchTerm = '%' . $request->input('search_term') . '%';
        $result = Diary::where('title', 'like', $searchTerm)->with(['professor', 'professor.user'])->paginate(10);

        return $result;
    }
}
