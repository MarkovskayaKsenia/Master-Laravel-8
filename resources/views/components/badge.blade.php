@if(!isset($show) || $show)
    <span class="alert alert-{{ $type ?? 'info' }}">
        {{ $slot }}
    </span>
@endif

