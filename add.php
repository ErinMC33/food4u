
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

<?php

$cookie_name = "user";
  if(!isset($_COOKIE[$cookie_name])){
    header("location: noadd.php");
    }
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rname = test_input($_POST["rname"]);
  $price = test_input($_POST["price"]);
  $link = test_input($_POST["link"]);
  $user = test_input($_POST["user"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="imgcontainer">
      <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> -->
      <img src="OfficialLogo.png" alt="Avatar" style="max-height: 400px; max-width: 600px">
    </div>

<h2 >Add a New Recipe</h2>
<form method="post" action="add.php" >  
  Recipe Name: <input type="varchar" name="rname">
  <br><br>
  Price: <input type="float" name="price">
  <br><br>
  Link: <input type="varchar" name="link">
  <br><br>
  <input type="submit" name="submit" value="Submit">  
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

    $rname = $_POST['rname'];
    $price = $_POST['price'];
    $link = $_POST['link'];

    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO recipes VALUES(:rname, :price, :link, :user)";
        $params = array(':rname' => $rname,':price' => floatval($price), ':link' => $link, ':user' => $_COOKIE["user"]);
        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        if($result == false){
          echo "Not inserted.";
        }
        else{
          echo "Inserted Sucessfully.";
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