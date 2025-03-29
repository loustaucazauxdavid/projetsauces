@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Attention !</strong>
            </div>
            <ul class="list-unstyled mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-chevron-right me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-primary mb-4">Bienvenue sur Hot Takes !</h2>
                    
                    <p class="lead mb-4">
                        Découvrez et partagez les meilleures sauces piquantes ! Notre plateforme vous permet de :
                    </p>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-eye text-primary h4 mb-0 me-3"></i>
                                <div>
                                    <h5>Découvrir les sauces</h5>
                                    <p class="text-muted">Explorez toutes les sauces partagées par la communauté</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-pepper-hot text-danger h4 mb-0 me-3"></i>
                                <div>
                                    <h5>Gérer vos sauces</h5>
                                    <p class="text-muted">Connectez-vous pour créer et gérer vos propres sauces</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        <div class="alert alert-success">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <span>Vous êtes connecté ! Vous pouvez maintenant :</span>
                            </div>
                            <ul class="list-unstyled mb-0 mt-2">
                                <li><i class="fas fa-chevron-right me-1"></i>Voir toutes les sauces</li>
                                <li><i class="fas fa-chevron-right me-1"></i>Gérer vos propres sauces</li>
                                <li><i class="fas fa-chevron-right me-1"></i>Évaluer les sauces des autres membres</li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('web.sauces.index.all') }}" class="btn btn-primary btn-lg me-2">
                                <i class="fas fa-list me-2"></i>Toutes les sauces
                            </a>
                            <a href="{{ route('web.sauces.index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-user-cog me-2"></i>Mes sauces
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <span>Connectez-vous pour créer et gérer vos propres sauces !</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('web.sauces.index.all') }}" class="btn btn-primary btn-lg mb-3">
                                <i class="fas fa-list me-2"></i>Voir toutes les sauces
                            </a>
                            <div class="mt-3">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg me-2">
                                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Inscription
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
