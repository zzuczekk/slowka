@extends('layouts.app')

@section('content')
	@validationErrors
	@endvalidationErrors
	<div class="card">
		<div class="card-header">
			Edytcja
		</div>
		<div class="card-body">
			<form action="{{ route('updateSet', ['id' => $set->id]) }}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				{!! method_field('put') !!}
				<div class="form-group">
					<label for="exampleFormControlInput1">Nazwa</label>
					<input type="text" class="form-control" name="name" placeholder="Nazwa" value=" {{ $set->name }}" required>
				</div>
				<h4 class="mt-4">Słówka</h4>
				<div id="words" class="text-center">
					<div class="row">
						<div class="col-5">{{ $set->language1->name }}</div>
						<div class="col-5">{{ $set->language2->name }}</div>
					</div>

					@foreach($words as $key => $word)
						<div class="row mt-1">
							<div class="col-5">
								<input type="text" class="form-control" name="lang1[]" value="{{ $word[0] }}" required>
							</div>
							<div class="col-1"> < = ></div>
							<div class="col-5">
								<input type="text" class="form-control" name="lang2[]" value="{{ $word[1] }}" required>
							</div>
							<div class="col-1">
								<div class="btn btn-primary btn-sm font-weight-bold remove-row">-</div>
							</div>
						</div>
					@endforeach
					<div class="row float-right mt-3 last-row">
						<div class="col-12">
							<div id="new-words" class="btn btn-primary">Dodaj nowe słowko</div>
							<input class="btn btn-success" type="submit" value="Zapisz">
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>

	<script>

	</script>
@endsection
