<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Display Library Book</title><!--The title of the web page -->
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

$Library_Book_ID =  $_GET["Library_Book_ID"];//get the library book ID

$sql_get_library_book_info = "SELECT * FROM `Library_Book` WHERE Library_Book_ID = '". strval($Library_Book_ID)."';";//get the library book info
$Library_Book_info = $conn->query($sql_get_library_book_info);
if ($Library_Book_info ->num_rows > 0){
    while ($row = $Library_Book_info -> fetch_assoc()){
        $Library_Book_Name =  $row["Library_Book_Name"];
        $Library_Book_Reading_Age =  $row["Library_Book_Reading_Age"];
        echo "<div class='row'>";
        echo "<div class='col'><h3>Library book Info</h3></div>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<div class='col'>". $Library_Book_ID ."</div>";
        echo "<div class='col'>". $Library_Book_Name ."</div>";
        echo "<div class='col'>". $Library_Book_Reading_Age ."</div>";
        echo "</div>";
        $Student_ID =  $row["Student_ID"];
        if ( $Student_ID != NULL)
        {
            $sql_get_Student_info = "SELECT * FROM `Student` WHERE Student_ID = '". strval($Student_ID)."';";//get the student info for the library book
            $classID_result = $conn->query($sql_get_Student_info);
            if ($classID_result ->num_rows > 0){
                while ($row_1 = $classID_result -> fetch_assoc()){
                    $Student_Name =  $row_1["Student_Name"];
                    $Student_Address =  $row_1["Student_Address"];
                    $Student_Medical_Info =  $row_1["Student_Medical_Info"];
                    $Student_behaviour_record =  $row_1["Student_behaviour_record"];
                    $student_baseline_test =  $row_1["student_baseline_test"];
                    echo "<div class='row'>";
                    echo "<div class='col'><h3>Student Info</h3></div>";
                    echo "</div>";
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
                echo "No student with that ID found";
            }
        }
    }
}
else{
    echo "No Library Book with that ID";
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