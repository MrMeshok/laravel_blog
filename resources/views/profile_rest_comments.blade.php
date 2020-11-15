@foreach ($comments as $element)
        @php
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
                @if ($auth->id == $element->author_id or $auth->id == $element->profile_id)
                    <a class="btn btn-danger" href="{{$element->profile_id}}/del_comment/{{$element->id}}">Удалить</a>
                @endif
                <button id="{{$element->id}}" class="reply_button btn btn-primary" value="">Ответить</button>
                <form class="reply_form hidden" id="reply_form_{{$element->id}}" action="/profile/add_comment" method="POST">
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