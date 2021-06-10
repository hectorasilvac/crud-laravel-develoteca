@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/employee/' . $employee->id) }}" method="POST" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH')  }}
@include('employee.form', ['mode' => 'Editar'])
</form>
</div>
@endsection