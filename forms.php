<?php

function homeForm ($output){

    if (empty($output))
    {
        $output = '';
    }
    
    return '<form id="signup" method="post" action="' . $_SERVER["PHP_SELF"] . '">
        <h1>Micro Blog</h1>
        <input type="submit" name="login" value="Login" id="submit" />
        <input type="submit" name="register" value="Register" id="submit" />
        <div class="posts" name="homePost">
        ' . $output . '
        </div>
    </form>';
}


$login =
    '<form id="signup" method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <h1>User login</h1>
            <h2>User ID:</h2>
            <input type="text" name="username" value="' . $username . '">
            <h2>Password:</h2>
            <input type="password" name="password">
            <input type="submit" id="submit" name="login2" value="Login" />
    </form>';

$signup = 
    '<form id="signup" method="post" action="' . $_SERVER["PHP_SELF"] . '">
            <h1>User Sign Up - Register To Post</h1>
            <h2>User ID:</h2>
            <input type="text" name="username" value="' . $username . '">
            <h2>Password:</h2>
            <input type="password" name="password">
           	<input type="submit" id="submit" name="register2" value="Register" />
           	<input type="submit" id="submit" name="cancel" value="Cancel" />
    </form>';

$post = 
    '<form id="signup" method="post" action="' . $_SERVER["PHP_SELF"] . '">
        <h1>Micro Blog - Make a Post!</h1>
        <input type="submit" name="signout" value="Signout" id="submit" />
        <textarea name="posttext" rows="8" cols="54"></textarea>
        <input type="submit" name="post" value="Post" id="submit" />
    </form>';



?>