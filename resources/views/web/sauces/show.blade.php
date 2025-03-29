@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-primary mb-0">{{ $sauce->name }}</h2>
                <a class="btn btn-outline-primary" href="{{ URL::previous() }}">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <img src="{{ asset('storage/' . $sauce->imageUrl) }}" alt="{{ $sauce->name }}" class="card-img-top">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="text-muted">Fabricant</h5>
                        <p class="h6">{{ $sauce->manufacturer }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Description</h5>
                        <p class="h6">{{ $sauce->description }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Ingrédient principal</h5>
                        <p class="h6">{{ $sauce->mainPepper }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Niveau de piquant</h5>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                style="width: {{ ($sauce->heat/10)*100 }}%"
                                aria-valuenow="{{ $sauce->heat }}" aria-valuemin="0" aria-valuemax="10">
                                {{ $sauce->heat }}/10
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mt-4">
                        <div class="text-center">
                            <i class="fas fa-thumbs-up text-success h4"></i>
                            <p class="mb-0">{{ $sauce->likes }} likes</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-thumbs-down text-danger h4"></i>
                            <p class="mb-0">{{ $sauce->dislikes }} dislikes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
