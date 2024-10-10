<?php
//code to show the customer details
// Start the session
session_start();

// Include your database connection
include('db_connection.php');

// Initialize the error message
$error = "";

$cusid=$_GET['id']; 
  
  if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
  }
  else{
    $result=mysqli_query($conn,"SELECT * FROM customer WHERE customerid='$cusid'");
	$row=mysqli_fetch_assoc($result);
    $id=$row['customerid'];
    $name=$row['name'];
    $email=$row['email'];
    $phoneno=$row['phoneno'];
    $nic=$row['address'];
    $address=$row['nicno'];
    $username=$row['username'];
    $password=$row['password'];
  }
?>

<?php
//code for update customer details
if(isset($_POST['update'])){
    if(empty($_POST['id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phoneno']) || empty($_POST['address']) || empty($_POST['nic']) || empty($_POST['username']) || empty($_POST['password'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
        $id=$_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phoneno=$_POST['phoneno'];
        $address=$_POST['address'];
        $nic=$_POST['nic'];
        $username=$_POST['username'];
        $password=$_POST['password'];
      
        $update_query="UPDATE customer SET name='$name',email='$email',phoneno='$phoneno',address='$address',nicno='$nic',username='$username',password='$password' WHERE customerid='$id'";
        if($conn->query($update_query)){
           echo "<script> alert('Update successful.'); </script>";
           echo "<script>window.location='admin_home.php';</script>";
        }
        else{
           echo "<script> alert('Update fail.'); </script>";
        }      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
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
      <h2>Update Customer</h2>
      <form method="post" action="">
        <div class="form-row">
          <div class="form-group">
              <label for="id">Customer ID:</label>
              <input value="<?php echo $id; ?>" type="text" id="id" name="id">
          </div>
          <div class="form-group">
              <label for="name">Full Name:</label>
              <input value="<?php echo $name; ?>" type="text" id="name" name="name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="email">Email:</label>
              <input value="<?php echo $email; ?>" type="text" id="email" name="email">
          </div>
          <div class="form-group">
              <label for="phoneno">Phone No:</label>
              <input value="<?php echo $phoneno; ?>" type="text" id="phoneno" name="phoneno">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="address">Address:</label>
              <input value="<?php echo $address; ?>" type="text" id="address" name="address">
          </div>
          <div class="form-group">
              <label for="nic">NIC:</label>
              <input value="<?php echo $nic; ?>" type="text" id="nic" name="nic">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <label for="username">Username:</label>
              <input value="<?php echo $username; ?>" type="text" id="username" name="username">
          </div>
          <div class="form-group full-width">
              <label for="password">Password:</label>
              <input value="<?php echo $password; ?>" type="text" id="password" name="password">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <button name="update" type="submit">Update</button>
          </div>
          <div class="form-group full-width">
              <button class="cancel-btn"><a href="admin_home.php" style="text-decoration:none; color:white;">Cancel</a></button>
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
