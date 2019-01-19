@extends('layouts.app')
@section('content')
	@notification @endnotification
	@validationErrors @endvalidationErrors
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Nazwa</th>
			<th scope="col">E-mail</th>
			<th scope="col">Data utworzenia</th>
			<th scope="col">Role</th>
		</tr>
		</thead>
		<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->created_at }}</td>
				<td>
					<form method="post" action="{{ route('updateUser', ['id' => $user->id]) }}">
						{!! method_field('put') !!}
						{!! csrf_field() !!}
						@foreach($roles as $id => $name)
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" name="roles" type="checkbox" value="{{ $id }}" {{ $user->roles->where('id', $id)->count() ? 'checked' : ''}}> {{ $name }}
								</label>
							</div>
						@endforeach
						<div class="d-inline-block">
							<input class="btn btn-success" type="submit" value="Zapisz" />
						</div>
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
