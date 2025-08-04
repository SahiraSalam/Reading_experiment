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
            padding: 80px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1900px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }
        h1 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .question {
            margin-bottom: 10px;
            font-size: 14px;
        }
        .question label {
            display: block;
            font-weight: bold;
            font-size: 14px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 48%;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Multiple-Choice Questions</h1>
        <form action="{{route('questions2.submit')}}" method="POST">
            @csrf
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
            <div class="question">
                <label>1. What is a "Personal Legend" according to the old king?</label>
                <label><input type="radio" name="q1" value="A"> A map to a treasure</label>
                <label><input type="radio" name="q1" value="B"> A person's true purpose and desire</label>
                <label><input type="radio" name="q1" value="C"> A warning about danger</label>
                <label><input type="radio" name="q1" value="D"> A prophecy of the future</label>
            </div>
            <div class="question">
                <label>2. What job did Santiago take on during his journey?</label>
                <label><input type="radio" name="q2" value="A"> A shepherd</label>
                <label><input type="radio" name="q2" value="B"> A crystal merchant's assistant</label>
                <label><input type="radio" name="q2" value="C"> A gold miner</label>
                <label><input type="radio" name="q2" value="D"> A fisherman</label>
            </div>
            <div class="question">
                <label>3. What does the king say the universe will do when you want something deeply?</label>
                <label><input type="radio" name="q3" value="A"> Create obstacles</label>
                <label><input type="radio" name="q3" value="B"> Conspire to help you achieve it</label>
                <label><input type="radio" name="q3" value="C"> Make it impossible</label>
                <label><input type="radio" name="q3" value="D"> Test your patience</label>
            </div>
            <div class="question">
                <label>4. Who is Fatima?</label>
                <label><input type="radio" name="q4" value="A"> Santiago's mother</label>
                <label><input type="radio" name="q4" value="B"> A fortune teller</label>
                <label><input type="radio" name="q4" value="C"> The woman he loves from the oasis</label>
                <label><input type="radio" name="q4" value="D"> The crystal merchant's daughter</label>
            </div>
            <div class="question">
                <label>5. What is the greatest treasure Santiago finds?</label>
                <label><input type="radio" name="q5" value="A"> Gold coins</label>
                <label><input type="radio" name="q5" value="B"> The love of Fatima</label>
                <label><input type="radio" name="q5" value="C"> Knowledge and self-discovery</label>
                <label><input type="radio" name="q5" value="D"> A magical elixir</label>
            </div>
            <div class="button-container">
                <button type="button" class="button" onclick="window.location.href='{{ route('passage2.show') }}'">Back</button>
                <button type="button" class="button" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>


<script>
    document.getElementById("submit-btn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default form submission

        let answers = {};
        document.querySelectorAll("input[type='radio']:checked").forEach((input) => {
            answers[input.name] = input.value;
        });

        let surveyId = document.querySelector('input[name="survey_id"]').value;

        fetch("{{ route('questions2.submit') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                survey_id: surveyId,
                answers: answers,
                start_time: new Date().toISOString(),
                end_time: new Date().toISOString(),
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url; // Redirect to passage3
            } else {
                alert("Something went wrong: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error submitting answers. Please try again.");
        });
    });
</script>


</html>