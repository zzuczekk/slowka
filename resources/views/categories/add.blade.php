@extends('layouts.app')

@section('content')
    @validationErrors
    @endvalidationErrors
    <form action="{{ route('insertCategory') }}" method="post" >
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="exampleFormControlInput1">Nazwa</label>
            <input type="text" class="form-control" name="name" placeholder="Nazwa" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Opis</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>

    </form>
@endsection
