@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ route('articles.comments.store', ['article' => $article]) }}" method="POST">
            @csrf
            <textarea name="text" id="text" placeholder="Įrašykite komentarą" required autofocus cols="80" rows="3"> </textarea>
            <button type="submit" style="float:right" class="btn btn-primary">Pridėti komentarą </button>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Komentarai</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($article->comments as $comment)
                <tr>
                    <td>{{ $comment->text }}</td>
                    <td>
                        <form method="POST" action="{{ route('articles.comments.destroy', ['article' => $article, $comment]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float:right" class="btn btn-primary">
                                Ištrinti
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Citatos</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($article->citations as $citation)
                <tr>
                    <td>
                        {{ $citation->text }}
                        <br>
                        Komentarai:
                        <ul>
                        @foreach ($citation->comments as $comment)
                            <li>
                                {{ $comment->text }}
                                <form method="POST" action="{{ route('citations.comments.destroy', ['comment' => $comment, 'citation' => $citation]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">
                                        Ištrinti
                                    </button>
                                </form>
                            </li>
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        <form action="{{ route('citations.comments.store', ['article' => $article, $citation]) }}" method="POST">
                            @csrf
                            <textarea name="text" id="text" placeholder="Įrašykite komentarą" required autofocus cols="30" rows="2"> </textarea>
                            <button type="submit" style="float:right" class="btn btn-primary">Pridėti komentarą </button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('citations.destroy', ['article' => $article, 'citation' => $citation]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float:right" class="btn btn-primary">
                                Ištrinti
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <form action="{{ route('articles.citations.store', ['article' => $article]) }}" method="POST" id="pdfform" style="position: fixed; left: 64px; top: 256px;">
            @csrf
            <input type="hidden" name="text" id="pdfinput">
            <button type="submit" class="btn btn-primary" style="display: none;" id="pdfbutton">Cituoti</button>
        </form>
        <pre style="background-color: white; padding: 16px;" id="pdftext">
            {!! preg_replace($article->citations->pluck('text')->unique()->map(function ($text) { return preg_quote($text, '/'); })->map(function ($text) { return "/($text)/"; })->all(), '<span style="background-color: yellow">${1}</span>', strip_tags($article->text)) !!}
        </pre>
@endsection
