@extends('layouts.app')

@section('content')
	<h1>{{ $set->name }}</h1>
	<table class="table table-striped mt-3">
		<thead>
		<tr>
			<th scope="col">LP</th>
			<th scope="col">Język {{ $set->language1->name }}</th>
			<th scope="col">Język {{ $set->language2->name }}</th>
		</tr>
		</thead>
		<tbody>
		@foreach($words as $word)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $word[0] }}</td>
				<td>{{ $word[1] }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
