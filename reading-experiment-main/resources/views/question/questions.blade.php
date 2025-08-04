<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple-Choice Questions</title>
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
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 1900px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        .question {
            margin: 10px 0;
            text-align: left;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 150px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Multiple-Choice Questions</h1>
        <form id="surveyForm">
            @csrf
            <p id="error-message" class="error"></p>
            <input type="hidden" id="survey_id" name="survey_id" value="1"> <!-- Example value -->
            
            <div class="question">
                <label>1. What is a "Personal Legend" according to the old king?</label><br>
                <label><input type="radio" name="q1" value="A"> A map to a treasure</label><br>
                <label><input type="radio" name="q1" value="B"> A person's true purpose and desire</label><br>
                <label><input type="radio" name="q1" value="C"> A warning about danger</label><br>
                <label><input type="radio" name="q1" value="D"> A prophecy of the future</label>
            </div>

            <div class="question">
                <label>2. What job did Santiago take on during his journey?</label><br>
                <label><input type="radio" name="q2" value="A"> A shepherd</label><br>
                <label><input type="radio" name="q2" value="B"> A crystal merchant's assistant</label><br>
                <label><input type="radio" name="q2" value="C"> A gold miner</label><br>
                <label><input type="radio" name="q2" value="D"> A fisherman</label>
            </div>

            <div class="question">
                <label>3. What does the king say the universe will do when you want something deeply?</label><br>
                <label><input type="radio" name="q3" value="A"> Create obstacles</label><br>
                <label><input type="radio" name="q3" value="B"> Conspire to help you achieve it</label><br>
                <label><input type="radio" name="q3" value="C"> Make it impossible</label><br>
                <label><input type="radio" name="q3" value="D"> Test your patience</label>
            </div>


            <div class="button-container">
                <button type="button" class="button" id="submitAnswers">Submit</button>
            </div>
        </form>
    </div>

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

            fetch("{{ route('questions.submit') }}", {
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
                    window.location.href = "{{ route('passage2.show') }}"; // Redirect to the next page
                } else {
                    errorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                errorMessage.textContent = "Something went wrong. Please try again.";
            });
        });
    </script>
</body>
</html>
