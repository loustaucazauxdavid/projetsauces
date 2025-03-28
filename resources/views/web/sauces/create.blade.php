@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
            <h2>Ajouter une nouvelle sauce</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-outline-primary" href="{{ route('web.sauces.index') }}"> Retour</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops! </strong> Il y a eu des problèmes avec votre entrée.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('web.sauces.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="userId" value="{{ auth()->id() }}">

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Nom de la sauce:</strong>
                <input type="text" name="name" class="form-control" placeholder="Nom de la sauce">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Fabricant:</strong>
                <input type="text" name="manufacturer" class="form-control" placeholder="Fabricant de la sauce">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control" rows="3" placeholder="Description de la sauce"></textarea>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Principal ingrédient épicé:</strong>
                <input type="text" name="mainPepper" class="form-control" placeholder="Principal ingrédient épicé">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Niveau d'épice (1-10):</strong>
                <input type="number" name="heat" class="form-control" min="1" max="10" placeholder="Niveau d'épice">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image de la sauce:</strong>
                <input type="file" name="image" class="form-control" required>
                <input type="hidden" name="imageUrl" value="placeholder">
            </div>
        </div>
    </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </div>

</form>
@endsection
