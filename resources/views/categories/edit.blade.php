@extends('layouts.app')

@section('content')
	@validationErrors
	@endvalidationErrors
	<div class="card">
		<div class="card-header">
			Edytuj kategorie
		</div>
		<div class="card-body">
			<form action="{{ route('updateCategory', ['id' => $category->id]) }}" method="post" >
				{!! csrf_field() !!}
				{!! method_field('put') !!}
				<div class="form-group">
					<label for="exampleFormControlInput1">Nazwa</label>
					<input type="text" class="form-control" name="name" placeholder="Nazwa" value=" {{ $category->name }}" required>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Opis</label>
					<textarea class="form-control" name="description" rows="3" required>{{ $category->description }}</textarea>
				</div>
				<button type="submit" class="btn btn-primary">Zapisz</button>
			</form>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header">
			Dodaj subkategorie
		</div>
		<div class="card-body">
			<form action="{{ route('insertSubCategory') }}" method="post" >
				{!! csrf_field() !!}
				<input type="hidden" name="id" value="{{ $category->id }}">
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
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header">
			Subkategorie
		</div>
		<div class="card-body">
			<table class="table table-striped mt-3">
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
				@foreach($category->subcategories as $subCategory)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $subCategory->name }}</td>
						<td><img src="{{ $subCategory->picture_file_name }}"></td>
						<td><a class="btn btn-primary" href="{{ route('showSubCategory', ['id' => $subCategory->id]) }}">Zobacz</a> </td>
						<td><a class="btn btn-warning" href="{{ route('editSubCategory', ['id' => $subCategory->id]) }}">Edytuj</a> </td>
						<td>
							<form action="{{ route('deleteSubCategory', ['id' => $subCategory->id]) }}" method="post">
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
		</div>
	</div>

@endsection