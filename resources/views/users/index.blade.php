@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Naudotojai <span style="float:right">Sukūrimo data</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.show', $user) }}">{{ $user->name }} </a>
                        <span style="float:right">{{ $user->created_at }}</span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
