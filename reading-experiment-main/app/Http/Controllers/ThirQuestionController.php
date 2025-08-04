<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\UserProgress;
use App\Models\Survey;

class ThirQuestionController extends Controller
{
    //
    public function submitFillInTheBlanks(Request $request)
    {
        $user_id = auth()->id();
        $survey_id = $request->survey_id;
        $answers = $request->answers;

        if (isset($request->blanks) && $request->blanks == 'blanks') { 
            UserAnswer::create([
                'user_id' => $user_id,
                'survey_id' => $survey_id,
                'page_number' => 7,
                'mcq1' => $answers['q1'] ?? '',
                'mcq2' => $answers['q2'] ?? '',
                'mcq3' => $answers['q3'] ?? '',
                'mcq4' => $answers['q4'] ?? '',
                'mcq5' => $answers['q5'] ?? '',
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Answers submitted successfully!',
            'redirect_url' => route('passage4.show')
        ]);
    }



    public function showPassage4()
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
            'page_number' => 8,
            'start_time' => now(),
        ]);
        return view('passage.passage4');
    }
    public function showQuiz()
    {
        $user_id = auth()->id();
        $survey = Survey::first(); 
        UserAnswer::where('user_id', $user_id)
            ->where('page_number', 9)
            ->update(['start_time' => now()]);
        return view('question.quiz', compact('survey'));
    }
}
