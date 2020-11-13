@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
					{{-- {{var_dump($comments->author())}} --}}
				<div class="card-header">Комментарии</div>
				<div class="card-body card-body-comments">
					@foreach ($comments as $element)
						@php
						$replies = $element->replies;
						@endphp
						<div class="comments">
							@if (!$replies->isEmpty() or $element->reply_id != null)
								Ответ на <br>
								<div class="reply" style="background-color: grey;">
									 @if (!$replies->isEmpty()) 
										{{mb_strimwidth($replies[0]->message, 0, 50, "...")}}
									 @else 
										Комментарий удалён
									 @endif 
								</div>
							@endif
							<h3>{{$element->subject}}</h3>
							<p>{{$element->message}}</p>
							<div class="control">
								<a class="btn btn-danger" href="{{$element->profile_id}}/del_comment/{{$element->id}}">Удалить</a>
							</div>
							<hr>
						</div>
					@endforeach

			</div>
			</div>
		</div>
	</div>
</div>
@endsection
