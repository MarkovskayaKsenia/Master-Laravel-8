<div class="container">
    <div class="row">
        <x-card title='Most commented'>
            @slot('subtitle')
                What people are currently talking about.
            @endslot
            @slot('items')
                @foreach($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            @endslot
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card title='Most Active' {{--subtitle='Users with most posts written'--}}>
            @slot('subtitle', 'Users with most posts written!!!!!!!')
            @slot('items', collect($mostActive)->pluck('name'))
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card title='Most Active Last Month'>
            @slot('subtitle', 'Users with most posts written in the last month.')
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        </x-card>
    </div>
</div>
