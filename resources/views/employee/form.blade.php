@if(count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
    <li>
    {{ $error }}
    </li>
    @endforeach
    </ul>
    </div>
@endif

<div>
        <label for="name">Nombre: </label>
        <input type="text" id="name" name="name" value="{{ isset($employee) ? $employee->name : old('name') }}"/>
    </div>
    <div>
        <label for="lastName">Apellido: </label>
        <input type="text" id="lastName" name="lastName" value="{{ isset($employee) ? $employee->lastName  : old('lastName')}}" />
    </div>
    @if( isset($employee->photo))
    <img src="{{ asset('storage') . '/' . $employee->photo }}" width=100 />
    @endif
    <div>
        <label for="photo">Foto: </label>
        <input type="file" id="photo" name="photo" />
    </div>
    <button>{{ $mode }}</button>
    <a href="{{ url('employee') }}">Regresar</a>