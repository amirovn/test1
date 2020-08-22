@extends('layouts.index')

@section('content')
    <main role="main" class="flex-shrink-0">
        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    @foreach ($articles as $article)

                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ $article->image }}" >
                                <div class="card-body">
                                    <p class="card-text"><a href="{{ route('article', $article->id) }}">{{ $article->name }}</a></p>
                                    <p class="card-text">{{ $article->description }}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                {{ $articles->links() }}

            </div>
        </div>
    </main>
@endsection
