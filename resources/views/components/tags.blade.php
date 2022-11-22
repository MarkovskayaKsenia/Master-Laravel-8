<p>
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tag.index', ['tag' => $tag->id]) }}" class="badge bg-success badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>
