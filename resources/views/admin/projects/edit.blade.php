@extends('layouts.app')
@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-item-center my-4">
            <h1>Modifica progetto</h1>
            <a class="btn btn-primary" href="{{ route('admin.projects.show', $project) }}">Torna indietro</a>
        </header>
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <label for="title" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $project->title) }}" placeholder="Inserisi il nome">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-5">
                                <label for="date" class="form-label">Data</label>
                                <input type="number" id="date" name="date"
                                    value="{{ old('date', $project->date) }}" rows="10">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-5">
                                <label for="last_update" class="form-label">Ultima modifica</label>
                                <input type="number" id="last_update" name="last_update"
                                    value="{{ old('last_update', $project->last_update) }}" rows="10">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <img src="{{ old('image', $project->image) }}" alt="">
                        <label for="image" class="form-label">immagine</label>
                        <input class="form-control" type="file" id="image" name="image"
                            placeholder="cambia il file dell'immagine">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-5">
                                <label for="descrizione" class="form-label">descrizione</label>
                                <textarea class="form-control" id="description" name="description" rows="6"
                                    value="{{ old('description', $project->description) }}"></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="type" class="form-label">tipo</label>
                                <select class="form-select" id="type" name="type_id">
                                    @foreach ($types as $type)
                                        <option @if (old('type_id') == $type->id) selected @endif
                                            value="{{ $type->id }}">{{ $type->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i>Salva</button>
            </div>
        </form>
    </div>
@endsection
