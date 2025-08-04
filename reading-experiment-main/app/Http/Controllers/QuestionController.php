<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Survey;
use App\Models\UserProgress;

class QuestionController extends Controller
{

    public CommonService $commonService;
    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }


    public function submitQuestions(Request $request)
    {

        $user_id = auth()->id();
        $survey_id = Survey::query()->where('user_id', auth()->id())->first()->id;

        $answers = $request->answers;

        UserAnswer::query()->create([
            'user_id' => $user_id,
            'survey_id' => $survey_id,
            'passage_id' => $request->passage_id,
            'mcq1' => $answers['q1'] ?? 0,
            'mcq2' => $answers['q2'] ?? 0,
            'mcq3' => $answers['q3'] ?? 0,
            'mcq4' => $answers['q4'] ?? 0,
            'mcq5' => $answers['q5'] ?? 0,
            'start_time' => Carbon::parse($request->start_time)->format('Y-m-d H:i:s'),
            'end_time' => Carbon::parse($request->end_time)->format('Y-m-d H:i:s'),
        ]);

        $this->commonService->storedQuestionEndTime($request->passage_id);


        return response()->json(['success' => true]);
    }


    public function showPassage2()
    {
        $userId = auth()->id();

        // Update end time for the previous page
        UserProgress::where('user_id', $userId)
            ->whereNull('end_time')
            ->latest()
            ->update(['end_time' => now()]);

        // Start tracking new page
        UserProgress::create([
            'user_id' => $userId,
            'page_number' => 4,
            'start_time' => now(),
        ]);
        return view('passage.passage2');
    }

    public function showQuestions2()
    {
        $user_id = auth()->id();
        $survey = Survey::first();
        UserAnswer::where('user_id', $user_id)
            ->where('page_number', 5)
            ->update(['start_time' => now()]);

        return view('question.questions2', compact('survey'));
    }

}
