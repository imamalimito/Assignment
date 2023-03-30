<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;
class EmployeeController extends Controller
{
    public function create(){
        return view('employee.create');
    }
    public function store(Request $req){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;
        $department = $req->department;
        if($req->status){
            $status = 1;
        }
        else {
            $status = 0;
        }    
        $gender = $req->gender;
        $address = $req->address;

        $originalImage = $req->file('profile_pic');
        $thumbnailImage = Image::make($originalImage);

        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';

        $full_file_name = $originalImage->getClientOriginalName();
        $extension = $originalImage->getClientOriginalExtension();
        $filename = time().'.'.$extension;

        $thumbnailImage->save($originalPath.$filename);
        
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.$filename); 

        // insert into employees table
        
        // Eloquent ORM
        // $obj = new Employee();  // create an object of Employee class
        // $obj->name = $name;
        // $obj->email = $email;
        // $obj->birth_date = $birth_date;
        // $obj->department = $department;
        // $obj->status = $status;
        // $obj->gender = $gender;
        // $obj->address = $address;
        // if($obj->save()){
        //     echo 'Inserted';
        // }
        // end of eloqunet ORM

        // Start of Query Builder 
        DB::table('employees')->insert([
            'name' => $name,
            'email' => $email,
            'birth_date' => $birth_date,
            'department'=> $department, 
            'status'=> $status, 
            'gender'=> $gender, 
            'address'=> $address,
            'profile_pic' => $filename
        ]);
        // End of Query Builder
    }
    public function all(){
        // SELECT * from employees
        $employees = Employee::all();
        return view('employee.all', compact('employees'));
    }
    public function edit($id){
        $employee = Employee::find($id); // SELECT * from employees WHERE id=1
        return view('employee.edit', compact('employee'));
    }
    public function update(Request $req, $id){
        $name = $req->name;
        $email = $req->email;
        $birth_date = $req->birth_date;
        $department = $req->department;
        if($req->status){
            $status = 1;
        }
        else {
            $status = 0;
        }    
        $gender = $req->gender;
        $address = $req->address;

        $obj = Employee::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->birth_date = $birth_date;
        $obj->department = $department;
        $obj->status = $status;
        $obj->gender = $gender;
        $obj->address = $address;
        if($obj->save()){
            return redirect('employees');
        }
    }

    public function delete($id){
        Employee::find($id)->delete();
        return redirect('/employees');
    }
    public function showEmployees()
    {
        $employee = Employee::all();
        return view('index', compact('employee'));
    }
    public function createPDF() {
        // retreive all records from db
        $data = Employee::all();
  
        // share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('pdf_view', $data);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

}
