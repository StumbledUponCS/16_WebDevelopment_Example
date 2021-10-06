<?PHP
    require_once('./configure.php');

    $ID_Schedule = $_POST['ID_Schedule'];
    $ID_Student = $_POST['ID_Student'];
    $ID_Course = $_POST['ID_Course'];
    $Sched_Yr = $_POST['Sched_Yr'];
    $Sched_Sem = $_POST['Sched_Sem'];
    $Grade_Letter = $_POST['Grade_Letter'];

     /*if($course_code == ""){
    $course_code ="none given";}
     if($course_desc == ""){
    $course_desc = "none given";}
     */
    $option = $_POST["option"];


    if ($option == "Search Schedule"){
        $select_statement_valid = 1;
        /*search for the course*/
        echo "Searching for <b>Schedule ID:</b> $ID_Schedule <b>Student ID:</b> $ID_Student <b>Course ID:</b> $ID_Course <b>Scheduled Year:</b> $Sched_Yr <b>Scheduled Semester:</b> $Sched_Sem <b>Grade Letter:</b> $Grade_Letter";
        if($ID_Schedule == NULL AND $ID_Student == NULL AND $ID_Course != NULL){
            echo "Must include schdeule, student, and course id to search<br />";
            echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
            echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            $select_statement_valid = 0;
        }
        elseif($ID_Schedule != NULL AND $ID_Student != NULL AND $ID_Course != NULL AND $Sched_Yr != NULL AND $Sched_Sem != NULL){
            $SELECT = "SELECT * FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course AND t_schedules.Sched_Yr=$Sched_Yr AND t_schedules.$Sched_Sem=$Sched_Sem";
        }
        elseif($ID_Schedule != NULL AND $ID_Student != NULL AND $ID_Course != NULL AND $Sched_Yr != NULL){
            $SELECT = "SELECT * FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course AND t_schedules.Sched_Yr=$Sched_Yr";
        }
        elseif($ID_Schedule != NULL AND $ID_Student != NULL AND $ID_Course != NULL){
               $SELECT = "SELECT * FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course";
        }
        else{
            echo "An error constructing SELECT statement.";
            $select_statement_valid = 0;
        }
        if($select_statement_valid == 1){
            $resultSet = $conn->query($SELECT);
            if($resultSet->num_rows > 0){
                echo "<br>Search Results Found Records Listed. <br> Click schedule to pre-fill information form.<br />";
                while($rows = $resultSet->fetch_assoc()){
                    $ID_Schedule = $rows['ID_Schedule'];
                    $ID_Student = $rows['ID_Student'];
                    $ID_Course = $rows['ID_Course'];
                    $Sched_Yr = $rows['Sched_Yr'];
                    $Sched_Sem = $rows['Sched_Sem'];
                    $Grade_Letter = $rows['Grade_Letter'];
                    
                    $post_string = ID_Schedule;
                    $post_string = $post_string . "&" . "ID_Student=" . $ID_Student;
                    $post_string = $post_string . "&" . "ID_Course=" . $ID_Course;
                    $post_string = $post_string . "&" . "Sched_Yr=" . $Sched_Yr;
                    $post_string = $post_string . "&" . "Sched_Sem=" . $Sched_Sem;
                    $post_string = $post_string . "&" . "Grade_Letter=" . $Grade_Letter;

                    /*value='$ID_course +'*/
                    echo "<br/br/><form action='./schedule.html' method='GET'><button type='submit' name='ID_Schedule' id='ID_Schedule' value='$post_string'>Schedule ID: $$ID_Schedule, Student ID: $ID_Student, Course ID: $ID_Course</button></form>";
                    
                }
                echo "<br/><br/><form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
            }
            else{
                echo "Error in searching for schedule record(s).";
                echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
            }
        }
        
        mysqli_close($conn);
    }


    else if ($option == "Add Schedule"){
        /* For inserting a course record */
        if($ID_Schedule != "" && $ID_Student != "" && $ID_Course != ""){
            $INSERT = "INSERT INTO t_schedule (ID_Schedule, ID_Student, ID_Course, Sched_Yr, Sched_Sem, Grade_Letter) VALUES ('ID_Schedule','$ID_Student', '$ID_Course','$Sched_Yr', '$Sched_Sem','$Grade_Letter')";
            $stmt = $conn->prepare($INSERT);
                        $stmt->execute();
            $rnum = $stmt->affected_rows;
            printf("Number of rows effected: %d and %d.\n", $stmt->affected_rows, $rnum);
            if($rnum == 1){
                echo "New record inserted successfully";
                echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
                            echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }
            else{
                echo "Failure to Insert record.";
                echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }

            mysqli_close($conn);
        }
        else {
            echo "All fields (except course ID) are required";
            echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
            die();
        }
    }


    else if ($option == "Edit Schedule"){
              /*Update Editing a course*/
       if($ID_Schedule != "" && $ID_Student != "" && $ID_Course != ""){
           
           $UPDATE = "UPDATE t_schedules SET ID_Course=$ID_Course, Sched_Yr=$Sched_Yr, Sched_Sem=$Sched_Sem, Grade_Letter=$Grade_Letter WHERE $ID_Schedule='$ID_Schedule' AND ID_Student='$ID_Student'";

           $stmt = $conn->prepare($UPDATE);
           $stmt->execute();
           $rnum = $stmt->affected_rows;
           printf("Number of rows effected: %d and %d.\n", $stmt->affected_rows, $rnum);
           if($rnum == 1){
               echo "Updated course successfully.";
               echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
           }
           else{
               echo "Failure to Update record.";
               echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
           }

           mysqli_close($conn);
       }
       else {
           echo "Error in updating the schedule must include schedule, student and course ID to edit record.";
           echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
           die();
       }
    }


    else if ($option == "Delete Schedule"){
       /*Deleting a course*/
       if($ID_Schedule != "" && $ID_Student != "" && $ID_Course != "") {
           if($Sched_Yr != "" && $Sched_Sem != "") {
               $DELETE = "DELETE FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course AND t_schedules.Sched_Yr=$Sched_Yr AND t_schedules.$Sched_Sem=$Sched_Sem";
               }
           elseif($Sched_Yr != ""){
               $DELETE = "DELETE FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course AND t_schedules.Sched_Yr=$Sched_Yr";
               }
           else{
               $DELETE = "DELETE FROM t_schedules WHERE t_schedules.ID_Schedule=$ID_Schedule AND t_schedules.ID_Student=$ID_Student AND t_schedules.ID_Course=$ID_Course";
               }
           $stmt = $conn->prepare($DELETE);
           $stmt->execute();
           $rnum = $stmt->affected_rows;
           printf("Number of rows effected: %d and %d.\n", $stmt->affected_rows, $rnum);
           
           if($rnum == 1){
               echo "Deleted course successfully.";
               echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
           }
           else{
               echo "Failure to Delete record.";
               echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
           }
           mysqli_close($conn);
       }
        
       else {
           echo "Error in deleting this schedule must include schedule, student and course ID to delete record.";
           echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
           die();
       }

    }
    
    else{
        echo "Error: Option not found.";
        echo "<form action='./schedule.html' method='get'><input type='submit' value='Go Back to Manage Schedule'/></form>";
    }
?>
