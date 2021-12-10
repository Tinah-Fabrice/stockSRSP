@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    @if(Session::has('succes'))
                        setTimeOut(function(){
                            <span>{{Session::get('succes')}}</span>
                        },30000)
                     @endif
                    <form class="form-horizontal" method="POST" action="{{ isset($userEdit)?Route('userUpdate',['numImm'=>$userEdit->numImm]):Route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('numImm') ? ' has-error' : '' }}">
                            <label for="numImm" class="col-md-4 control-label">Immatriculle</label>

                            <div class="col-md-6">
                                <input id="numImm" type="text" class="form-control" name="numImm" value="{{ isset($userEdit->numImm)?$userEdit->numImm:'' }}" required autofocus>

                                @if ($errors->has('numImm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numImm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control" name="nom" value="{{ isset($userEdit->nom)?$userEdit->nom:'' }}" required >

                                @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom" class="col-md-4 control-label">Prenom</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ isset($userEdit->prenom)?$userEdit->prenom:'' }}">

                                @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ isset($userEdit->type)?$userEdit->type:'' }}" required >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @isset($userEdit)
                          
                        @else
                        <div>
                                 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                        </div>
                        @endisset
                        

                        <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                                @isset($userEdit)
                                <button type="button"class="btn btn-primary" onclick="window.location='{{url("/registre")}}'">
                                    Annuler
                                </button>
                                @else
                                <button type="reset" class="btn btn-primary">
                                    Annuler
                                </button>
                                @endisset
                                </button>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                @isset($userEdit)
                                    Modifier
                                @else
                                    Enregistrer
                                @endisset
                                </button>
                            </div>

                        </div>
                       
                    </form>
                </div>
                <div>
                    @foreach($userliste as $listeuser)
                    
                        <li>{{$listeuser->numImm}}</li>
                        <li>{{$listeuser->nom}}</li>
                        <li>{{$listeuser->prenom}}</li>
                        <li>{{$listeuser->type}}</li>
                        <a href="{{Route('userEdit',['numImm'=>$listeuser->numImm])}}">modifier</a>
                        <a href="{{Route('userDelete',['numImm'=>$listeuser->numImm])}}">supprimmer</a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
