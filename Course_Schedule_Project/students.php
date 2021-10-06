<?PHP
    require_once('./configure.php');

    $ID_Student = $_POST['ID_Student'];
    $Fname = $_POST['FName'];
    $Lname = $_POST['LName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Status = $_POST['Status'];
    $Start_Dte = $_POST['Start_Dte'];
    $End_Dte = $_POST['End_Dte'];

     /*if($course_code == ""){
    $course_code ="none given";}
     if($course_desc == ""){
    $course_desc = "none given";}
     */

    $option = $_POST["option"];


    if ($option == "Search Student"){
        $select_statement_valid = 1;
        /*search for the course*/
        echo "Searching for <b>Student ID:</b> $ID_Student <b>First Name:</b> $FName <b>Last Name:</b> $LName <b>Phone:</b> $Phone <b>Email Address:</b> $Email <b>Status:</b> $Status <b>Start Date:</b> $Start_Dte <b>End Date:</b> $End_Dte<br />";
        if($ID_Student == NULL AND $FName == NULL AND $LName == NULL){
            echo "Must include student information to search<br />";
            echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
            echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            $select_statement_valid = 0;
        }
        elseif($ID_Student != NULL){
            $SELECT = "SELECT * FROM t_students WHERE t_students.ID_Student=$ID_Student";
        }
        elseif($ID_Student == NULL AND $FName != NULL AND $LName != NULL){
            $SELECT = "SELECT * FROM t_students WHERE t_students.FName LIKE '$FName' AND t_students.LName LIKE '$LName'";
        }
        else{
            echo "An error constructing SELECT statement.";
            $select_statement_valid = 0;
        }
        if($select_statement_valid == 1){
            $resultSet = $conn->query($SELECT);
            if($resultSet->num_rows > 0){
                echo "Search Results Found Records Listed. <br>Click student to pre-fill information form.<br />";
                while($rows = $resultSet->fetch_assoc()){
                    $ID_Student = $rows['ID_Student'];
                    $FName = $rows['FName'];
                    $LName = $rows['LName'];
                    $Phone = $rows['Phone'];
                    $Email = $rows['Email'];
                    $Status = $rows['Status'];
                    $Start_Dte = $rows['Start_Dte'];
                    $End_Dte = $rows['End_Dte'];
                    
                  
                    $post_string = $ID_Student;
                    $post_string = $post_string . "&" . "FName=" . $FName;
                    $post_string = $post_string . "&" . "LName=" . $LName;
                    $post_string = $post_string . "&" . "Phone=" . $Phone;
                    $post_string = $post_string . "&" . "Email=" . $Email;
                    $post_string = $post_string . "&" . "Status=" . $Status;
                    $post_string = $post_string . "&" . "Start_Dte=" . $Start_Dte;
                    $post_string = $post_string . "&" . "End_Dte=" . $End_Dte;
                    

                    /*value='$ID_course +'*/
                    
                    echo "<br/br/><form action='./students.html' method='GET'><button type='submit' name='ID_Student' id='ID_Student' value='$post_string'>Student ID: $ID_Student, Name: $FName $LName</button></form>";
                }
                echo "<br/><br/><form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
            }
            else{
                echo "Error in searching for student record(s).";
                echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
            }
        }
        
        mysqli_close($conn);
    }


    else if ($option == "Add Student"){
        /* For inserting a course record */
        if($FName != "" && $LName != ""){
            $INSERT = "INSERT INTO t_students (FName, LName, Phone, Email, Status, Start_Dte) VALUES ('$FName', '$LName','$Phone', '$Email','$Status', '$Start_Dte')";
            $stmt = $conn->prepare($INSERT);
                        $stmt->execute();
            $rnum = $stmt->affected_rows;
            printf("Number of rows effected: %d and %d.\n", $stmt->affected_rows, $rnum);
            if($rnum == 1){
                echo "New record inserted successfully";
                echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
                            echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }
            else{
                echo "Failure to Insert record.";
                echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }

            mysqli_close($conn);
        }
        else {
            echo "All fields (except student ID) are required";
            echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
            die();
        }
    }


     else if ($option == "Edit Student"){
               /*Update Editing a course*/
         if($ID_Student != "") {
             if($FName != "" && $LName != "" && $Phone != "" && $Email != "" && $Status != "" && $Start_Dte != "" && $End_Dte != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName, Phone=$Phone, Email=$Email, Status=$Status, Start_Dte=$Start_Dte, End_Dte=$End_Dte WHERE ID_Student='$ID_Student'";
                 
            }
             elseif($FName != "" && $LName != "" && $Phone != "" && $Email != "" && $Status != "" && $Start_Dte != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName, Phone=$Phone, Email=$Email, Status=$Status, Start_Dte=$Start_Dte WHERE ID_Student='$ID_Student'";
                 
            }
             elseif($FName != "" && $LName != "" && $Phone != "" && $Email != "" && $Status != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName, Phone=$Phone, Email=$Email, Status=$Status WHERE ID_Student='$ID_Student'";
                 
            }
             elseif($FName != "" && $LName != "" && $Phone != "" && $Email != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName, Phone=$Phone, Email=$Email WHERE ID_Student='$ID_Student'";
                 
            }
             elseif($FName != "" && $LName != "" && $Phone != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName, Phone=$Phone WHERE ID_Student='$ID_Student'";
                 
            }
             elseif($FName != "" && $LName != "") {
                 $UPDATE = "UPDATE t_students SET FName=$FName, LName=$LName WHERE ID_Student='$ID_Student'";
                 
            }
             else{
                 $UPDATE = "UPDATE t_students SET FName=$FName WHERE ID_Student='$ID_Student'";
            }
        

            $stmt = $conn->prepare($UPDATE);
            $stmt->execute();
            $rnum = $stmt->affected_rows;
            printf("Number of rows effected: %d and %d.\n", $stmt->affected_rows, $rnum);
             
            if($rnum == 1){
                echo "Updated students successfully.";
                echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }
            else{
                echo "Failure to Update record.";
                echo "<form action='./index.html' method='get'><input type='submit' value='Go Back to Main Menu'/></form>";
            }

             mysqli_close($conn);
         
        }

        else {
            echo "Error in updating student must include student ID to edit record.";
            echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
            die();
        }
    }


     else if ($option == "Delete Student"){
        /*Deleting a course*/
         if($ID_Student != ""){

             $DELETE = "DELETE FROM t_students WHERE ID_Student='$ID_Student'";
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
             echo "Error in deleting course must include student ID to delete record.";
             echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
             die();
        }

    }
    
    else{
        echo "Error: Option not found.";
        echo "<form action='./students.html' method='get'><input type='submit' value='Go Back to Manage Students'/></form>";
    }
?>
