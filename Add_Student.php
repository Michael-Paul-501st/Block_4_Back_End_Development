<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Add Student</title><!--The title of the web page -->
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
                <div class="row"><!-- This is the row-->
                    <div class="col"><!-- This create a collumn -->
                        <a href="Index.html"><!-- This link to the home page -->
                            <h2>Home</h2>
                        </a>
                    </div>
                    <div class="col">
                        <a href="About_Us.html"><!-- This link to the about us-->
                            <h2>About Us</h2>
                        </a>
                    </div>
                    
                    <div class="col">
                        <a href="Log_in_page.html"><!-- This link to the log in page-->
                            <h2>log in</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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

// All student information
$student_Name =  $_GET["student_Name"];
$Student_Address =  $_GET["Student_Address"];
$Student_Medical_information =  $_GET["Student_Medical_information"];
$student_Behavior_record = $_GET["student_Behavior_record"];
$student_baseline_test = $_GET["student_baseline_test"];
$student_username = $_GET["student_username"];
$student_password = password_hash($_GET["student_password"], PASSWORD_DEFAULT); // Hash password
// SENCO Information
$Govement_money =  $_GET["Govement_money"];
$Needs_of_the_children =  $_GET["Needs_of_the_children"];
$Requirement_for_the_child =  $_GET["Requirement_for_the_child"];

$sql_Student = "INSERT INTO `student` (`Student_ID`, `Student_Name`, `Student_Address`, `Student_Medical_Info`, `Student_behaviour_record`, `student_baseline_test`) VALUES (NULL, '". strval($student_Name) . "', '".strval($Student_Address)."',' ". strval($Student_Medical_information)."', '". strval($student_Behavior_record)."', '".  strval($student_baseline_test)."');";
$sql_log_in = "INSERT INTO `log_in` (`Universal_ID`, `Log_in_username`, `Log_in_password`) VALUES (NULL, '". strval($student_username)."', '". strval($student_password)."');";
$sql_get_student_ID = "SELECT * FROM `student` WHERE Student_Name = '". strval($student_Name)."' AND Student_Address = '". strval($Student_Address)."' limit 1;";
$sql_get_universal_ID = "SELECT * FROM `log_in` WHERE Log_in_username = '". strval($student_username). "' AND Log_in_password = '". strval($student_password) . "'  limit 1;" ;



//echo "Add regular student";
if ($conn->query($sql_Student) === TRUE) {//Add student to the record
    echo "<br>New record created successfully <br>";//return success messsage
} 
else {
    echo "Error: " . $sql_Student . "<br>" . $conn->error;//display error message
}
if ($conn->query($sql_log_in) === TRUE) {//Add student to the record
    echo "<br>New record created successfully <br>";//return success messsage
} 
else {
    echo "Error: " . $sql_log_in . "<br>" . $conn->error;//display error message
}

$StudentID_result = $conn->query($sql_get_student_ID);//get student ID
if ($StudentID_result ->num_rows > 0){
    while ($row = $StudentID_result -> fetch_assoc()){
        echo "<br> Student ID: " . $row["Student_ID"] . "<br>";
        $Student_ID =  $row["Student_ID"];
    }
} 
else {
    echo "<br >NO record found";
}

$UniversalID_result = $conn->query($sql_get_universal_ID);//get log in ID
if ($UniversalID_result ->num_rows > 0){
    while ($row = $UniversalID_result -> fetch_assoc()){
        echo "<br> Universal ID: " . $row["Universal_ID"] . "<br>";
        $Universal_ID =  $row["Universal_ID"];
    }
} 
else {
    echo "<br >NO record found";
}
$sql_Student_log_in = "INSERT INTO `log_in_student` (`Universal_ID`, `Student_ID`) VALUES ('".$Universal_ID."', '".$Student_ID."');";
if ($conn->query($sql_Student_log_in) === TRUE) {//Add student log in to the record
    echo "<br> New record created successfully <br>";//return success messsage
} 
else {
    echo "Error: " . $sql_Student_log_in . "<br>" . $conn->error;//display error message
}

if  ($Govement_money != NULL)//add senco student if it needed
{
    $sql_SENCO = "INSERT INTO `senco` (`Student_ID`, `SENCO_Money`, `SENCO_needs_of_the_children`, `SENCO_requirement_for_the_child`) VALUES ('".$Student_ID."', '".$Govement_money."', '".$Needs_of_the_children."', '".$Requirement_for_the_child."')";
    if ($conn->query($sql_SENCO) === TRUE) {//Add student log in to the record
        echo "<br> New record created successfully <br>";//return success messsage
    } 
}



$conn->close();//close connection with the server
?>
<form>
<input type="button" value="Go back" onclick="history.back()"><!-- This is a back button which will return the page to the previous -->
</form>


<div id="footer"><!-- This is the footer for the page-->
            <p>St Alphonsus Primary School</p>
            <img src="image/Logo.png" alt="" id="logo">
        </div>
    </main>

</html>