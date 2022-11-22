@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>
                {{ $post->title }}

                {{--@component('components.badge', ['type' => 'primary'])
                    Brand new Post!
                @endcomponent--}}
                <x-badge type="primary" :show="now()->diffInMinutes($post->created_at) < 20">
                    Brand new Post!
                </x-badge>

            </h1>
            <p>{{ $post->content }}</p>

            <x-updated :date="$post->created_at" :name="$post->user->name">
            </x-updated>
            <x-updated :date="$post->updated_at">
                Updated
            </x-updated>
            <x-tags :tags="$post->tags"></x-tags>

            <p>Currently read by {{ $counter }} people</p>

            <h4>Comments</h4>
            @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                <x-updated :date="$comment->created_at">
                </x-updated>
            @empty
                <p>Not comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection
