@extends('layouts.app')

@section('content')
    <div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Kategorija</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    @can('delete', App\Category::class)
                        <form method="POST" action="{{ route('categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float:right" class="btn btn-primary">
                                Ištrinti
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
        @can('create', App\Category::class)
            <div class="card">
                <div class="card-header">Nauja kategorija</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Pavadinimas</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Kurti
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    @endcan
    </div>
@endsection
