@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Профиль</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{$user->name}}<br>
                    {{$user->email}}
                </div>
            </div>
            @php
                
            @endphp
            <div class="card">
                    {{-- {{var_dump($comments->author())}} --}}
                <div class="card-header">Комментарии</div>
                <div class="card-body">
                                @php
                                    $count = 0;
                                @endphp
                    @foreach ($comments as $element)
                            @php
                                $count++;
                                if ($count > 5) {
                                    break;
                                }
                                $replies = $element->replies;
                            @endphp
                        <div>
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
                            <h5>{{$element->author->name}}</h5><br>
                            <p>{{$element->message}}</p>
                            @if ($auth)
                                <div class="control">
                                    @if ($auth->id == $element->author_id)
                                        <a class="btn btn-danger" href="{{$url}}/del_comment/{{$element->id}}">Удалить</a>
                                    @endif
                                    <button id="{{$element->id}}" class="reply_button btn btn-primary" value="">Ответить</button>
                                    <form class="reply_form hidden" id="reply_form_{{$element->id}}" action="add_comment" method="POST">
                                        @csrf
                                        <input type="hidden" name="profile_id" value="{{$user->id}}"><br>
                                        <input type="hidden" name="reply_id" value="{{$element->id}}">
                                        <input required placeholder="Заголовок" type="text" name="subject"><br>
                                        <textarea required placeholder="Текст сообщения" name="message" cols="40" rows="5"></textarea><br>
                                        <input type="submit" value="Ответить"><br>
                                    </form>
                                </div>
                            @endif
                            <hr>
                        </div>
                    @endforeach
                @if ($count > 5)
                    <button id="all_comments" data="1" class="btn btn-dark" >Дальше</button>
                @endif
            </div>
            @if ($auth)
                <div class="card">
                    <div class="card-header">Оставить комментарий</div>
                    <form action="add_comment" method="POST">
                        @csrf
                        <input type="hidden" name="profile_id" value="{{$user->id}}"><br>
                        <input required placeholder="Заголовок" type="text" name="subject"><br>
                        <textarea required placeholder="Текст сообщения" name="message" cols="40" rows="5"></textarea><br>
                        <input type="submit" id="submit_enter" value="Отправить"><br>
                    </form>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
