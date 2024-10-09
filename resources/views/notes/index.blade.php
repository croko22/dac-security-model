hola
@foreach ($notes as $note)
    <h2>{{ $note->title }}</h2>
    <p>{{ $note->content }}</p>
    <a href="{{ route('notes.show', $note) }}">View</a>
@endforeach

<h1>Shared with me</h1>
@foreach ($shared_notes as $note)
    <h2>{{ $note->title }}</h2>
    <p>{{ $note->content }}</p>
    <a href="{{ route('notes.show', $note) }}">View</a>
@endforeach
