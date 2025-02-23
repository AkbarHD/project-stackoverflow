<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdataQuestionRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->query('filter'));
        $filter = $request->query('filter', 'latest'); // default latest
        $questions = QuestionResource::collection(
            Question::with('user')
            ->when($filter === 'mine', function ($query) {
                $query->mine();
            })
            ->latest()->paginate(15)
        );
        // return $questions;
        return Inertia('Questions/Index', [
            'questions' => $questions,
            'filter' => $filter
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
        // penjelasasan : $request->user = akan mengambil id yang sedang login
        // $request->user()->questions = akan mengabil field question, tapi dia mengambil dari sisi user yg hasMany
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
            'question' => QuestionResource::make($question),
            'answers' => AnswerResource::collection($question->answers()->latest()->paginate(5))
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
    public function update(UpdataQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());

        return back()->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Your question has been deleted.');
    }
}
