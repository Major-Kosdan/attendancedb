<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";

class attendanceDetails
{
    public function saveAttendance($dbo,$session,$course,$fac,$student,$ondate,$status)
    {
        $rv=[-1];
        $c="insert into attendance_details
        (session_id,course_id,staff_id,student_id,on_date,status)
        values
        (:session_id,:course_id,:staff_id,:student_id,:on_date,:status)";
        $s=$dbo->conn->prepare($c);
        try{
           $s->execute([":session_id"=>$session,":course_id"=>$course,":staff_id"=>$fac,":student_id"=>$student,":on_date"=>$ondate,":status"=>$status]);
           $s->execute();
           $rv=[1];
        }
        catch(Exception $e)
        {
            
        }  
        return $rv;
    }
}

?>