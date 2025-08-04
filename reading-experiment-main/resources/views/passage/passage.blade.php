<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passage</title>
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
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .button-container {
            display: flex;
            justify-content: flex-end; /* Aligns button to the right */
            margin-top: 5px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 150px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Passage 1: Standard Text</h1>
        <h2>Topic: The AI-Chemist</h2>
        <p>
            The boy, Santiago, had been watching over his sheep when he dreamt of a treasure hidden near the Egyptian pyramids. An old king named Melchizedek told him about the concept of a "Personal Legend"—a person’s true desire and purpose in life. The king said, “When you want something, all the universe conspires in helping you to achieve it.” Santiago decided to sell his sheep and embark on his journey. Along the way, he worked for a crystal merchant, learning that sometimes it is fear of failure that holds people back.
        </p>
        <p>
            He met an Englishman studying alchemy and eventually found himself in an oasis where he met the woman he loved, Fatima. Despite his feelings, he knew he must continue his quest, for true love never keeps a person from pursuing their destiny. Facing the desert’s challenges, Santiago learned that the treasure was not only at the end of his journey but also in what he discovered about himself along the way.
        </p>
        <div class="button-container">
            <button type="button" class="button" onclick="window.location.href='{{ route('questions.show') }}'">Next</button>
        </div>
    </div>
</body>
</html>
