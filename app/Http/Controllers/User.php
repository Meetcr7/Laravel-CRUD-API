<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Student;
use App\exam_result;

class User extends Controller
{
    public $objStudent;
    public $objExam;


    function __construct()
    {
        $this->objStudent = new Student;
        $this->objExam = new exam_result;
    }

    function select(Request $objReq)
    {
       
        return $this->objStudent->read($objReq->all());
    }
   
    
    // move all this functions to model.
    function delete(Request $objReq)
    {
        // $this->objStudent->rules;
        $this->validate(
            $objReq,
            [
            'Id' => 'required|integer'
            ]
        );

       if($objReq->Id)
        {
            return $this->objStudent->delete1($objReq->Id);
        }
        else
        {
           return ["Answer" => "Id not specified..!"];
        }
    }

    function update(Request $objReq)
    {
        $this->validate(
            $objReq,
            [
            'Id' => 'integer',
            'Name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'
            ]
        );
        //$student = new Student;
       // $this->objStudent->rules;
        if($objReq->Id)
        {
            
            return $this->ob3jStudent->update1($objReq->Id,$objReq->Name);
        }
        else
        {
            return ["Result" => "Failed"];
        }
        
        //$student = Student::find($objReq->Id);
       
        
    }

    function insert(Request $objReq)
    {
        $this->validate(
            $objReq,
            [
                'Id' => 'required|integer|unique:students',
                'Name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'Gender' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'Department' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'
                // ['Id.required' => 'id required'],
            ]
        );
            return $this->objStudent->insert1($objReq->Id,$objReq->Name,$objReq->Gender,$objReq->Department);
    }

    function marks(Request $objReq)
    {
        //$this->objExam->rules;
        $this->validate(
            $objReq,
            [
                'student_id' => 'integer',
                'exam_date' => 'integer',
                'subject' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'max_marks' => 'integer',
                'obt_marks' => 'integer'
            ]
        );
        return $this->objExam->read($objReq->all());
    }

    function result(Request $objReq)
    {
        //$this->objExam->rules;
        $this->validate(
            $objReq,
            [
                'student_id' => 'integer',
                'subject' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'
            ]
        );
        return $this->objExam->res($objReq->student_id,$objReq->subject);
    }
}