<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Delete Substitute Teacher</title><!--The title of the web page -->
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
        <div class="container"><!-- This is the container for log-in-->
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

        $ST_ID =  $_GET["ST_ID"];//get the ST ID 

        $sql_get_log_in_ID = "SELECT * FROM Log_in_ST WHERE ST_ID = ". $ST_ID.";";//Get the ST log in ID
        $log_in_ID_result = $conn->query($sql_get_log_in_ID);
        if ($log_in_ID_result ->num_rows > 0){
            while ($row = $log_in_ID_result -> fetch_assoc()){
                $Universal_ID =  $row["Universal_ID"]; 
                $sql_Delete_log_in_TA = "DELETE FROM Log_in_ST WHERE ST_ID = ".$ST_ID.";";//Delete the ST log in relastshion
                $sql_Delete_log_in = "DELETE FROM Log_in WHERE Universal_ID = ".$Universal_ID.";";//Delte the ST log in
                $conn->query($sql_Delete_log_in_TA);
                $conn->query($sql_Delete_log_in);
            }
        }
       

        $sql_Delete_ST = "DELETE FROM Substitute_teacher WHERE ST_ID = ".$ST_ID.";";//Delete the ST
        $sql_Delete_class_ST = "DELETE FROM ST_Class WHERE ST_ID = ".$ST_ID.";";//Delte the St reletshion to the class
        $conn->query($sql_Delete_class_ST);
        $conn->query($sql_Delete_ST);


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