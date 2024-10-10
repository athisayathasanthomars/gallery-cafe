<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .booking-container {
            max-width: 600px;
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            text-align: left;
        }

        .booking-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 0 0 48%;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .staff-table-container {
            max-width: auto;
            margin: 10px auto;
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .btn-update, .btn-delete {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .btn-update {
            background-color: #28a745;
            border: none;
        }

        .btn-delete {
            background-color: #dc3545;
            border: none;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <section>
    <div id="main">
      <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
           <li><a href="admin_home.php">Customer</a></li>
           <li><a href="admin_menu.php">Menu</a></li>
           <li><a href="admin_res_table.php">Tables</a></li>
           <li><a href="admin_staff.php">Staff</a></li>
           <li><a href="admin_reservation.php">Reservation</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="">Logout</a></li>
        </ul>
      </nav>
    </div>
    </section> 
    
    <div class="staff-table-container">
        <h2>Customer List</h2>
        <table>
            <thead>
                <tr>
                    <th>CustomerID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>NIC</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Update</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   // Include your database connection
                   include('db_connection.php');

                   // Fetch staff details
                   $sql = "SELECT * FROM customer";
                   $result = $conn->query($sql);

                   // Check if there are any records to display
                   if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>" . $row['customerid'] . "</td>";
                           echo "<td>" . $row['name'] . "</td>";
                           echo "<td>" . $row['email'] . "</td>";
                           echo "<td>" . $row['phoneno'] . "</td>";
                           echo "<td>" . $row['address'] . "</td>";
                           echo "<td>" . $row['nicno'] . "</td>";
                           echo "<td>" . $row['username'] . "</td>";  
                           echo "<td>" . $row['password'] . "</td>";                 
                           echo "<td><a href='update_customer.php?id=" . $row['customerid'] . "'><button type='button' name='update' class='btn-update'>Update</button></a></td>";
                           echo "<td><a href='delete_customer.php?id=" . $row['customerid'] . "'><button type='button' name='delete' class='btn-delete'>Delete</button></a></td>";
                           echo "</tr>";
                        }
                    } 
                    else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
