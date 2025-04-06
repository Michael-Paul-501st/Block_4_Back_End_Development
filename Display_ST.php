<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Display ST</title><!--The title of the web page -->
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

$ST_ID =  $_GET["ST_ID"];//get the ST ID

$sql_get_TA_info = "SELECT * FROM `Substitute_teacher` WHERE ST_ID = '". strval($ST_ID)."';";//display the ST info and display it
$ST_info = $conn->query($sql_get_TA_info);
if ($ST_info ->num_rows > 0){
    while ($row = $ST_info -> fetch_assoc()){
        $ST_Name =  $row["ST_Name"];
        $ST_Address =  $row["ST_Address"];
        $ST_Email =  $row["ST_Email"];
        $ST_Phone_number =  $row["ST_Phone_number"];
        $ST_Daily_Salary =  $row["ST_Daily_Salary"];
        $ST_Background_check =  $row["ST_Background_check"];
        echo "<div class='row'>";
        echo "<div class='col'><h3>Substitute  Teacher Info</h3></div>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<div class='col'>". $ST_ID ."</div>";
        echo "<div class='col'>". $ST_Name ."</div>";
        echo "<div class='col'>". $ST_Address ."</div>";
        echo "<div class='col'>". $ST_Email ."</div>";
        echo "<div class='col'>". $ST_Phone_number ."</div>";
        echo "<div class='col'>". $ST_Daily_Salary ."</div>";
        echo "<div class='col'>". $ST_Background_check ."</div>";
        echo "</div>";
    }
}
else{
    echo "<div class='row'>";
    echo "<div class='col'><h3>No Substitute  Teacher with that ID</h3></div>";
    echo "</div>";
}

$sql_get_class_ID = "SELECT * FROM `ST_Class` WHERE ST_ID = '". strval($ST_ID)."';";//get the class tied to the ST and display it
$ClassID_result = $conn->query($sql_get_class_ID);
if ($ClassID_result ->num_rows > 0){
    while ($row = $ClassID_result -> fetch_assoc()){
        $class_ID =  $row["Class_ID"];
        $sql_get_class_info = "SELECT * FROM `class` WHERE Class_ID = '". strval($Class_ID)."';";
        $classID_result = $conn->query($sql_get_class_info);
        if ($classID_result ->num_rows > 0){
            while ($row_1 = $classID_result -> fetch_assoc()){
                $Class_Name =  $row_1["Class_Name"];
                $Class_Capacity =  $row_1["Class_Capacity"];
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
    }
} 
else {
    echo "<div class='row'>";
    echo "<div class='col'><h3>NO class assigned to Substitute  Teacher</h3></div>";
    echo "</div>";
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