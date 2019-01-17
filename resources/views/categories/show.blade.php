@extends('layouts.app')

@section('content')
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
		@foreach($category->subcategories as $subcategory)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $subcategory->name }}</td>
				<td><img src="{{ $category->picture_file_name }}"></td>
				<td><a href="{{ route('showCategory', ['id' => $subcategory->id]) }}">Zobacz</a> </td>
				<td>
					<form action="{{ route('deleteCategory', ['id' => $subcategory->id]) }}" method="post">
						<input class="btn btn-default" type="submit" value="Usuń" />
						{!! method_field('delete') !!}
						{!! csrf_field() !!}
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
