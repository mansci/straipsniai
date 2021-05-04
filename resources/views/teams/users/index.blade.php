@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Narys</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($team->users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('teams.users.destroy', ['team' => $team, 'user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float:right" class="btn btn-primary">
                                Išmesti
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="card">
            <div class="card-header">Pridėti narį</div>
            <div class="card-body">
                <form method="POST" action="{{ route('teams.users.store', ['team' => $team]) }}">
                    @csrf

                    <div class="form-group row">
                        <label for="user_id" class="col-md-4 col-form-label text-md-right">Narys</label>

                        <div class="col-md-6">
                            <select name="user_id" id="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Pridėti
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
