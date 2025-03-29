@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-primary mb-0">Nouvelle sauce</h2>
                <a class="btn btn-outline-primary" href="{{ route('web.sauces.index') }}">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Attention !</strong>
                    </div>
                    <ul class="list-unstyled mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-chevron-right me-1"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>    
            @endif

            <form action="{{ route('web.sauces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="nameInput" placeholder="Nom de la sauce" required>
                            <label for="nameInput">Nom de la sauce</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="manufacturer" class="form-control" id="manufacturerInput" placeholder="Fabricant" required>
                            <label for="manufacturerInput">Fabricant</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="description" class="form-control" id="descriptionInput" style="height: 100px" placeholder="Description" required></textarea>
                            <label for="descriptionInput">Description</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="mainPepper" class="form-control" id="pepperInput" placeholder="Principal ingrédient" required>
                            <label for="pepperInput">Principal ingrédient épicé</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Niveau d'épice: <span id="heatValue" class="badge bg-danger">5/10</span></label>
                            <input type="range" name="heat" value="5" 
                                   class="form-range" min="1" max="10" id="heatRange">
                            <div class="d-flex justify-content-between small text-muted">
                                <span>Doux</span>
                                <span>Très épicé</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <label class="form-label"><i class="fas fa-image me-2"></i>Image de la sauce</label>
                                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
