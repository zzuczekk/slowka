@extends('layouts.app')

@section('content')
	@notification
	@endnotification
	<h1>{{ $subCategory->name }}</h1>
	<div>{{ $subCategory->description }}</div>
	<div style="max-width: 300px">
		<img class="img-thumbnail" src="{{ asset('storage/' . $subCategory->picture_file_name) }}">
	</div>

	<table class="table table-striped mt-3">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Nazwa</th>
			<th scope="col">Język 1</th>
			<th scope="col">Język 2</th>
			<th scope="col">Ilość</th>
			<th scope="col">Zobacz</th>
			@if (Auth::check() && Auth::user()->hasAnyRole([\App\Role::ROLES['ADMIN'], \App\Role::ROLES['SUPER_EDITOR'], \App\Role::ROLES['EDITOR']]))
				<th scope="col">Edytuj</th>
				<th scope="col">Usuń</th>
			@endif
		</tr>
		</thead>
		<tbody>
		@foreach($subCategory->sets as $set)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $set->name }}</td>
				<td>{{ $set->language1->name }}</td>
				<td>{{ $set->language2->name }}</td>
				<td>{{ $set->number_of_words }}</td>
				<td><a class="btn btn-success" href="{{ route('showSet', ['id' => $set->id]) }}">Zobacz</a> </td>


				@if (Auth::check() && Auth::user()->hasAnyRole([\App\Role::ROLES['ADMIN'],\App\Role::ROLES['SUPER_EDITOR'], \App\Role::ROLES['EDITOR']]))
					<td><a class="btn btn-warning" href="{{ route('editSet', ['id' => $set->id]) }}">Edytuj</a> </td>
					<td>
						<form action="{{ route('deleteSet', ['id' => $set->id]) }}" method="post">
							<input class="btn btn-danger delete" type="submit" value="Usuń" />
							<input type="hidden" name="_method" value="delete" />
							{!! method_field('delete') !!}
							{!! csrf_field() !!}
						</form>
					</td>
				@endif
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
