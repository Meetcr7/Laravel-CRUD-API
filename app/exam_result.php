<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Student;

class exam_result extends Model
{

    protected $fillable = ['id','student_id','exam_date','subject','max_marks','obt_marks'];

    public $timestamps = false;

    public function read($arrInputs){

    //    $rules = [
    //     'student_id' => 'integer',
    //     'exam_date' => 'integer',
    //     'subject' => 'string',
    //     'max_marks' => 'integer',
    //     'obt_marks' => 'integer'
    // ];

        $objExam = self::join('students','exam_results.student_id', "=", 'students.Id')
                   ->select('students.Name','exam_results.*');
        
                if(isset($arrInputs['id'])){
                    $objExam = $objExam->where('exam_results.id',$arrInputs['id']);
                }
                if(isset($arrInputs['student_id'])){
                    $objExam = $objExam->where('exam_results.student_id',$arrInputs['student_id']);
                }
                if(isset($arrInputs['exam_date'])){
                    $objExam = $objExam->where('exam_results.exam_date',$arrInputs['exam_date']);
                }
                if(isset($arrInputs['subject'])){
                    $objExam = $objExam->where('exam_results.subject',$arrInputs['subject']);
                }
                if(isset($arrInputs['max_marks'])){
                    $objExam = $objExam->where('exam_results.max_marks',$arrInputs['max_marks']);
                }
                if(isset($arrInputs['obt_marks'])){
                    $objExam = $objExam->where('exam_results.obt_marks',$arrInputs['obt_marks']);
                }
            
                return $objExam->get();

            //    ->get();
    }


    public function res($student_id,$subject)
    {
        // $rules = [
        //     'student_id' => 'integer',
        //     'subject' => 'string'
        // ];
       
        $objExam = self::selectRaw('min(obt_marks) as MinMarks, max(obt_marks) as MaxMarks, avg(obt_marks) as Percentage');
       
        if($student_id)
        {
            $objExam->where('student_id',$student_id);               
        }

        if($subject)
        {
            $objExam = $objExam->where('subject',$subject);  
        }
        return $objExam->get();
        
    }
}
