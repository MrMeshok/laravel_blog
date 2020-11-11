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
            <div class="card">
                    {{-- {{var_dump($comments->author())}} --}}
                <div class="card-header">Комментарии</div>
                <div class="card-body">
                    @foreach ($comments as $element)
                        <div>
                            @php
                                $replay = $element->replays;
                            @endphp
                            @if (count($replay) > 0)
                                Ответ на <br>
                                <div class="reply" style="background-color: grey;">
                                    {{-- @if (condition) --}}
                                        {{mb_strimwidth($replay[0]->message, 0, 50, "...")}}
                                    {{-- @else --}}
                                        {{-- false expr --}}
                                    {{-- @endif --}}
                                </div>
                            @endif
                            <h3>{{$element->subject}}</h3>
                            <h5>{{$author = $element->author->name}}</h5>
                                @php
                                    // $author = DB::table('users')->where('id', $element->author_id)->first();
                                    // echo $author->name;
                                    // $author = $user->find($element->author_id)->Author;
                                    // $author = $element->find($element->id)->Author;
                                    // echo $author->name;
                                    // var_dump($author);
                                    // echo $author->name;
                                @endphp
                            <br>
                            <p>{{$element->message}}</p>
                            <div class="control">
                                <button name="not_done" value="" form="control">Удалить</button>
                                <button name="not_done" value="" form="control">Ответить</button>
                            </div>
                            <hr>
                        </div>
                    @endforeach
            </div>
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
            </div>
        </div>
    </div>
</div>
@endsection
