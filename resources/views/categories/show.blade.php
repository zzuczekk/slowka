@extends('layouts.app')

@section('content')
	@notification
	@endnotification
	<h1>{{ $category->name }}</h1>
	<div>{{ $category->description }}</div>
	<div style="max-width: 300px">
		<img class="img-thumbnail" src="{{ asset('storage/' . $category->picture_file_name) }}">
	</div>

	<table class="table table-striped mt-3">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Nazwa</th>
			<th scope="col">Miniatura</th>
			<th scope="col">Zobacz</th>
			@if (Auth::check() && Auth::user()->hasAnyRole([\App\Role::ROLES['ADMIN'], \App\Role::ROLES['SUPER_EDITOR']]))
				<th scope="col">Edytuj</th>
				<th scope="col">Usuń</th>
			@endif
		</tr>
		</thead>
		<tbody>
		@foreach($category->subcategories as $subCategory)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $subCategory->name }}</td>
				<td><img class="img-thumbnail" width="100px" src="{{ asset('storage/' . $subCategory->picture_file_name) }}"></td>
				<td><a class="btn btn-primary" href="{{ route('showSubCategory', ['id' => $subCategory->id]) }}">Zobacz</a> </td>
				@if (Auth::check() && Auth::user()->hasAnyRole([\App\Role::ROLES['ADMIN'], \App\Role::ROLES['SUPER_EDITOR']]))
					<td><a class="btn btn-warning" href="{{ route('editSubCategory', ['id' => $subCategory->id]) }}">Edytuj</a> </td>
					<td>
						<form action="{{ route('deleteSubCategory', ['id' => $subCategory->id]) }}" method="post">
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
