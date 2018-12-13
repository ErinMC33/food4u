<!DOCTYPE html>
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
      background-image: url("https://us.123rf.com/450wm/orfeev/orfeev1503/orfeev150300005/40367152-seamless-food-and-drink-background.jpg?ver=6");
    }
    #login {
      float:right;
      font-size:20px;
      color: black;
      margin-right:20px;
       margin-left:5em;
    }
        
    #login:hover {
      background-color: lightblue;
        color: white;
      text-decoration: none;
    }
</style>
</head>
<body>

<div class="row topnav">
  <a href="food4u.php" style="font-size:1em; margin-left:48%;">HomePage</a>
</div>






<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.onclick = function(event){
    if(event.target == modal2){
      modal2.style.display = "none";
    }
}
</script>


    
<script>
/*sidenav*/
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
    

</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="UserPage.js"></script>




 <?php
  $servername = "localhost";
  $username = "postgres";
  $password = "Meiling3";

//Connect
  try {
    $conn = new PDO("pgsql:host=$servername;dbname=food4u", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

       echo "<table style='border: solid 1px black; background-color:white; width:80%;margin-left:8%;'>";
 echo "<tr><th>Recipe</th><th>Price</th><th>Link</th><th>User</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

//Search bar
  $servername = "localhost";
  $username = "postgres";
  $password = "Meiling3";
  $dbname = "food4u";

  $cookie = $_COOKIE['user'];
  $cookie = $_POST['$_COOKIE["user"]'];

  try {
      $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $cookie_name = "user";
      if(isset($_COOKIE[$cookie_name])){
        echo "<p style='text-align:center; background-color:lightblue;'><b>Logged in as $_COOKIE[$cookie_name].</b></p>";
       
     
      

        $query = "SELECT * FROM recipes WHERE username = :cookie";
        $params = array(':cookie' => $_COOKIE["user"]);
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
      

       // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

      if($stmt->rowCount() == 0){
        echo "<p style='text-align:center; background-color:lightblue;'><b>No results found.</b></p>";
      }
      

      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
          echo $v;
      }
      }
      else{
      echo "<p style='text-align:center; background-color:lightblue;'><b>Please login to see recipes.</b></p>";
    }


  }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  $conn = null;
  echo "</table>";



?>



</body>
</html>