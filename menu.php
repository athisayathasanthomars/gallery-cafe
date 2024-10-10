<?php
// Include your database connection
include('db_connection.php');

// Initialize query to get all menus
$sql = "SELECT * FROM menu";
$searchTerm = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        // If "Clear" button is clicked, reset the search term
        $searchTerm = "";
    } elseif (!empty($_POST['search'])) {
        // If search is performed, filter by the search term
        $searchTerm = strtolower($_POST['search']);
        $sql = "SELECT * FROM menu WHERE LOWER(cousintype) LIKE '%$searchTerm%'";
    }
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
    form {
        display: flex;        
        justify-content: center;
        align-items: center;
    }
    input[type="text"] {
        padding: 10px;
        width: 250px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-right: 10px;
        font-size: 16px;
    }
    button {
        margin-right: 10px;
        padding: 10px 20px;
        background-color: #060270;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    button[type="submit"]:hover {
        background-color: #CECECE;
    }
    button[name="clear"] {
        background-color: #dc3545;
    }    
    button[name="clear"]:hover {
        background-color: #c82333;
    }
    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 12px 15px;
    }
    th {
        background-color: #060270;
        color: white;
        font-weight: bold;
        text-align: center;
    }
    tr {
        border-bottom: 1px solid #dddddd;
    }
    tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    td img {
        border-radius: 2px;
        width: 200px;
        height: 200px
    }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <section>
    <div id="main">
      <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
           <li><a href="index.php">Home</a></li>
           <li><a href="about.html">About</a></li>
           <li><a href="facilities.html">Facilities</a></li>
           <li><a href="menu.php">Menus</a></li>
           <li><a href="reservation_table.php">Reserve Table</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="customer.php">Customer</a></li>
           <li><a href="staff.php">Staff</a></li>
           <li><a href="staff.php">Admin</a></li>
        </ul>
      </nav>
    </div>
    </section>
    
    <!-- Menu -->
    <section>
        <h2>Menu List</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="search" placeholder="Search by cuisine type..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
            <button type="submit" name="clear">Clear</button>
       </form>

       <br>

       <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Ingridients</th>
                <th>Category</th>
                <th>Cuisine Type</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Image</th>
           </tr>
       </thead>
       <tbody>
        <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['ingredients'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['cousintype'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['availability'] . "</td>";
                echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Menu Image"></td>';
                echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No menus found</td></tr>";
          }
        ?>
        </tbody>

        <?php
        $conn->close();
        ?>

        </table>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
