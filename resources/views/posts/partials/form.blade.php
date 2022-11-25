
<div class="mb-3">
    <label for="title">Title</label>
    <input id="title" type="text" name="title" class="form-control" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
{{--@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror--}}
<div class="mb-3">
    <label for="content">Content</label>
    <textarea id="content" name="content" class="form-control">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="mb-3">
    <label for="file">Thumbnail</label>
    <input type="file" name="thumbnail" id="file" class="form-control">
</div>

<x-errors>
</x-errors>
