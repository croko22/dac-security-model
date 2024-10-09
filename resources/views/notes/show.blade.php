<h1>{{ $note->title }}</h1>
<p>{{ $note->content }}</p>

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
