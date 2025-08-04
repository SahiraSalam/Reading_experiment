<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Survey;
use App\Models\UserProgress;

class SecQuestionController extends Controller
{
    //
    public function submitQuestions2(Request $request)
    {
        $user_id = auth()->id();
        $survey_id = $request->survey_id;
    
        $answers = $request->answers; 

        UserAnswer::create([
            'user_id' => $user_id,
            'survey_id' => $survey_id,
            'page_number' => 5,
            'mcq1' => $answers['q1'] ?? 0,
            'mcq2' => $answers['q2'] ?? 0,
            'mcq3' => $answers['q3'] ?? 0,
            'mcq4' => $answers['q4'] ?? 0,
            'mcq5' => $answers['q5'] ?? 0,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Answers submitted successfully!',
            'redirect_url' => route('passage3.show') // Send the next page URL in JSON response
        ]);
    }


    public function showPassage3()
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
            'page_number' => 6,
            'start_time' => now(),
        ]);
        return view('passage.passage3');
    }

    public function showFillInTheBlanks()
    {
        $user_id = auth()->id();
        $survey = Survey::first(); 
        UserAnswer::where('user_id', $user_id)
            ->where('page_number', 7)
            ->update(['start_time' => now()]);
        return view('question.fill-in-the-blanks', compact('survey'));
    }
}
