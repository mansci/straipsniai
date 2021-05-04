@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-light text-right">
                <form method="GET" action="{{ route('teams.show', ['team' => $team]) }}" style="display: inline-block">
                    <label for="title">Pasirinkite kategoriją</label>
                    <select name="category_id" id="category_id">
                        <option> </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category_id == $category->id ? "selected" : "" }} >{{ $category->name }} </option>
                        @endforeach
                    </select>
                    <input type="text" id="query" name="query" value="{{ old('query', $query) }}" placeholder="Paieška">
                    <button type="submit" class="btn btn-primary">Ieškoti</button>
                </form>
                <a class="btn btn-primary" role="button" href="{{ route('teams.articles.create', ['team' => $team]) }}">Įkelti straipsnį</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Straipsnio pavadinimas</th>
                <th scope="col">Kategorija</th>
                <th scope="col">Autorius</th>
                <th scope="col">Kalba</th>
                <th scope="col">Puslapių skaičius</th>
                <th scope="col">Įkėlimo data</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>
                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }} </a>
                    </td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->language }}</td>
                    <td>{{ $article->pages }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>
                        @can('delete', $article)
                            <form method="POST" action="{{ route('articles.destroy', $article) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">
                                    Ištrinti
                                </button>
                            </form>
                        @endcan
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <a href="{{ route('articles.edit', $article) }}" style="color: white">Redaguoti</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>
@endsection
