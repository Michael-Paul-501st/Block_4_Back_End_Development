<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Add TA</title><!--The title of the web page -->
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

        // All TA information
        $TA_Name =  $_GET["TA_Name"];
        $TA_Address =  $_GET["TA_Address"];
        $TA_Email =  $_GET["TA_Email"];
        $TA_SafeGaurding_Course = $_GET["TA_SafeGaurding_Course"];
        $TA_phone_number = $_GET["TA_phone_number"];
        $TA_Annual_Salary = $_GET["TA_Annual_Salary"];
        $TA_Background_check = $_GET["TA_Background_check"];
        $TA_username = $_GET["TA_username"];
        $TA_password = $_GET["TA_password"];
        $TA_password = password_hash($TA_password, PASSWORD_DEFAULT); // Hash password

        $sql_TA = "INSERT INTO `teacher_assistant` (`TA_ID`, `TA_Name`, `TA_Address`, `TA_Email`, `TA_Safegaurding`, `TA_Phone_number`, `TA_Annual_Salary`, `TA_Background_check`) VALUES (NULL, '".$TA_Name."', '".$TA_Address."', '".$TA_Email."', '".$TA_SafeGaurding_Course."', '".$TA_phone_number."', '".$TA_Annual_Salary."', '".$TA_Background_check."');";
        $sql_log_in = "INSERT INTO `log_in` (`Universal_ID`, `Log_in_username`, `Log_in_password`) VALUES (NULL, '". strval($TA_username)."', '". strval($TA_password)."');";
        $sql_get_TA_ID = "SELECT * FROM `teacher_assistant` WHERE TA_Name = '". strval($TA_Name)."' AND TA_Address = '". strval($TA_Address)."' limit 1;";
        $sql_get_universal_ID = "SELECT * FROM `log_in` WHERE Log_in_username = '". strval($TA_username). "' AND Log_in_password = '". strval($TA_password) . "'  limit 1;" ;

        if ($conn->query($sql_TA) === TRUE) {//Add TA to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_TA . "<br>" . $conn->error;//display error message
        }
        if ($conn->query($sql_log_in) === TRUE) {//Add TA to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_log_in . "<br>" . $conn->error;//display error message
        }

        $TAID_result = $conn->query($sql_get_TA_ID);//get TA ID
        if ($TAID_result ->num_rows > 0){
            while ($row = $TAID_result -> fetch_assoc()){
                echo "<br>Teaching Assistant ID: " . $row["TA_ID"] . "<br>";
                $TA_ID =  $row["TA_ID"];
            }
        } 
        else {
            echo "<br >NO record found";
        }
        $UniversalID_result = $conn->query($sql_get_universal_ID);// get log in ID
        if ($UniversalID_result ->num_rows > 0){
            while ($row = $UniversalID_result -> fetch_assoc()){
                echo "<br>Universal ID: " . $row["Universal_ID"] . "<br>";
                $Universal_ID =  $row["Universal_ID"];
            }
        } 
        else {
            echo "<br >NO record found";
        }
        $sql_TA_log_in = "INSERT INTO `log_in_TA` (`Universal_ID`, `TA_ID`) VALUES ('".$Universal_ID."', '".$TA_ID."');";
        if ($conn->query($sql_TA_log_in) === TRUE) {//Add TA to the record
            echo "New record created successfully";//return success messsage
        } 
        else {
            echo "Error: " . $sql_TA_log_in . "<br>" . $conn->error;//display error message
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