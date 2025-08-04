<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonService;
use App\Models\Consent;
use App\Models\Passage;
use App\Models\PassageQuestion;
use App\Models\passageStyle;
use App\Models\Survey;
use App\Models\UserAnswer;
use App\Models\UserProgress;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsentController extends Controller
{

    public CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    //
    public function submitConsent(Request $request)
    {

        $request->validate([
            'accept' => 'required|in:0,1',
        ]);

        if ($request->accept == 0) {
            return response()->json([
                'success' => false,
                'message' => 'You must accept the consent to proceed.'
            ], 400);
        }

        Consent::query()->create([
            'user_id' => auth()->id(),
            'accepted' => true
        ]);


        session(['survey_start' => true]);
        return response()->json([
            'success' => true
        ]);
    }

    public function showPassage()
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
            'page_number' => 2,
            'start_time' => now(),
        ]);

        return view('passage.passage');
    }


    public function showQuestions()
    {
        $user_id = auth()->id();
        $survey = Survey::first(); // Get the survey

        // Start tracking time for questions page, but do not insert a blank question
        UserAnswer::where('user_id', $user_id)
            ->where('page_number', 3)
            ->update(['start_time' => now()]);

        return view('question.questions', compact('survey'));
    }


    public function dynamicPassage(): View
    {
        /** @var Passage $passage */
        $passage = $this->commonService->randomPassage();
        /** @var passageStyle $availableStyles */
        $availableStyles = $this->commonService->randomStyle();
        if (empty($passage)) {
            return \view('thanks');
        }
        $this->commonService->storeUserProgress($passage, $availableStyles);
        $isInitial = Passage::INITIAL_READ;

        return view('passage.dynamic-passage', compact('passage', 'availableStyles', 'isInitial'));

    }

    public function questions(Request $request)
    {
        if ($request->passage) {
            $passageId = base64_decode($request->passage);


            $questions = PassageQuestion::with('questionOptions')
                ->where('passage_id', $passageId)
                ->get();


            if (count($questions) == 0) {
                return redirect()->route('dynamic.passage');
            }
            $survey = $this->commonService->survey();

            if (empty($request->initial)) {
                $this->commonService->updateUserProgressStartTimes($passageId);

            } else {
                $this->commonService->passageEndTime($passageId);
            }
            $style = $this->commonService->styleGetByPassageId($passageId);
            if (!empty($style['style'])) {
                $style = $style['style'];
            }
            return view('question.dynamic-questions', compact('questions', 'survey', 'passageId', 'style'));
        }
        return redirect()->route('dynamic.passage');

    }

    public function passageReadAgain($passageId): View
    {
        /** @var UserProgress $progressInfo */
        $progressInfo = $this->commonService->userProgressByPassageId($passageId);
        $this->commonService->updateUserProgressBackTimes($progressInfo);

        $passage = $progressInfo['passage'];
        $availableStyles = $progressInfo['style'];
        return view('passage.dynamic-passage', compact('passage', 'availableStyles'));


    }
}
