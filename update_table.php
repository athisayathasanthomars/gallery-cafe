<?php
//code to show the customer details
// Start the session
session_start();

// Include your database connection
include('db_connection.php');

// Initialize the error message
$error = "";

$id=$_GET['id']; 
  
  if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
  }
  else{
    $result=mysqli_query($conn,"SELECT * FROM res_table WHERE tableid='$id'");
	$row=mysqli_fetch_assoc($result);
    $id=$row['tableid'];
    $customerid=$row['customerid'];
    $no_of_seats=$row['no_of_seats'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu</title>
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

        input[type="text"]{
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"], 
        button.cancel-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            curso r: pointer;
            font-size: 16px;
        }   
        button[type="submit"]:hover,
        button.cancel-btn:hover {
            background-color: #0056b3;
        }
        .cancel-btn{            
            text-decoration: none;
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
    
    <div class="booking-container">
      <h2>Update Table</h2>
      <form method="post" action="">
      <div class="form-row">
          <div class="form-group">
              <label for="id">Table ID:</label>
              <input value="<?php echo $id; ?>" type="text" id="id" name="id">
          </div>
          <div class="form-group">
              <label for="customerid">CustomerID:</label>     
              <input value="<?php echo $customerid; ?>" type="text" id="customerid" name="customerid">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="no_seats">No of Seats:</label>
              <input value="<?php echo $no_of_seats; ?>" type="text" id="no_seats" name="no_seats" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <button type="submit">Update</button>
          </div>
          <div class="form-group full-width">
              <button class="cancel-btn"><a href="admin_res_table.php" style="text-decoration:none; color:white;">Cancel</a></button>
          </div>
        </div>
        
      </form>
    </div><br><br><br><br><br><br><br><br><br>    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
