<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 80px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 1900px;
            text-align: left;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .question {
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
        }
        .options {
            list-style: none;
            padding: 0;
        }
        .options li {
            margin: 5px 0;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .back {
            background-color: #6c757d;
        }
        .back:hover {
            background-color: #545b62;
        }
        #error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Multiple-Choice Questions:</h1>

        <form id="surveyForm">
            @csrf
            <input type="hidden" id="survey_id" name="survey_id" value="{{ $survey_id ?? 1 }}">

            <div class="question">
                <p>1. What is a "Personal Legend" according to the old king?</p>
                <ul class="options">
                    <li><input type="radio" name="q1" value="1"> A map to a treasure</li>
                    <li><input type="radio" name="q1" value="2"> A person’s true purpose and desire</li>
                    <li><input type="radio" name="q1" value="3"> A warning about danger</li>
                    <li><input type="radio" name="q1" value="4"> A prophecy of the future</li>
                </ul>
            </div>

            <div class="question">
                <p>2. What job did Santiago take on during his journey?</p>
                <ul class="options">
                    <li><input type="radio" name="q2" value="1"> A shepherd</li>
                    <li><input type="radio" name="q2" value="2"> A crystal merchant’s assistant</li>
                    <li><input type="radio" name="q2" value="3"> A gold miner</li>
                    <li><input type="radio" name="q2" value="4"> A fisherman</li>
                </ul>
            </div>

            <div class="question">
                <p>3. What does the king say the universe will do when you want something deeply?</p>
                <ul class="options">
                    <li><input type="radio" name="q3" value="1"> Create obstacles</li>
                    <li><input type="radio" name="q3" value="2"> Conspire to help you achieve it</li>
                    <li><input type="radio" name="q3" value="3"> Make it impossible</li>
                    <li><input type="radio" name="q3" value="4"> Test your patience</li>
                </ul>
            </div>

            <p id="error-message"></p>

            <div class="button-container">
                <button type="button" class="button back" onclick="window.location.href='{{ route('passage4.show') }}'">Back</button>
                <button type="button" class="button" id="submitAnswers">Submit</button>
            </div>
        </form>
    </div>
</body>

<script>
    let startTime = new Date();

    document.getElementById("submitAnswers").addEventListener("click", function() {
        let surveyId = document.getElementById("survey_id").value;
        let errorMessage = document.getElementById("error-message");
        let answers = {};
        let questions = ["q1", "q2", "q3"];

        for (let question of questions) {
            let selectedOption = document.querySelector(`input[name="${question}"]:checked`);
            if (selectedOption) {
                answers[question] = selectedOption.value;
            } else {
                errorMessage.textContent = "Please answer all questions before submitting.";
                return;
            }
        }

        let endTime = new Date();
        let timeTaken = (endTime - startTime) / 1000;

        fetch("{{ route('quiz.submit') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                survey_id: surveyId,
                answers: answers,
                start_time: startTime.toISOString(),
                end_time: endTime.toISOString(),
                time_taken: timeTaken
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('last.show') }}"; 
            } else {
                errorMessage.textContent = data.message;
            }
        })
        .catch(error => {
            errorMessage.textContent = "Something went wrong. Please try again.";
        });
    });
</script>

</html>
