@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-light text-right">
                @can('create', App\Team::class)
                    <form action="{{ route('teams.store') }}" method="POST">
                        @csrf
                        <input type="string" name="name" value="{{ old('name') }}" placeholder="Komandos pavadinimas" required autofocus>
                        <button class="btn btn-primary" type="submit">Sukurti komandą</button>
                    </form>
                @endcan
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Komanda</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($teams as $team)
                <tr>
                    <td>
                        <a  href="{{ route('teams.show', $team) }}">{{ $team->name }} </a>
                    </td>
                    <td>
                        <a class="btn btn-primary" style="float:right" role="button" href="{{ route('teams.users.index', ['team' => $team]) }}">Nariai</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>
@endsection
