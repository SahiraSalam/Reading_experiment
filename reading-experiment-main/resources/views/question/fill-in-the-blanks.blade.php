<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill in The Blanks</title>
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
        }
        .question {
            margin-bottom: 20px;
        }
        .question label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .question input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            width: 48%;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fill in The Blanks</h1>
        <form action="{{route('fill.in.the.blanks.submit')}}" method="POST" id="fill-form">
            @csrf
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
            <input type="hidden" value="blanks" name="blanks">
            <div class="question">
                <label>1. Santiago learns from the old king that when you truly want something, the entire --- conspires to help you achieve it.</label>
                <input type="text" name="q1" placeholder="Your answer">
            </div>
            <div class="question">
                <label>2. The old king introduces Santiago to the concept of a ---, which means a person’s true purpose in life.</label>
                <input type="text" name="q2" placeholder="Your answer">
            </div>
            <div class="question">
                <label>3. During his journey, Santiago works for a --- merchant, where he learns valuable life lessons.</label>
                <input type="text" name="q3" placeholder="Your answer">
            </div>
            <div class="question">
                <label>4. Santiago meets and falls in love with --- at the oasis, but he continues his journey to fulfill his destiny.</label>
                <input type="text" name="q4" placeholder="Your answer">
            </div>
            <div class="question">
                <label>5. The true treasure Santiago finds is not just gold but the --- he gains through his journey and self-discovery.</label>
                <input type="text" name="q5" placeholder="Your answer">
            </div>
            <div class="button-container">
                <button type="button" class="button" onclick="window.location.href='{{ route('passage3.show') }}'">Back</button>
                <button type="submit" class="button" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>

<script>
    document.getElementById("fill-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let answers = {};
    document.querySelectorAll("input[type='text']").forEach((input) => {
        answers[input.name] = input.value.trim();
    });

    let surveyId = document.querySelector('input[name="survey_id"]').value;
    let requestData = {
        survey_id: surveyId,
        answers: answers,
        blanks: "blanks", // Ensure this is included
        start_time: new Date().toISOString(),
        end_time: new Date().toISOString(),
    };

    console.log("Submitting data:", requestData); // Debugging

    fetch("{{ route('fill.in.the.blanks.submit') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        console.log("Server response:", data);
        if (data.success) {
            window.location.href = data.redirect_url;
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