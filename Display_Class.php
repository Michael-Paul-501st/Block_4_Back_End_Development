<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Display Class</title><!--The title of the web page -->
        <link rel="icon" type="img/png" href="image/Logo.png">
        <!-- This is the code for bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
        <meta charset="UTF-8"><!-- This set the charictar set -->
        <link rel="stylesheet" href="css/Main_style.css"><!-- This the core CSS code-->
    </head>
    <main><!-- The main body of the website-->
        <div id="Header"><!-- The header of the website-->
            <img src="image/Logo.png" alt="" id="logo"><!-- The logo for the website -->
            <h1>St Alphonsus Primary School</h1><!-- Text that will be displayed next to logo-->
        </div>
        <div id="navigation"><!-- The navigation of section of the website -->
            <div class="container"><!-- This is the container for navigation-->
                <div class='row'><!-- This is the row-->
                    <div class='col'><!-- This create a collumn -->
                        <a href="Index.html"><!-- This link to the home page -->
                            <h2>Home</h2>
                        </a>
                    </div>
                    <div class='col'>
                        <a href="About_Us.html"><!-- This link to the about us-->
                            <h2>About Us</h2>
                        </a>
                    </div>
                    
                    <div class='col'>
                        <a href="Log_in_page.html"><!-- This link to the log in page-->
                            <h2>log in</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <?php // start of the php code
        $servername = "localhost";//generate the variable used in connecting to the server
        $username = "root";
        $password = "";
        $database = "St_Alphonsus";//The name of the server

        // Connect to database
        $conn = new mysqli ($servername, $username, $password, $database);

        if ($conn->connect_error) {//check if there an error with the connection
            die("Connection failed: " . $conn->connect_error);//report error for connection
        }
        else{
            echo "<h2>connection successful</h2>";//messages that the connection was successful
        }
        session_start();//start the session for the server

        $Class_ID =  $_GET["Class_ID"];//get class ID

        $sql_get_class_info = "SELECT * FROM `class` WHERE Class_ID = '". strval($Class_ID)."';";//display the info for the class
        $classID_result = $conn->query($sql_get_class_info);
        if ($classID_result ->num_rows > 0){
            while ($row = $classID_result -> fetch_assoc()){
                $Class_Name =  $row["Class_Name"];
                $Class_Capacity =  $row["Class_Capacity"];
                echo "<div class='row'>";
                echo "<div class='col'><h3>Class Info</h3></div>";
                echo "</div>";
                echo "<div class='row'>";
                echo "<div class='col'>". $Class_ID ."</div>";
                echo "<div class='col'>". $Class_Name ."</div>";
                echo "<div class='col'>". $Class_Capacity ."</div>";
                echo "</div>";
            }
        }
        else{
            echo "No class with that ID found";
        }

        $sql_get_teacher_ID = "SELECT * FROM `Teacher_Class` WHERE Class_ID = '". strval($Class_ID)."';";//display the info of the teacher of that class
        $TeacherID_result = $conn->query($sql_get_teacher_ID);
        if ($TeacherID_result ->num_rows > 0){
            while ($row = $TeacherID_result -> fetch_assoc()){
                $Teacher_ID =  $row["Teacher_ID"];
                echo $Teacher_ID;
                $sql_get_teacher_info = "SELECT * FROM `Teacher` WHERE Teacher_ID = '". strval($Teacher_ID)."';";
                $Teacher_info = $conn->query($sql_get_teacher_info);
                if ($Teacher_info ->num_rows > 0){
                    while ($row_1 = $Teacher_info -> fetch_assoc()){
                        $Teacher_Name =  $row_1["Teacher_Name"];
                        $Teacher_Address =  $row_1["Teacher_Address"];
                        $Teacher_Email =  $row_1["Teacher_Email"];
                        $Teacher_Safegaurding =  $row_1["Teacher_Safegaurding"];
                        $Teacher_Phone_number =  $row_1["Teacher_Phone_number"];
                        $Teacher_Annual_Salary =  $row_1["Teacher_Annual_Salary"];
                        $Teacher_Background_check =  $row_1["Teacher_Background_check"];
                        echo "<div class='row'>";
                        echo "<div class='col'>". $Teacher_ID ."</div>";
                        echo "<div class='col'>". $Teacher_Name ."</div>";
                        echo "<div class='col'>". $Teacher_Address ."</div>";
                        echo "<div class='col'>". $Teacher_Email ."</div>";
                        echo "<div class='col'>". $Teacher_Safegaurding ."</div>";
                        echo "<div class='col'>". $Teacher_Phone_number ."</div>";
                        echo "<div class='col'>". $Teacher_Annual_Salary ."</div>";
                        echo "<div class='col'>". $Teacher_Background_check ."</div>";
                        echo "</div>";
                    }
                }
                else{
                    echo "<div class='row'>";
                    echo "<div class='col'><h3>No teacher Info</h3></div>";
                    echo "</div>";
                }
            }
        } 
        else {
            echo "<div class='row'>";
            echo "<div class='col'><h3>No teacher for that class</h3></div>";
            echo "</div>";
        }

        $sql_get_student_ID = "SELECT * FROM `Student_Class` WHERE Class_ID = '". strval($Class_ID)."';";//display all the student in that class
        $studentID_result = $conn->query($sql_get_student_ID);
        if ($studentID_result ->num_rows > 0){
            while ($row = $studentID_result -> fetch_assoc()){
                $Student_ID =  $row["Student_ID"];
                echo $Student_ID;
                $sql_get_class_info = "SELECT * FROM `Class` WHERE Student_ID = '". strval($Student_ID)."';";
                $class_info = $conn->query($sql_get_class_info);
                if ($class_info ->num_rows > 0){
                    while ($row_1 = $class_info -> fetch_assoc()){
                        $Student_Name =  $row_1["Student_Name"];
                        $Student_Address =  $row_1["Student_Address"];
                        $Student_Medical_Info =  $row_1["Student_Medical_Info"];
                        $Student_behaviour_record =  $row_1["Student_behaviour_record"];
                        $student_baseline_test =  $row_1["student_baseline_test"];
                        echo "<div class='row'>";
                        echo "<div class='col'>". $Student_ID ."</div>";
                        echo "<div class='col'>". $Student_Name ."</div>";
                        echo "<div class='col'>". $Student_Address ."</div>";
                        echo "<div class='col'>". $Student_Medical_Info ."</div>";
                        echo "<div class='col'>". $Student_behaviour_record ."</div>";
                        echo "<div class='col'>". $student_baseline_test ."</div>";
                        echo "</div>";
                        
                    }
                }
                else{
                    echo "No info for student found";
                }
                $sql_get_Senco_info = "SELECT * FROM `SENCO` WHERE Student_ID = '". strval($Student_ID)."';";
                $Senco_result = $conn->query($sql_get_Senco_info);
                if ($Senco_result ->num_rows > 0){
                    while ($row_1 = $Senco_result -> fetch_assoc()){
                        $SENCO_Money =  $row_1["SENCO_Money"];
                        $SENCO_needs_of_the_children =  $row_1["SENCO_needs_of_the_children"];
                        $SENCO_requirement_for_the_child =  $row_1["SENCO_requirement_for_the_child"];
                        echo "<div class='row'>";
                        echo "<div class='col'>". $SENCO_Money ."</div>";
                        echo "<div class='col'>". $SENCO_needs_of_the_children ."</div>";
                        echo "<div class='col'>". $SENCO_requirement_for_the_child ."</div>";
                        echo "</div>";
                    }
                }
            }
        } 
        else {
            echo "<div class='row'>";
            echo "<div class='col'><h3>No student</h3></div>";
            echo "</div>";
        }

        $sql_get_TA_ID = "SELECT * FROM `TA_Class` WHERE Class_ID = '". strval($Class_ID)."';";//Display the TA of that class
        $TAID_result = $conn->query($sql_get_TA_ID);
        if ($TAID_result ->num_rows > 0){
            while ($row = $TAID_result -> fetch_assoc()){
                $TA_ID =  $row["TA_ID"];
                $sql_get_TA_info = "SELECT * FROM `Teacher_Assistant` WHERE TA_ID = '". strval($TA_ID)."';";
                $TA_info = $conn->query($sql_get_TA_info);
                if ($TA_info ->num_rows > 0){
                    while ($row = $TA_info -> fetch_assoc()){
                        $TA_Name =  $row_1["TA_Name"];
                        $TA_Address =  $row_1["TA_Address"];
                        $TA_Email =  $row_1["TA_Email"];
                        $TA_Safegaurding =  $row_1["TA_Safegaurding"];
                        $TA_Phone_number =  $row_1["TA_Phone_number"];
                        $TA_Annual_Salary =  $row_1["TA_Annual_Salary"];
                        $TA_Background_check =  $row_1["TA_Background_check"];
                        echo "<div class='row'>";
                        echo "<div class='col'>". $TA_ID ."</div>";
                        echo "<div class='col'>". $TA_Name ."</div>";
                        echo "<div class='col'>". $TA_Address ."</div>";
                        echo "<div class='col'>". $TA_Email ."</div>";
                        echo "<div class='col'>". $TA_Safegaurding ."</div>";
                        echo "<div class='col'>". $TA_Phone_number ."</div>";
                        echo "<div class='col'>". $TA_Annual_Salary ."</div>";
                        echo "<div class='col'>". $TA_Background_check ."</div>";
                        echo "</div>";
                    }
                }
                else{
                    echo "No info for TA found";
                }
            }
        } 
        else {
            echo "No TA found for this class";
        }

        $sql_get_Sub_teacher_ID = "SELECT * FROM `ST_Class` WHERE Class_ID = '". strval($Class_ID)."';";//display the substatute teacher of that class
        $TeacherID_result = $conn->query($sql_get_Sub_teacher_ID);
        if ($TeacherID_result ->num_rows > 0){
            while ($row = $TeacherID_result -> fetch_assoc()){
                $ST_ID =  $row["ST_ID"];
                $sql_get_teacher_info = "SELECT * FROM `Substitute_teacher` WHERE ST_ID = '". strval($Sub_Teacher_ID)."';";
                $Teacher_info = $conn->query($sql_get_teacher_info);
                if ($Teacher_info ->num_rows > 0){
                    while ($row = $Teacher_info -> fetch_assoc()){
                        $ST_Name =  $row_1["ST_Name"];
                        $ST_Address =  $row_1["ST_Address"];
                        $ST_Email =  $row_1["ST_Email"];
                        $ST_Safegaurding =  $row_1["ST_Safegaurding"];
                        $ST_Phone_number =  $row_1["ST_Phone_number"];
                        $ST_Annual_Salary =  $row_1["ST_Annual_Salary"];
                        $ST_Background_check =  $row_1["ST_Background_check"];
                        echo "<div class='row'>";
                        echo "<div class='col'>". $ST_ID ."</div>";
                        echo "<div class='col'>". $ST_Name ."</div>";
                        echo "<div class='col'>". $ST_Address ."</div>";
                        echo "<div class='col'>". $ST_Email ."</div>";
                        echo "<div class='col'>". $ST_Safegaurding ."</div>";
                        echo "<div class='col'>". $ST_Phone_number ."</div>";
                        echo "<div class='col'>". $ST_Annual_Salary ."</div>";
                        echo "<div class='col'>". $ST_Background_check ."</div>";
                        echo "</div>";
                    }
                }
                else{
                    echo "No Substitute Teacher found with that ID";
                }
            }
        } 
        else {
            echo "NO Substitute Teacher";
        }
        $conn->close();//close connection with the server
        ?>
        </div>
        <form>
        <input type="button" value="Go back" onclick="history.back()"><!-- This is a back button which will return the page to the previous -->
        </form>
        <div id="footer"><!-- This is the footer for the page-->
            <p>St Alphonsus Primary School</p>
            <img src="image/Logo.png" alt="" id="logo">
        </div>
    </main>
</html>