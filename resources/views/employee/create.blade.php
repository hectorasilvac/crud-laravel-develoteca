@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/employee') }}" method="POST" enctype="multipart/form-data">
@csrf
@include('employee.form', ['mode' => 'Crear'])
</form>
</div>
@endsection