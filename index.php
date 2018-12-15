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
      padding-bottom: 2px;
        color: white;
      text-decoration: none;
    }
</style>
</head>
<body>

   
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="my.php">My Recipes</a>
  <a href="add.php">Add Recipe</a>
</div>
    
   
<div class="row topnav">
    <div class="col-3">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <a class="active" href="#home" id="logo"><img src="OfficialLogo.png" alt="Avatar" style="max-height: 200px; max-width: 150px"></a>
    </div>
 <!--- Search Bar --> 
    <div  >
      <form  action="index.php" method="post">
        <div class="form-row align-items-center">
          <div class="col-lg-5 my-1">
            <input input type="varchar" class="form-control" name="search" value="<?php echo $search;?>" class="form-control" id="search" placeholder="Search...">
          </div>

          <div class="col-lg-5 my-1">
            <input input type="float" class="form-control" name="mprice" value="<?php echo $mprice;?>" class="form-control" id="maxprice" placeholder="Max Price" min = "0" max = "10000">
          </div>

          <div class="col-sm-3 my-1">
            <input type="submit" name="find" value="Go">
          </div>
        </div>
      </form>
    </div>
    
    
    <?php
    $cookie_name = "user";
      if(isset($_COOKIE[$cookie_name])){
        echo "<a href = 'logout.php' style='margin-left:80%; margin-top:-2.5em;'>Logout</a>";
       
      }
      else{
        echo "<a href='login.php' style='margin-left:80%; margin-top:-2.5em;'>Login</a>";
      }
      ?>
    
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

  $search = $_POST['search'];
  $mprice = $_POST['mprice'];

  try {
      $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $cookie_name = "user";
      if(isset($_COOKIE[$cookie_name])){
        echo "<p style='text-align:center; background-color:lightblue;'><b>Logged in as $_COOKIE[$cookie_name].</b></p>";
       
      }
      else{
        echo "<p style='text-align:center; background-color:lightblue;'><b>Please login to build your recipe book.</b></p>";
      }

      if(empty($search) AND empty($mprice)){
        echo "<p style='text-align:center; background-color:lightblue;'><b>Please enter a search value.</b></p>";
        
      }

      elseif(empty($search)){
        $query = "SELECT * FROM recipes WHERE price <= :mprice";
        $params = array(':mprice' => floatval($mprice));
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
      }
      elseif(empty($mprice)){
        $query = "SELECT * FROM recipes WHERE LOWER(recipename) LIKE LOWER(?)";
        $params = array("%$search%");
        $stmt = $conn->prepare($query); 
        $stmt->execute($params);
      }
      else{
        $query = "SELECT * FROM recipes WHERE LOWER(recipename) LIKE LOWER(:search) AND price <= :mprice";
        $params = array(":search"=>"%$search%", ':mprice' => floatval($mprice));
        $stmt = $conn->prepare($query); 
        $stmt->execute($params);
      }

       // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

      if($stmt->rowCount() == 0){
        echo "<p style='text-align:center; background-color:lightblue;'><b>No results found.</b></p>";
      }


      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
          echo $v;
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