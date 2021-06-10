@extends('layouts.app')

@section('content')
<div class="container">
@if( Session::has('message') )
{{ Session::get('message') }}
@endif
<table class="table table-dark">
    <thead class="thead-light">
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
        <tr>
            <td> <img src="{{ asset('storage') . '/' . $employee->photo }}" width=100 />
            </td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->lastName }}</td>
            <td>
                <a href="{{ url('/employee/' . $employee->id . '/edit') }}">Editar</a>
                |
                <form action="{{ url('/employee/' . $employee->id) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button onclick="confirm('¿Estas seguro/a de eliminar?')">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $employees->links() !!}
<a href="{{ url('employee/create') }}">Crear Nuevo Usuario</a>
</div>
@endsection