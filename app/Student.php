<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Http\Request;

class Student extends Model
{
    protected $fillable = ['Id','Name','Gender','Department'];
    public $primaryKey = 'Id';
    public $timestamps = false;

    //public $objStudent;
    // public $rules= [
    //     'Id' => 'integer|unique:students',
    //     'Name' => 'string',
    //     'Gender' => 'string',
    //     'Department' => 'string'
    // ];

    public function read($arrInputs){

        $objStudent = self::select('id','name','gender','department');
    
        if(isset($arrInputs['id'])){
            $objStudent = $objStudent->where('id',$arrInputs['id']);
        }
        if(isset($arrInputs['name'])){
            $objStudent = $objStudent->where('name',$arrInputs['name']);
        }
        if(isset($arrInputs['gender'])){
            $objStudent = $objStudent->where('gender',$arrInputs['gender']);
        }
        if(isset($arrInputs['department'])){
            $objStudent = $objStudent->where('department',$arrInputs['department']);
        }
    
        return $objStudent->get();
    }

    public function update1($Id,$Name)
    {
         
            // take all value through api
             Student::where('Id',$Id)
             ->update(['Name' => $Name]);
             return ["Result" => "Success"];
    }


    public function insert1($Id,$Name,$Gender,$Department)
    {
        // return $validated;
        $student = new Student;
         //$student->Id = $objReq->Id; // use autoincrement concept of db for id field.
        
        if($Id)
        {
            $student->Id = $Id;
            $student->Name = $Name;
            $student->Gender = $Gender;
            $student->Department = $Department;
            $student->save();
            return ["Answer" => "Inserted..!"];
        }
    }

    public function delete1($Id)
    {

            Student::where('Id',$Id)
            ->delete();
            return ["Answer" => "Deleted..!"];
    }
}
