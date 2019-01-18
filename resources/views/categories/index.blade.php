@extends('layouts.app')
@section('content')
	@notification @endnotification
	@if (Auth::check() && Auth::user()->hasRole(\App\Role::ROLES['ADMIN']))
	<div class="row">
		<div class="col-md-12 text-center mb-5">
			<a class="btn btn-primary btn-lg" href="{{ route('addCategory') }}">Dodaj kategorie</a>
		</div>

	</div>
	@endif
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Nazwa</th>
			<th scope="col">Miniatura</th>
			<th scope="col">Zobacz</th>
			<th scope="col">Edytuj</th>
			<th scope="col">Usuń</th>
		</tr>
		</thead>
		<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $category->name }}</td>
				<td><img src="{{ $category->picture_file_name }}"></td>
				<td><a class="btn btn-primary" href="{{ route('showCategory', ['id' => $category->id]) }}">Zobacz</a> </td>
				<td><a class="btn btn-warning" href="{{ route('editCategory', ['id' => $category->id]) }}">Edytuj</a> </td>
				<td>
					<form action="{{ route('deleteCategory', ['id' => $category->id]) }}" method="post">
						<input class="btn btn-danger" type="submit" value="Usuń" />
						<input type="hidden" name="_method" value="delete" />
						{!! method_field('delete') !!}
						{!! csrf_field() !!}
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
