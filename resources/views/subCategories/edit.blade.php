@extends('layouts.app')

@section('content')
	@validationErrors
	@endvalidationErrors
	@notification
	@endnotification
	<div class="card">
		<div class="card-header">
			Edytuj subkategorie
		</div>
		<div class="card-body">
			<form action="{{ route('updateSubCategory', ['id' => $subCategory->id]) }}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				{!! method_field('put') !!}
				<div class="form-group">
					<label for="exampleFormControlInput1">Nazwa</label>
					<input type="text" class="form-control" name="name" placeholder="Nazwa" value=" {{ $subCategory->name }}" required>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Opis</label>
					<textarea class="form-control" name="description" rows="3" required>{{ $subCategory->description }}</textarea>
				</div>
				<div>
					<div class="form-group d-inline-block">
						<label for="exampleInputFile">Miniatura</label>
						<input type="file" class="form-control-file" name="image" aria-describedby="fileHelp">
					</div>
					<div class="d-inline-block" style="max-width: 100px">
						<img class="img-thumbnail" src="{{ asset('storage/' . $subCategory->picture_file_name) }}">
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Zapisz</button>
			</form>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header">
			Dodaj zaestaw słówek
		</div>
		<div class="card-body">
			<form action="{{ route('insertSet') }}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="id" value="{{ $subCategory->id }}">
				<div class="form-group">
					<label for="exampleFormControlInput1">Nazwa</label>
					<input type="text" class="form-control" name="name" placeholder="Nazwa" required>
				</div>
				<div class="form-group">
					<label for="lang1">Język 1</label>
					<select class="form-control" id="lang1" required name="lang[]">
						<option disabled selected></option>
					@foreach($languages as $id => $name)
							<option value="{{ $id }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="lang2">Język 2</label>
					<select class="form-control" id="lang2" required name="lang[]">
						<option disabled selected></option>
					@foreach($languages as $id => $name)
							<option value="{{ $id }}">{{ $name }}</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-primary add-set">Zapisz</button>
			</form>
		</div>
	</div>

	<div class="card mt-3">
		<div class="card-header">
			Zestawy słówek
		</div>
		<div class="card-body">
			<table class="table table-striped mt-3">
				<thead>
				<tr>
					<th scope="col">LP</th>
					<th scope="col">Nazwa</th>
					<th scope="col">Język 1</th>
					<th scope="col">Język 2</th>
					<th scope="col">Ilość</th>
					<th scope="col">Zobacz</th>
					@if (Auth::check() && Auth::user()->hasAnyRole([\App\Role::ROLES['ADMIN'],\App\Role::ROLES['SUPER_EDITOR'], \App\Role::ROLES['EDITOR']]))
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
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="error-add-set">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Błąd</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Wybierz 2 inne języki</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
				</div>
			</div>
		</div>
	</div>

@endsection
