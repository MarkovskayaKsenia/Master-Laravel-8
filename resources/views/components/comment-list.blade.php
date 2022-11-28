@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-updated :date="$comment->created_at" :name="$comment->user->name" :userId="$comment->user->id">
    </x-updated>
@empty
    <p>Not comments yet!</p>
@endforelse
