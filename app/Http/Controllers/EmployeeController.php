<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    public function index()
    {
        $data['employees'] = Employee::paginate(1);
        return view('employee.index', $data);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $inputs = [
            'name' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'photo' => 'required|max:10000|mimes:jpeg, png, jpg'
        ];

        $messages = [
            'required' => 'El :attribute no puede estar en blanco.',
            'photo.required' => 'La foto es requerida',
        ];

        $this->validate($request, $inputs, $messages);

        $employeeInfo = request()->except('_token');
        if($request->hasFile('photo')) {
            $employeeInfo['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        Employee::insert($employeeInfo);
        return redirect('employee')->with('message', 'Empleado agregado exitosamente.');
    }

    public function show(Employee $employee)
    {
        //
    }
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $inputs = [
            'name' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
        ];

        $messages = [
            'required' => 'El :attribute no puede estar en blanco.',
        ];

        if($request->hasFile('photo')) {
            $inputs = [
                'photo' => 'required|max:10000|mimes:jpeg, png, jpg',
            ];

            $messages = [
                'photo.required' => 'La foto es requerida',
            ];
        }

        $this->validate($request, $inputs, $messages);

    
        $employeeInfo = request()->except('_token', '_method');
        $employee = Employee::findOrFail($id);

        if($request->hasFile('photo')) {
            Storage::delete('public/' . $employee->photo);

            $employeeInfo['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        Employee::where('id','=',$id)->update($employeeInfo);
        // return view('employee.edit', compact('employee'));

        return redirect('employee')->with('message', 'Empleado modificado');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if( Storage::delete('public/' . $employee->photo) ) {
            Employee::destroy($id);
        }

        return redirect('employee');
    }

}
