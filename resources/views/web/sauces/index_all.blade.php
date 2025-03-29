@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-primary mb-0">Toutes les sauces</h2>
                <a class="btn btn-outline-success" href="{{ route('web.sauces.create') }}">
                    <i class="fas fa-plus me-2"></i>Nouvelle sauce
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ $message }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach ($sauces as $sauce)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $sauce->imageUrl) }}" class="card-img-top" alt="{{ $sauce->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title text-primary mb-0">{{ $sauce->name }}</h5>
                        <span class="badge bg-secondary">
                            <i class="fas fa-user me-1"></i>{{ $sauce->user->name }}
                        </span>
                    </div>
                    <h6 class="text-muted">{{ $sauce->manufacturer }}</h6>
                    <p class="card-text small">{{ Str::limit($sauce->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <small class="text-muted">Niveau d'épice:</small>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                style="width: {{ ($sauce->heat/10)*100 }}%">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $sauce->heat }}/10</small>
                            <small class="text-muted">{{ $sauce->mainPepper }}</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="me-3"><i class="fas fa-thumbs-up text-success"></i> {{ $sauce->likes }}</span>
                            <span><i class="fas fa-thumbs-down text-danger"></i> {{ $sauce->dislikes }}</span>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('web.sauces.show', $sauce->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(auth()->id() === $sauce->user_id)
                            <a href="{{ route('web.sauces.edit', $sauce->id) }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sauce->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->id() === $sauce->user_id)
        <!-- Modal de confirmation de suppression -->
        <div class="modal fade" id="deleteModal{{ $sauce->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer la sauce <strong>{{ $sauce->name }}</strong> ?</p>
                        <p class="text-muted small">Cette action est irréversible.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('web.sauces.destroy', $sauce->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $sauces->links('pagination::bootstrap-4') !!}
    </div>
</div>
@endsection
