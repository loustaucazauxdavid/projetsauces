@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-primary mb-0">Liste de mes sauces</h2>
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

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Fabricant</th>
                        <th>Description</th>
                        <th>Épice principale</th>
                        <th>Niveau d'épice</th>
                        <th>Likes/Dislikes</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sauces as $sauce)
                    <tr>
                        <td>{{ $sauce->id }}</td>
                        <td>{{ $sauce->name }}</td>
                        <td>{{ $sauce->manufacturer }}</td>
                        <td>{{ Str::limit($sauce->description, 50) }}</td>
                        <td>{{ $sauce->mainPepper }}</td>
                        <td>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-danger" role="progressbar" 
                                     style="width: {{ ($sauce->heat/10)*100 }}%">
                                    {{ $sauce->heat }}/10
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">
                                    <i class="fas fa-thumbs-up text-success"></i> {{ $sauce->likes }}
                                </span>
                                <span>
                                    <i class="fas fa-thumbs-down text-danger"></i> {{ $sauce->dislikes }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('web.sauces.show',$sauce->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-outline-success btn-sm" href="{{ route('web.sauces.edit',$sauce->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('web.sauces.destroy',$sauce->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sauce->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

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
                                    <button type="button" class="btn btn-danger" onclick="document.querySelector('form[action=\'{{ route('web.sauces.destroy', $sauce->id) }}\']').submit()">
                                        <i class="fas fa-trash me-2"></i>Supprimer
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $sauces->links('pagination::bootstrap-4') !!}
    </div>
</div>
@endsection
