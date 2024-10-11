<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Details</title>
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
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $note->title }}</h1>
        @if (Auth::user()->id === $note->user_id ||
                ($note->sharedUsers->find(Auth::user()->id) &&
                    $note->sharedUsers->find(Auth::user()->id)->pivot->permission === 'write'))
            <!-- Form to edit the note -->
            <form action="{{ route('notes.update', $note) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ $note->title }}">
                </div>
                <div>
                    <label for="content">Content:</label>
                    <textarea id="content" name="content">{{ $note->content }}</textarea>
                </div>
                <button type="submit">Update Note</button>
            </form>
        @else
            <!-- Display the note content -->
            <p>{{ $note->content }}</p>
        @endif

        <!-- Display current user's permissions and ownership status -->
        @if (Auth::user()->id === $note->user_id)
            <p>You are the owner of this note.</p>

            <form action="{{ route('notes.share', $note) }}" method="POST">
                @csrf
                <select name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <select name="permission">
                    <option value="read">Read</option>
                    <option value="write">Write</option>
                </select>
                <button type="submit">Share</button>
            </form>

            <form action="{{ route('notes.revoke', $note) }}" method="POST">
                @csrf
                <select name="user_id">
                    @foreach ($note->sharedUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Revoke Access</button>
            </form>
        @else
            @php
                $sharedUser = $note->sharedUsers->find(Auth::user()->id);
            @endphp
            @if ($sharedUser && $sharedUser->pivot->permission === 'write')
                <p>You have write permission for this note.</p>
            @elseif ($sharedUser && $sharedUser->pivot->permission === 'read')
                <p>You have read permission for this note.</p>
            @endif
        @endif

        <a href="{{ route('notes.index') }}"
            style="display: inline-block; margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; background-color: #007bff; color: white; text-decoration: none;">Go
            Back</a>
    </div>
</body>

</html>
