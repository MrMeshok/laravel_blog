@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Библиотека
                    @if ($user->id == $profile->id)
                        <a id="add_book" class="btn btn-primary">Создать книгу</a>
                        <a class="btn btn-primary" href="{{$url}}/change_public">
                            @if ($user->public_library == 0)
                                Сделать библиотеку публичной
                            @else
                                Сделать библиотеку личной
                            @endif
                        </a>
                        <form class="hidden" action="{{$url}}/add_book" method="POST">
                            @csrf
                            <input type="hidden" name="library_id" value="{{$profile->id}}"><br>
                            <input required placeholder="Заголовок" type="text" name="title"><br>
                            <textarea required placeholder="Текст книги" name="text" cols="60" rows="8"></textarea><br>
                            <input type="submit" id="submit_enter" value="Отправить"><br>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    @foreach ($books as $book)
                        <div class="user">
                            <div class="name">{{$book->title}}</div>
                            <a class="btn btn-primary" href="{{$url}}/{{$book->id}}">Прочитать</a>
                            @if ($user->id == $profile->id)
                                <a id="edit_book" class="btn btn-primary">Редактировать</a>
                                <a class="btn btn-danger" href="{{$url}}/{{$book->id}}/del_book">Удалить</a>
                                <form class="hidden" action="{{$url}}/{{$book->id}}/edit_book" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$book->id}}"><br>
                                    <input required type="text" name="title" value="{{$book->title}}"><br>
                                    <textarea required name="text" cols="60" rows="8">{{$book->text}}</textarea><br>
                                    <input type="submit" id="submit_enter" value="Редактировать"><br>
                                </form>
                            @endif
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
