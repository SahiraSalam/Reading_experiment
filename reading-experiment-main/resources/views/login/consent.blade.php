<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent Form</title>
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
            width: 900px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 80%;  /* Use percentage width to make it more responsive */
            max-width: 1900px;  /* Limits the maximum width */
            height: auto;  /* Adjusts the container height based on content */
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
        <h1>Information Letter and Consent Form</h1>
        <p>Dear Participate,
            My name is Sahira Salam, and I am a master's student at DTU conducting an experiment as part of my master's thesis. You are invited to participate in a research study that explores how inter-letter spacing and inter-line spacing impact reading behavior. It is important that you read this information letter carefully and understand the terms before agreeing to participate. If you have any questions or concerns regarding the experiment, please feel free to contact me(Sahira Salam - s222499@dtu.dk) at any time.
        </p>
        <h2>Your rights as Participant:</h2>
        <p>Your participation in this study is completely voluntary. You have the right to:
        </p>
        <h2>Purpose of the Study:</h2>
        <p>This research is part of ‘Reading the Reader’ project. The purpose of this study is to explore how text formatting influences reading speed, reading comprehension, and eye movement patterns. The findings may help improve reading interfaces for digital platforms and enhance educational materials for various readers</p>
        <ul class="a">
            <li>Decline to participate without facing any consequences.</li>
            <li>Withdraw from the study at any time, even if you have already given your consent.</li>
        </ul>


        <div class="checkbox-group">
            <label>
                <input type="checkbox" name="accept" id="accept" value="1" required onclick="toggleCheckbox('accept', 'decline')"> Accept
            </label>
            <label>
                <input type="checkbox" name="accept" id="decline" value="0" onclick="toggleCheckbox('decline', 'accept')"> Decline
            </label>
        </div>
        <br>
        <button type="button" class="button" id="submitConsent">Next</button>
        <p id="error-message" class="error"></p>
    </div>

    <script>
        function toggleCheckbox(selectedId, otherId) {
            let selectedCheckbox = document.getElementById(selectedId);
            let otherCheckbox = document.getElementById(otherId);
            let nextButton = document.getElementById("submitConsent");

            if (selectedId === 'decline' && selectedCheckbox.checked) {
                nextButton.disabled = true;
            } else {
                nextButton.disabled = false;
            }

            if (selectedCheckbox.checked) {
                otherCheckbox.disabled = true;
            } else {
                otherCheckbox.disabled = false;
            }
        }

        document.getElementById("submitConsent").addEventListener("click", function() {
            let acceptCheckbox = document.getElementById("accept");
            let declineCheckbox = document.getElementById("decline");
            let errorMessage = document.getElementById("error-message");

            if (!acceptCheckbox.checked && !declineCheckbox.checked) {
                errorMessage.textContent = "Please select an option.";
                return;
            }

            let consentValue = acceptCheckbox.checked ? 1 : 0;

            fetch("{{ route('consent.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ accept: consentValue })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('passage.show') }}";
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
