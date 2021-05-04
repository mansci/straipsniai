@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">Naujas straipsnis</div>
            <div class="card-body">
                <form action="{{ route('teams.articles.store', ['team' => $team]) }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="category-id" class="col-md-4 col-form-label text-md-right">Pasirinkite kategoriją</label>

                        <div class="col-md-6">
                            <select name="category_id" id="category-id" required>
                                @foreach($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">Pasirinkite įkeliamą failą</label>
                            <div class="col-md-6">
                                <input type="file" id="file" name="file" accept=".application/pdf,.pdf" required>
                            </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Įkelti
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
