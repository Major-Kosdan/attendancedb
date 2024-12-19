<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendanceapp/database/database.php";
require_once $path."/attendanceapp/database/sessionDetails.php";
require_once $path."/attendanceapp/database/facultyDetails.php";
require_once $path."/attendanceapp/database/courseRegistrationDetails.php";
require_once $path."/attendanceapp/database/attendanceDetails.php";

if(isset($_REQUEST['action']))
{
    $action=$_REQUEST['action'];
    if($action=="getSession")
    {
        //fetch the session from DB
        //and retun to client
        $dbo=new Database();
        $sobj=new SessionDetails();
        $rv=$sobj->getSessions($dbo); 
        //getSessions
        //$rv=["2024/2025 FIRST SEMESTER","2024/2025 SECOND SEMESTER"];
        echo json_encode($rv);
    }
    //data:{facid:facid,sessionid:sessionid,action:"getFacultyCourses"},
    if($action=="getFacultyCourses")
    {
        //fetch the courses taken by fac in sess
        $facid=$_POST['facid'];
        $sessionid=$_POST['sessionid'];
        $dbo=new Database();
        $fo=new staff_details();
        $rv=$fo->getCoursesInASession($dbo,$sessionid,$facid);
        //$rv=[];
        echo json_encode($rv);
    }
    //data:{sessionid:sessionid,classid:classid,
    //action:"getStudentList"},
    if($action=="getStudentList")
    {
        //fetch the courses taken by fac in sess
        $classid=$_POST['classid'];
        $sessionid=$_POST['sessionid'];
        $dbo=new Database();
        $crgo=new CourseRegistrationDetails();
        $rv=$crgo->getRegisteredStudents($dbo,$sessionid,$classid);
         //$rv=[];
        echo json_encode($rv);
    }
    // data:{studentid:studentid,courseid:courseid,
    //facultyid:facultyid,sessionid:sessionid,
    //ondate:ondate,action:"saveattendance"},
    if($action=="saveattendance")
    {
        //fetch the courses taken by fac in sess
        $courseid=$_POST['courseid'];
        $sessionid=$_POST['sessionid'];
        $studentid=$_POST['studentid'];
        $facultyid=$_POST['facultyid'];
        $ondate=$_POST['ondate'];
        $status=$_POST['ispresent'];
        $dbo=new Database();
        $ado=new attendanceDetails();
        $rv=$ado->saveAttendance($dbo,$sessionid,$courseid,$facultyid,$studentid,$ondate,$status);
         //$rv=[];
        echo json_encode($rv);
    }
    
}

?>