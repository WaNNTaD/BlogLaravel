@extends('base')

@section('title', 'Se connecter')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Se connecter</h1>
            <form action="{{ route('auth.login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>

@endsection


                
