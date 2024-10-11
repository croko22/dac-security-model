<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
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
            max-width: 800px;
            margin: 20px;
            padding: 20px;
            margin-top: 100px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>NOTAS</h1>
        @foreach ($notes as $note)
            <div class="note">
                <h2>{{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
                <a href="{{ route('notes.show', $note) }}">View</a>
            </div>
        @endforeach

        <h1>COMPARTIDO CONMIGO</h1>
        @foreach ($shared_notes as $note)
            <div class="note">
                <h2>{{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
                <a href="{{ route('notes.show', $note) }}">View</a>
            </div>
        @endforeach
    </div>
</body>

</html>
