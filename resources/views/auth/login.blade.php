@extends('template')
@section('contenu')
<div class="container-fluid" style="margin: 5px;">

<div class="row" style="margin-top: 5px;margin-bottom: 5px;">
Si vous souhaitez <!--reprendre--> suivre votre demande, veuillez vous connecter.<br>
</div>
<div class="row">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Mot de passe" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
  
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>

        </div>
    </div>


@endsection