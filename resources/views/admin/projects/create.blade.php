@extends('layouts.app')
@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-item-center my-4">
            <h1>Crea progetto</h1>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Torna indietro</a>
        </header>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Inserisi il nome">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Data</label>
                                <input type="number" class="form-control" id="date" name="date">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="last_update" class="form-label">Ultima modifica</label>
                                <input type="number" class="form-control" id="last_update" name="last_update">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">immagine</label>
                        <input class="form-control" type="file" id="image" name="image"
                            placeholder="aggiungi il file dell'immagine">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <textarea class="form-control" id="description" name="description" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="type" class="form-label">tipo</label>
                                <select class="form-select" id="type" name="type_id">
                                    <option value="">Nessuna</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <div class="d-flex justify-content-end my-4">
                <button class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i>Salva</button>
            </div>
        </form>
    </div>
@endsection
