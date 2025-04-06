<!DOCTYPE html>
<html lang="en"><!-- The create the html and set lang to english -->
    <head><!-- The head tag for html-->
        <title>Log in</title><!--The title of the web page -->
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
        
        $username = $_POST["username"];
        $password =  $_POST["password"];

        $sql_get_user = "SELECT * FROM Log_in WHERE Log_in_username = '".$username."';";
        $users_info = $conn->query($sql_get_user);//check if the log in exist
        if ($users_info ->num_rows > 0){
            while ($row = $users_info -> fetch_assoc()){
                $Log_in_password = $row["Log_in_password"];//
                if (password_verify($password,$Log_in_password)){//check if password is correct
                    $Universal_ID = $row["Universal_ID"];
                    $sql_if_teacher = "SELECT * FROM Log_in_Teacher WHERE Universal_ID = '".$Universal_ID."';";
                    $teacher = $conn->query($sql_if_teacher);
                    $sql_if_TA = "SELECT * FROM Log_in_TA WHERE Universal_ID = '".$Universal_ID."';";
                    $TA = $conn->query($sql_if_TA);
                    $sql_if_ST = "SELECT * FROM Log_in_ST WHERE Universal_ID = '".$Universal_ID."';";
                    $ST = $conn->query($sql_if_ST);
                    $sql_if_Gaurdian = "SELECT * FROM Log_in_Gaurdian WHERE Universal_ID = '".$Universal_ID."';";
                    $Gaurdian = $conn->query($sql_if_Gaurdian);
                    $sql_if_Student = "SELECT * FROM Log_in_Student WHERE Universal_ID = '".$Universal_ID."';";
                    $Student = $conn->query($sql_if_Student);
                    if($teacher ->num_rows > 0){//check what type of user it is
                        echo " <a href='Teacher_pages.html'>Teacher</a>";
                    }
                    elseif($TA ->num_rows > 0){
                        echo " <a href='Teaching_Assistant_page.html'>Teaching Assistant</a>";
                    }
                    elseif($ST ->num_rows > 0){
                        echo " <a href='Substitute_Teacher_page.html'>Teaching Assistant</a>";
                    }
                    elseif($Gaurdian ->num_rows > 0){
                        echo " <a href='Gaurdian_page.html'>Teaching Assistant</a>";
                    }
                    elseif($Student ->num_rows > 0){
                        echo " <a href='Student_page.html'>Teaching Assistant</a>";
                    }
                    else{
                        echo " <a href='Admin_Pages.html'>Admin</a>";
                    }
                }
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