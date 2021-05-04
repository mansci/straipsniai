@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pranešimas</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Sveiki atvyke {{ Auth::user()->name }}, jūsų rolė yra {{ Auth::user()->role }}, sėkmingai prisijungėte!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
