<x-app-layout>
    <x-slot name="title" >
        Se connecter
    </x-slot>

    <x-slot name="index" >
        active
    </x-slot>

    <div class="row">
        <form class="col-lg-4 offset-lg-4" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>CONNEXION</h2>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="">Pseudo</label>
                    <input id="pseudo" placeholder="esaie12" type="text" class="form-control @error('pseudo') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="pseudo" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-12">
                    <label for="password" class="">Mot de passe</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        Se connecter
                    </button>

                    @if (Route::has('password.request'))
                        <!--a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a-->
                    @endif
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <a href="{{route('register')}}">S'inscrire directement</a> /
                <a href="{{route('register_invitation',['code'])}}">J'ai reçu une invitation</a>
            </div>
        </form>

    </div>

</x-app-layout>
