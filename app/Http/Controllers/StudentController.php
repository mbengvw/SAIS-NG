<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button type="button" name="edit" id="'.$row->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                        $button .= '   <button type="button" name="edit" id="'.$row->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                        return $button;
                    })
                    ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                    ->rawColumns(['checkbox','action'])
                    ->make(true);
        }
        return view('students');
    }


    public function destroy($id)
    {
        Student::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

}
