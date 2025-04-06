<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Class Student relationship</title><!--The title of the web page -->
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
        
        $Class_ID =  $_GET["Class_ID"];//get class id
        $Student_ID =  $_GET["Student_ID"];//get student id
        $sql_Class_Student = "INSERT INTO `student_class` (`Student_ID`, `Class_ID`) VALUES ('".$Student_ID."', '".$Class_ID."');";//create the sql to connect them

        $sql_get_class_info = "SELECT * FROM `class` WHERE Class_ID = '". strval($Class_ID)."';";//get the class information
        $classID_result = $conn->query($sql_get_class_info);
        if ($classID_result ->num_rows > 0)
        {
            while ($row = $classID_result -> fetch_assoc())
            {
                $Class_Capacity =  $row["Class_Capacity"];//get the class capacity
            }
        }
        if ($Class_Capacity < 30){
            if ($conn->query($sql_Class_Student) === TRUE) {//Add class student to the record
                echo "<p>New record created successfully</p>";//return success messsage
                $sql_update_class_capacity = "UPDATE Class SET Class_Capacity = Class_Capacity + 1 WHERE Class_ID = ".$Class_ID.";";//update the capacity of the class
                $conn->query($sql_update_class_capacity) ;
            } 
            else {
                echo "Error: " . $sql_Class_Student . "<br>" . $conn->error;//display error message
            }
        }
        else{
            echo "<p>class at max capacity</p>";//display max capcity message
        }
        $conn->close();//close the connection to the server
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