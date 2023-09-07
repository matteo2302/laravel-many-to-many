@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex">
            <img src="{{ $project->image }}" alt="{{ $project->title }}">
            <div>
                <h1 class="my-5">{{ $project->title }}</h1>
                <h1 class="my-5">tipo: {{ $project->type ? $project->type->label : 'Nessuna' }}</h1>
                <h4 class="mb-5">Fatto il: {{ $project->date }}</h4>
                <h4 class="mb-5">Ultima revisione: {{ $project->last_update }}</h4>
                <p class="mb-5">Descrizione e Obbiettivi :
                    {{ $project->description }}
            </div>

            </p>
        </div>

        <footer class="d-flex justify-content-between">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Torna alla lista</a>
            <div class="d-flex justify-content-end"><a href="{{ route('admin.projects.edit', $project) }}"
                    class="btn btn-sm btn-warning me-2">
                    <i class="fas fa-pencil"></i>
                </a>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>

        </footer>
    </div>
@endsection
