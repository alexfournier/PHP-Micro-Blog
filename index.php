<?php
    session_start();
    
    include("forms.php");
    
    $_SESSION['current'] = 1;
    
    $db_host = "mysql8.000webhost.com";
    $db_user = "a7279742_alex";
    $db_password = "blog1pass";
    $db_name = "a7279742_blog";
    
    $rowId = $row['user_id'];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $posttext = $_POST['posttext'];
    $output = '';
    $passwordHash = md5 ($password);
    
    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("Unable to connect to DB: " . mysqli_connect_error ());
    // PLACE POSTS ON HOME PAGE //
    $homePosts = $con->query("SELECT m.time_stamp, m.message_txt, u.user_name FROM messages AS m INNER JOIN users AS u ON m.user_id = u.user_id ORDER BY time_stamp DESC");
    //echo $user_id2;
    //echo $homePosts->num_rows . '<br/>';
        
        if($homePosts->num_rows > 0){
            $output .= "<table>";
            $output .=  "<tr><th>User Name</th><th>Blog Post</th><th>Date & Time</th></tr>";

            while ($newPosts = $homePosts->fetch_object()) {
                $output .=  "<tr>";
                $output .=  "<td>" . $newPosts->user_name . "</td>";
                $output .=  "<td class='post'>" . $newPosts->message_txt . "</td>";
                $output .=  "<td>" . $newPosts->time_stamp . "</td>";
                $output .=  "</tr>";    
            }
            $output .=  "</table>";
        }

    // FOR USER LOGIN //
    if($_POST['login'] == "Login" || $_POST['login2'] == "Login"){
            $_SESSION['current'] = 2;
    }

    // CHECK USER LOGIN - LEADS TO BLOG MESSEGE PAGE //
    if($_POST['login2'] == "Login"){
        
        if(!empty($username)){
            
            if(!empty($password)){
                $existingUser = "SELECT * FROM users WHERE user_name ='$username' AND user_hash='$passwordHash'";
                    
                    if($existingResults = mysqli_query($con, $existingUser)){
                        $existingNum = mysqli_num_rows($existingResults);
                            
                        if($existingNum == 0){
                            echo "<p class='bad'>Wrong User name and/or Password</p>";
                            echo mysqli_error();                    
                        }else{

                            while ($row = mysqli_fetch_assoc($existingResults)) {
                                $_SESSION['user_id'] = $row['user_id'];
                            }
                        }            
                    }else{
                        echo "<p>DB Error:</p>" . mysqli_error();
                    }
            }else{
                echo "<p class='bad'>Enter A password</p>";
            }
        }else{
                echo "<p class='bad'>Enter A User Name</p>";
        }
    }

    // FOR USER CREATION //
    if($_POST['register'] == "Register" ||  $_POST['register2'] == "Register"){
        $_SESSION['current'] = 3;
    }
    
    // CHECK USER CREATION - LEADS TO MESSEGE PAGE //
    if($_POST['register2'] == "Register"){
        
        if(!empty($username)){
            
            if(!empty($password)){
                $existingUser = "SELECT * FROM users WHERE user_name = '$username'";
                    
                if($existingResults = mysqli_query($con, $existingUser)){
                    $existingNum = mysqli_num_rows($existingResults);
                        
                    if($existingNum == 0){
                        $insertUser = "INSERT INTO users (user_name, user_hash) VALUES ('" . $username . "', '" . $passwordHash . "')";
                        $insertResults = mysqli_query($con, $insertUser);
                        // Selects the new user
                        // loop through result to access user_id
                        $selectNewUser = "SELECT * FROM users WHERE user_name = '$username'";
                        $selectNewResults = mysqli_query($con, $selectNewUser);
                        $selectNewNum = mysqli_num_rows($selectNewResults);

                        while ($row = mysqli_fetch_assoc($selectNewResults)) {
                            $_SESSION['user_id'] = $row['user_id'];
                        }
                    }else{
                        echo "<p class='bad'>User Name Allready Taken</p><br>"; 
                    }
                }else{
                    echo mysqli_error();
                }
            }else{
                echo "<p class='bad'>Enter Password</p>";
            }
        }else{
            echo "<p class='bad'>Enter Username</p>";
        }
    } 

    // CHECK POST FORM AND ACTIONS // 
    if($_POST['signout'] == "Signout"){
        // GO TO HOME SCREEN
        echo homeForm($output);
        echo "<p class='good'>User " . $username . "has been signed out" . "</p>";
        session_destroy();
        $_SESSION = array();
    }
    // CHECK POST BUTTON
    if($_POST['post'] == "Post"){
        if(!empty($posttext)){
            echo "<p class='good'>Post Made</p><br/><p>To return to home page Log Out</p>";      
            
            $selectNewUser = "SELECT user_id FROM users WHERE user_id = '" . $_SESSION["user_id"] . "'";
                        $selectNewResults = mysqli_query($con, $selectNewUser);
                        $selectNewNum = mysqli_num_rows($selectNewResults);

                        while ($row = mysqli_fetch_assoc($selectNewResults)) {
                            $_SESSION['user_id'] = $row['user_id'];
                            $rowId = $row['user_id'];
                        }            
            $insertPost = "INSERT INTO messages (message_txt, user_id) VALUES ('" . $posttext . "', '" . $rowId . "')";
            $insertPostResults = mysqli_query($con, $insertPost);

        }else{
            echo "<p class='bad'>No post made. Don't worry it only gets posted on the home page..</p>";
        }
    }
    if(isset($_SESSION['user_id']) || $_POST['post'] == "Post"){
        echo $post;
    }else{
        if(isset($_SESSION['current'])){   
            if($_SESSION['current'] == 1){ 
                echo homeForm($output);
            }
            if($_SESSION['current'] == 2){
                echo $login;
            }
            if($_SESSION['current'] == 3){
                echo $signup;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Midterm - Micro Blog</title>
    <script src="scripts/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
</body>
</html>