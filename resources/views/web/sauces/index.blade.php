@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-end">
        <a class="btn btn-outline-success" href="{{ route('web.sauces.create') }}"> Créer une nouvelle sauce</a>
        </div>
    </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Fabricant</th>
        <th>Description</th>
        <th>Épice principale</th>
        <th>Niveau d'épice</th>
        <th>Likes/Dislikes</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($sauces as $sauce)
    <tr>
        <td>{{ $sauce->id }}</td>
        <td>{{ $sauce->name }}</td>
        <td>{{ $sauce->manufacturer }}</td>
        <td>{{ Str::limit($sauce->description, 50) }}</td>
        <td>{{ $sauce->mainPepper }}</td>
        <td>{{ $sauce->heat }}/10</td>
        <td>{{ $sauce->likes }}/{{ $sauce->dislikes }}</td>
        <td>
        <form action="{{ route('web.sauces.destroy',$sauce->id) }}" method="POST">

            <a class="btn btn-outline-primary" href="{{ route('web.sauces.show',$sauce->id) }}">Montrer</a>

            <a class="btn btn-outline-success" href="{{ route('web.sauces.edit',$sauce->id) }}">Éditer</a>

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
        </form>
        </td>
    </tr>
    @endforeach
    </table>
    <div class="d-flex justify-content-center pagination-lg">
    {!! $sauces->links('pagination::bootstrap-4') !!}
    </div>
@endsection
