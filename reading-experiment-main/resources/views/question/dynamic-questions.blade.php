@extends('layouts.auth')
@section('title', 'Multiple-Choice Questions')
@push('styles')

    <style>
        .card-body {
            height: 95vh !important;
        }

        {!! $style->style !!}
    </style>

@endpush

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-4 ">
                <div class="card p-0 m-0 text-start">

                    <div class="card-body position-relative shadow border-0">


                        <form id="surveyForm">
                            @csrf
                            {{--                            <div class="overflow-x-auto" style="height: 80vh">--}}
                            <div class="text-center">
                                <p id="error-message" class="text-danger"></p>
                            </div>
                            @foreach($questions as $index=>$question)
                                <label class="form-label p-0 m-0">
                                    {{$index+1}}. {{$question->title}}
                                </label>
                                @foreach($question->questionOptions as $option)

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q{{$index+1}}"
                                               value="{{$question['id']}}-{{$option['id']??null}}-{{$option['value']??null}}"
                                               id="{{$question['id']}}-{{$option['id']??null}}-{{$option['value']??null}}"

                                        />
                                        <label class="form-check-label"
                                               for="{{$question['id']}}-{{$option['id']??null}}-{{$option['value']??null}}">
                                            {{$option['title']??null}}
                                        </label>
                                    </div>

                                @endforeach

                            @endforeach
                            {{--                            </div>--}}
                            <div class="   position-absolute bottom-0  d-flex justify-content-between mb-2"
                                 style="width: 98%">
                                <a href="{{route('passage.back.check',['passage_id'=>base64_encode($passageId)])}}"
                                   class="btn btn-primary">Back</a>

                                <button type="button" class="btn btn-primary" id="submitAnswers">Submit</button>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let startTime = new Date();

        document.getElementById("submitAnswers").addEventListener("click", function () {
            let errorMessage = document.getElementById("error-message");
            let answers = {};
            let questions = ["q1", "q2", "q3"];

            for (let question of questions) {
                let selectedOption = document.querySelector(`input[name="${question}"]:checked`);


                if (selectedOption) {
                    answers[question] = selectedOption.value;
                } else {
                    console.log(answers);
                    errorMessage.textContent = "Please answer all questions before submitting.";
                    return;
                }
            }


            let endTime = new Date();
            let timeTaken = (endTime - startTime) / 1000;

            fetch("{{ route('questions.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    answers: answers,
                    passage_id: '{{$passageId}}',
                    start_time: startTime.toISOString(),
                    end_time: endTime.toISOString(),
                    time_taken: timeTaken
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('dynamic.passage') }}"; // Redirect to the next page
                    } else {
                        errorMessage.textContent = data.message;
                    }
                })
                .catch(error => {
                    console.log(error)
                    errorMessage.textContent = "Something went wrong. Please try again.";
                });
        });
    </script>
@endpush

