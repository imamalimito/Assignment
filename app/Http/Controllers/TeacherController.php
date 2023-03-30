<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Division;
use App\Models\District;

class TeacherController extends Controller
{
    public function createTeacher(){
        $divisions = Division::all();
        return view('create_teacher', compact('divisions'));
    }
    public function storeTeacher(Request $req){
        $obj = new Teacher();
        $obj->division_id = $req->teacher_division;
        $obj->district_id = $req->teacher_district;
        $obj->name = $req->teacher_name;
        if($obj->save()){
            return response()->json([
                'msg' => 'Successfully Inserted',
                'teacher' => $obj
            ]);
        }
    }
}
