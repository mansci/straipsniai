@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $user->name }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method("PATCH")

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Rolė</label>

                        <div class="col-md-6">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required autofocus>
                                @foreach (['user', 'admin'] as $role)
                                    <option value="{{ $role }}"{{ old('role', $user->role) == $role ? ' selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Atnaujinti
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
