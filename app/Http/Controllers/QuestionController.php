<?php
namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdataQuestionRequest;

class QuestionController extends Controller
{

    public function index(Request $request)
    {
        // dd($request->query('filter'));
        $filter = $request->query('filter', 'latest'); // default latest
        $questions = QuestionResource::collection(
            Question::with('user')
            ->withCount('answers') // untuk menghitung jumlah answers berdasarkan relasi dari question
            ->when($filter === 'mine', function ($query) {
                $query->mine();
            })
            ->when($filter === 'unanswered', function ($query) {
                $query->has('answers', '=', 0);
            })
            ->when($filter === 'scored', function ($query) {
                $query->whereNotNull('best_answer_id');
            })
            ->latest()->paginate(15)
            ->withQueryString()
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
        Gate::authorize('update', $question); // policy
        $question->update($request->validated());

        return back()->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        Gate::authorize('delete', $question); // policy
        $question->delete();
        return back()->with('success', 'Your question has been deleted.');
    }
}
