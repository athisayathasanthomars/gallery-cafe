<?php

// Include your database connection
include('db_connection.php');

if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $staffid=$_GET['id'];
    $del_query="DELETE FROM staff WHERE staffid='$staffid'";
    $result=mysqli_query($conn,$del_query);
    if($result){
        echo "<script> alert('Staff Deleted!!'); </script>";
    }
    else{
        echo "<script> alert('Unable to delete!!'); </script>";
    }    
}

?>
<script type="text/javascript">
    window.location="admin_staff.php";
</script>