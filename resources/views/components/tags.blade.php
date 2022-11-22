<p>
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tag.index', ['tag' => $tag->id]) }}" class="alert alert-success alert-lg">{{ $tag->name }}</a>
    @endforeach
</p>
