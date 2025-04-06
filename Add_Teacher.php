<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Add Teacher</title><!--The title of the web page -->
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

        // All Teacher information
        $Teacher_Name =  $_GET["Teacher_Name"];
        $Teacher_Address =  $_GET["Teacher_Address"];
        $Teacher_Email =  $_GET["Teacher_Email"];
        $Teacher_SafeGaurding_Course = $_GET["Teacher_SafeGaurding_Course"];
        $Teacher_phone_number = $_GET["Teacher_phone_number"];
        $Teacher_Annual_Salary = $_GET["Teacher_Annual_Salary"];
        $Teacher_Background_check = $_GET["Teacher_Background_check"];
        $Teacher_username = $_GET["Teacher_username"];
        $Teacher_password = $_GET["Teacher_password"];
        $Teacher_password = password_hash( $Teacher_password, PASSWORD_DEFAULT); // Hash password

        $sql_Teacher = "INSERT INTO `teacher` (`Teacher_ID`, `Teacher_Name`, `Teacher_Address`, `Teacher_Email`, `Teacher_Safegaurding`, `Teacher_Phone_number`, `Teacher_Annual_Salary`, `Teacher_Background_check`) VALUES (NULL, '".$Teacher_Name."', '".$Teacher_Address."', '".$Teacher_Email."', '".$Teacher_SafeGaurding_Course."', '".$Teacher_phone_number."', '".$Teacher_Annual_Salary."', '".$Teacher_Background_check."');";
        $sql_log_in = "INSERT INTO `log_in` (`Universal_ID`, `Log_in_username`, `Log_in_password`) VALUES (NULL, '". strval($Teacher_username)."', '". strval($Teacher_password)."');";
        $sql_get_Teacher_ID = "SELECT * FROM `teacher` WHERE Teacher_Name = '". strval($Teacher_Name)."' AND Teacher_Address = '". strval($Teacher_Address)."' limit 1;";
        $sql_get_universal_ID = "SELECT * FROM `log_in` WHERE Log_in_username = '". strval($Teacher_username). "' AND Log_in_password = '". strval($Teacher_password) . "'  limit 1;" ;

        if ($conn->query($sql_Teacher) === TRUE) {//Add Teacher to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_Teacher . "<br>" . $conn->error;//display error message
        }
        if ($conn->query($sql_log_in) === TRUE) {//Add log in to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_log_in . "<br>" . $conn->error;//display error message
        }

        $TeacherID_result = $conn->query($sql_get_Teacher_ID);//get teacher ID
        if ($TeacherID_result ->num_rows > 0){
            while ($row = $TeacherID_result -> fetch_assoc()){
                echo "<br>Teacher ID: " . $row["Teacher_ID"] . "<br>";
                $Teacher_ID =  $row["Teacher_ID"];
            }
        } 
        else {
            echo "<br >NO record found";
        }

        $UniversalID_result = $conn->query($sql_get_universal_ID);//get log in ID
        if ($UniversalID_result ->num_rows > 0){
            while ($row = $UniversalID_result -> fetch_assoc()){
                echo "<br>Universal ID: " . $row["Universal_ID"] . "<br>";
                $Universal_ID =  $row["Universal_ID"];
            }
        } 
        else {
            echo "<br >NO record found";
        }
        $sql_Teacher_log_in = "INSERT INTO `log_in_Teacher` (`Universal_ID`, `Teacher_ID`) VALUES ('".$Universal_ID."', '".$Teacher_ID."');";
        if ($conn->query($sql_Teacher_log_in) === TRUE) {//Add Teacher to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_Teacher_log_in . "<br>" . $conn->error;//display error message
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