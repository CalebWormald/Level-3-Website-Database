<?php
include("connect.inc");
include("header.html");
?>
<div class="container" style="margin-top:10px">
  <div class="row">
    <div class="col-sm-12">

<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
	$author = trim($_POST['author']);
	$Publisher = trim($_POST['publisher']);
	$Year = trim($_POST['year']);
	$ISBN = trim($_POST['isbn']);
	$Description = trim($_POST['desc']);

    

    $q = "INSERT INTO `book`(`ID`,`Title`, `Author`, `Publisher`, `Year`, `ISBN`, `Description`) 
    VALUES (NULL,'$name','$author','$Publisher','$Year','$ISBN','$Description')";
    //echo $query;
    $result = @mysqli_query($conn, $q);
    //var_dump($result);
    if ($result) { //if it ran ok
        echo "<p>Thank you for inserting a books information</p>";


    } else {
        //public message
        echo "Request Unsuccessful";

    }
}
?>
<h1>RSVP</h1>
<form action="insert.php" method='post'>
    <label for="fname">First Name:</label>
    <input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"><br>

    <label for="lname">Last Name:</label>
    <input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"><br>

    <label for="publisher">Publisher:</label>
	<input type="text" name="publisher" value="<?php if (isset($_POST['publisher'])) echo $_POST['publisher']; ?>"><br>
	
    <label for="year">Year: </label>
    <input type="number" name="year" value="<?php if (isset($_POST['year'])) echo $_POST['year']; ?>"><br>

    <label for="isbn">ISBN:  </label>
	<input type="number" name="isbn" value="<?php if (isset($_POST['isbn'])) echo $_POST['isbn']; ?>"><br>

    <label for="desc">Description:</label>
	<input type="text" name="desc" value="<?php if (isset($_POST['desc'])) echo $_POST['desc']; ?>"><br>

    
    <input type="submit" value="Submit">
</form>
    </div>
  </div>
</div>

</body>
</html>

<?
include("footer.html");
?>
