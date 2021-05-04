@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">{{ $article->title }}</div>
            <div class="card-body">
                <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Pavadinimas</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $article->title) }} "required autofocus>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-md-4 col-form-label text-md-right">Autorius</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $article->author) }}"required autofocus>
                    </div>
                    <div class="form-group row">
                        <label for="language" class="col-md-4 col-form-label text-md-right">Kalba</label>
                        <input type="text" name="language" id="language" value="{{ old('language', $article->language) }}"required autofocus>
                    </div>
                    <div class="form-group row">
                        <label for="pages" class="col-md-4 col-form-label text-md-right">Puslapių skaičius</label>
                        <input type="number" name="pages" id="pages" value="{{ old('page', $article->pages) }}"required autofocus>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
