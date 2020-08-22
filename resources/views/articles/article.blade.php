@extends('layouts.index')

@section('content')
    <main role="main" class="flex-shrink-0">
        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">

                        <div class="col-12">
                            <p>{{ $article->name }}</p>

                            <img src="{{ $article->image }}" >

                            <p>{{ $article->description }}</p>
                            <p>{{ $article->created_at }}</p>
                            <p>{{ $article->created_at }}</p>

                            <p>Теги:
                                @isset($article->tags)
                                    @foreach($article->tags as $tag)
                                        {{ $tag->name }}
                                    @endforeach
                                @endisset
                            </p>

                            <p>Просмотры:
                            @if(empty($article->views->count))
                                <span id="views" data-id="{{ $article->id }}">0</span>
                            @else
                                <span id="views" data-id="{{ $article->id }}">{{ $article->views->count }}</span>
                            @endif

                            </p>

                            <p>
                                <button onclick="like({{ $article->id }})">Лайки:
                                    @if(empty($article->likes->count))
                                        <span id="likes" data-id="{{ $article->id }}">0</span>
                                    @else
                                        <span id="likes" data-id="{{ $article->id }}">{{ $article->likes->count }}</span>
                                    @endif
                                </button>
                            </p>

                            <p>Комментарии:
                                @if(empty($article->views->count))
                                    0
                                @else
                                    @foreach($article->comments as $comment)
                                        {{ $comment->name }}
                                    @endforeach
                                @endif

                            </p>

                        </div>

                    <div class="comments">
                        <form action="#">
                            <input type="text" name="description" class="comments_input">
                            <button onclick="sendComment({{ $article->id }})">Написать</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        let idArticle = $("#views").attr("data-id")

        setTimeout(function () {
            $.ajax({
                url: "/article/toggle-view/" + idArticle,
                type: 'get',
                data: {},
            });
        }, 5000);

        function like(id) {
            $.ajax({
                url: "/article/toggle-like/" + id,
                type: 'get',
                data: {},
                success: function (response) {
                    let json = JSON.parse(response);

                    $("#likes").text(json.count)
                }
            });
        }

        function sendComment(id) {
            let comments = $(".comments_input").val()

            $.ajax({
                url: "/article/add-comment/",
                type: 'get',
                data: {
                    'id': id,
                    'comments': comments
                },
                success: function (response) {
                    let json = JSON.parse(response);

                    $("#likes").text(json.count)
                }
            });

            $('.comments').html("Ваше сообщение успешно отправлено");


        }
    </script>
@endsection
