
<!DOCTYPE HTML>  
<html>
<head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="UserPage.css">
<style>     
    select{
        padding-top: 8px;
        padding-bottom: 6px;
        margin-right: -.2em;
    }
    body{
      background-color:lightblue;
      text-align:center;
    }
</style>
</head>
<body>  


<div class="imgcontainer">
      <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> -->
      <img src="OfficialLogo.png" alt="Avatar" style="max-height: 400px; max-width: 600px">
    </div>
<h2 >Login</h2>



<form method="post" action="login.php" >  
  Username: <input type="varchar" name="uname">
  <br><br>
  Password: <input type="password" style="width:200px;" name="psw">
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
  <br><br>
  <a href="newUser.php">Create New Account</a>
</form>



<?php
  $servername = "localhost";
  $username = "postgres";
  $password = "Meiling3";

  try {
    $conn = new PDO("pgsql:host=$servername;dbname=food4u", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    $servername = "localhost";
    $username = "postgres";
    $password = "Meiling3";
    $dbname = "food4u";



    session_set_cookie_params(30);
    session_start();

    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

     

       
      

   $cookie_name = 'user';

    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM users WHERE username = :uname AND password = :psw";
        $params = array(':uname' => $uname,':psw' => $psw);
        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        if($stmt->rowCount() == 0 AND !empty($uname)){
          echo "<p style='text-align:center; background-color:lightblue;'><b>No account found for that username and password.</b></p>";
        }

        else if($stmt->rowCount() > 0){
        $cookie_value = $uname;

        setcookie($cookie_name, $cookie_value, $timer, "/");
         echo "<p style='text-align:center; background-color:lightblue;'><b>Welcome back, $cookie_value.</b></p>";

     
      }

      
      

    }
    catch(PDOException $e) {
      //Throwing error but doesn't affect adding.
       // echo "Error: " . $e->getMessage();
    }
    $conn = null;



?>
<br>
<a href="food4u.php">Back to Home</a>
</body>
</html>