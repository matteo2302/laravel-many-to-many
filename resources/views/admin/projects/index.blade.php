@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-item-center my-4">
            <h1>I miei progetti</h1>

            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Torna indietro</a>
                <a class="btn btn-warning" href="{{ route('admin.projects.create') }}">Aggiungi progetto</a>
            </div>
        </header>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data</th>
                    <th scope="col">ultimo aggiornamento</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>
                            @if ($project->type)
                                <span class="badge"
                                    style="background-color:{{ $project->type->color }}">{{ $project->type->label }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $project->date }}</td>
                        <td>{{ $project->last_update }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                class="delete-form delete-btn">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            <h1>Non ci sono più progetti</h1>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    @vite('resources/js/delete-confirmation-alert.js')
@endsection
