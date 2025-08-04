<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Survey;
use App\Models\UserProgress;

class FourQuestionController extends Controller
{
    //
    public function quizSubmit(Request $request)
    {
        $user_id = auth()->id();
        $survey_id = $request->survey_id;
    
        $answers = $request->answers; // Answers array
    
        UserAnswer::create([
            'user_id' => $user_id,
            'survey_id' => $survey_id,
            'page_number' => 9,
            'mcq1' => $answers['q1'] ?? 0,
            'mcq2' => $answers['q2'] ?? 0,
            'mcq3' => $answers['q3'] ?? 0,
            'mcq4' => $answers['q4'] ?? 0,
            'mcq5' => $answers['q5'] ?? 0,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return response()->json(['success' => true]);
    }
    public function lastPage()
    {
        return view('thanks');
    }
}
