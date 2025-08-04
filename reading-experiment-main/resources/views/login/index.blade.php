@extends('layouts.auth')
@section('title', 'Survey Form')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto  mt-5  ">
                <div class="card rounded-1 w-100">
                    <div class="card-header text-center bg-info-subtle">
                        <h4 class="card-title text-dark">Survey Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('survey.submit') }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label class="form-label" for="profession">What is your Profession?<span
                                        class="text-danger">*</span></label>
                                <select id="profession" class="form-control form-select" name="profession">
                                    <option value="">Select Profession</option>
                                    <option value="student">Student</option>
                                    <option value="working">Working</option>
                                </select>
                                @error('profession') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <div class="my-3">
                                <label class="form-label" for="age">Your Age<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="age" name="age" value="{{ old('age') }}">
                                @error('age') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="my-3">
                                <label class="form-label" for="gender">Gender<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="gender" name="gender"
                                       value="{{ old('gender') }}">
                                @error('gender') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <div class="my-3">
                                <label class="form-label" for="language">What is your first language?<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="language" name="language"
                                       value="{{ old('language') }}"
                                       placeholder="e.g., English">
                                @error('language') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="my-3">
                                <label class="form-label" for="english">Are you fluent in English?<span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select" id="english" name="english">
                                    <option value="">Select Fluency</option>
                                    <option value="fluent">Fluent</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="beginner">Beginner</option>
                                </select>
                                @error('english') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="my-3">
                                <label class="form-label" for="reader">Are you a Reader?<span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select" id="reader" name="reader">
                                    <option value="">Select Reading Habit</option>
                                    <option value="avid">Avid Reader</option>
                                    <option value="reader">Reader</option>
                                    <option value="non-reader">Non-Reader</option>
                                </select>
                                @error('reader') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="mt-5 text-end">
                                <button type="submit" class="btn btn-outline-dark">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
