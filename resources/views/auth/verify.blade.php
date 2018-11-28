@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Veuillez vérifier votre adresse mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Avant de continuer, veuillez vérifier votre adresse mail pour un lien de vérification..') }}
                    {{ __('Si vous n\'avez pas recu le mail') }}, <a href="{{ route('verification.resend') }}">{{ __('Clickez ici pour en recevoir un nouveau') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
