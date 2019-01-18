@if (Session::has('notification'))
    <div class="alert alert-{{ Session::get('notification')['type'] ?? 'dupa' }}">
        {{ Session::get('notification')['text'] ?? 'dupa' }}
    </div>
@endif