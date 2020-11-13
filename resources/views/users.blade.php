@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Пользователи</div>
				<div class="card-body">
					@foreach ($users as $user)
						<div class="user">
							<div class="name">{{$user->name}}</div>
							<div class="email">{{$user->email}}</div>
							<a class="btn btn-primary" href="/profile/{{$user->id}}">Профиль</a>
							<hr>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
