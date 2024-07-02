<?php
include("connect.inc");
include("header.html");
?>
<div class="container" style="margin-top:10px">
  <div class="row">
    <div class="col-sm-12">

<?
$search_result = false;  // Initialize search_result to avoid issues if not set later

if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT     User.user_id,
    User.first_name,
    User.last_name,
    User.email,
    User.phone_number,
    Alumni.graduation_year
FROM 
    User
JOIN 
    Alumni
ON 
    User.user_id = Alumni.user_id
ORDER BY 
    User.last_name ASC;
 FROM 2024calebwormald WHERE 
              first_name LIKE ? OR 
              last_name LIKE ? OR 
              Publisher LIKE ? OR 
              Year LIKE ? OR 
              ISBN LIKE ?";

    $stmt = $conn->prepare($query);
    if ($stmt) {
        $valueToSearch = "%$valueToSearch%";
        $stmt->bind_param("sssss", $valueToSearch, $valueToSearch, $valueToSearch, $valueToSearch, $valueToSearch);
        $stmt->execute();
        $search_result = $stmt->get_result();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    $query = "SELECT 
    User.user_id,
    User.first_name,
    User.last_name,
    User.email,
    User.phone_number,
    Alumni.graduation_year
FROM 
    User
JOIN 
    Alumni
ON 
    User.user_id = Alumni.user_id
ORDER BY 
    User.last_name ASC;
";
    $search_result = mysqli_query($conn, $query);

    if (!$search_result) {
        echo "Error executing query: " . mysqli_error($conn);
    }
}
?>

<h2>Search Attendees</h2>
<form action="search.php" method="post">
    <input type="text" name="Search" placeholder="Value To Search"><br><br>
    <input type="submit" name="search" value="Filter"><br><br>
</form>

<?php if ($search_result && $search_result->num_rows > 0): ?>
<table>
    <tr>
        <th>First Name</th>
        <th>Last name</th>
        <th>Graduation Year</th>
    </tr>
    
    <?php while ($row = mysqli_fetch_array($search_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
            <td><?php echo htmlspecialchars($row['graduation_year']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p>No results found</p>
<?php endif; ?>
    </div>
  </div>
</div>

<?php
include("footer.html");
?>
<style>
th, td{
    background-color: #fffaff;
    color:#000000;
    border-collapse: collapse;
    text-align: left;
    border: 1px solid #000000;
    padding: 10px;
    justify-content: center;
}

table{
    background-color: #fffaff;
    color:#000000;
    width: 1000px;
    border-collapse: collapse;
    border: 1px solid #000000;
    padding: 10px;
}

</style>