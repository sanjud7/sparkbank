<?php
include_once('connection.php'); 
$query1="SELECT * FROM  customer"; 
$result=mysqli_query($conn,$query1); 
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SparkBank</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="menubar">
            <a href="home.php" id="logo" class="bankname">SparkBank</a>
            <ul class="customerpanel">
               
                <li><a href="customer.php" id="view">View Customers</a></li>
                <li><a href="history.php">Transactions</a></li>

            </ul>
        </div>
        <h1 class="welcome">lcome to SparkBa</h1>

        <div class="quotes">
            <h2>Safe</h2>
            <h2>Secure</h2>
            <h2>Fast</h2>
        </div>

        <div class="create">
            <form method="POST" class="myform" id="myform" action="home.php" class="form-container">
                <h3>Create User</h3>
                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required> <br>


                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="email" name="email" required><br>

                <label for="payment"><b>Paymentid</b></label>
                <input type="text" placeholder="payme@123" name="payid" required><br>


                <label for="amount"><b>Balance</b></label>
                <input type="tel" placeholder="Enter balance" name="balance" required>


                <button type="submit" name="submit" class="btn">Add</button>
            </form>




        </div>


    </div>

</body>

</html>

<?php
    include 'connection.php';
    if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $balance=$_POST['balance'];
    $id=$_POST['payid'];
    $sql="insert into customer(Name,Email,Balance,paymentid) values('{$name}','{$email}','{$balance}','{$id}')";
    $result=mysqli_query($conn,$sql);
    if($result){
               echo "<script> alert('Hurray! User created');
                               window.location='home.php';
                     </script>";

    }
  }
?>