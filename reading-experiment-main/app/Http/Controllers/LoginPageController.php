<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;

class LoginPageController extends Controller
{
    //
    public function index()
    {
        return view('login.index');
    }

    public function submitSurvey(Request $request): RedirectResponse
    {

        $request->validate([
            'profession' => 'required',
            'age' => 'required|numeric|min:1',
            'gender' => 'required',
            'language' => 'required',
            'english' => 'required',
            'reader' => 'required',
        ]);

        $user = User::create([]);
        auth()->login($user);
        $data = $request->only(['profession', 'age', 'gender', 'language', 'english', 'reader']);
        $data['user_id'] = $user->id;
        Survey::query()->create($data);

        return redirect()->route('consent.form');
    }

    public function showConsentForm()
    {
        // return view('login.consent');
        if (session()->get('survey_start')) {
            return redirect()->route('dynamic.passage');
        }
        return view('login.consent_info');
    }

    public function logout()
    {

        auth()->logout();
    }
}
