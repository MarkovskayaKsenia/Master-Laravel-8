<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>
            <x-errors>
            </x-errors>
            <div class="d-grid gap-2">
                <input type="submit" value="Add comment" class="btn btn-primary">
            </div>
        </form>
    @else
        <a href="{{ route('login') }}">Sign-in to post comments!</a>
    @endauth
</div>
<hr/>
