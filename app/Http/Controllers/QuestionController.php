<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QuestionResource::collection(
            Question::with('user')->latest()->paginate(15)
        );
        // return $questions;
        return Inertia('Questions/Index', [
            'questions' => $questions
        ]);
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
    public function store(StoreQuestionRequest $request)
    {
        $request->user()->questions()->create(
            // $request->only('title', 'body')
            $request->validated() // ini akan merujuk isi storeQuestionRequest
        );

        return back()->with('success', 'Your question has been submitted.');
    }

    public function show(Question $question)
    {
        // return QuestionResource::make($question);
        return Inertia('Questions/Show', [
            'question' => QuestionResource::make($question)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
