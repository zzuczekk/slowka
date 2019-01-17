@extends('layouts.app')

@section('content')
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Nazwa</th>
			<th scope="col">Miniatura</th>
			<th scope="col">Zobacz</th>
			<th scope="col">Usuń</th>
		</tr>
		</thead>
		<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $category->name }}</td>
				<td><img src="{{ $category->picture_file_name }}"></td>
				<td><a href="{{ route('showCategory', ['id' => $category->id]) }}">Zobacz</a> </td>
				<td><a href="{{ route('deleteCategory', ['id' => $category->id]) }}">Usuń</a> </td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
