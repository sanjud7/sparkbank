<?php 
include_once('connection.php'); 
$query1="SELECT * FROM  customer"; 
$result=mysqli_query($conn,$query1); 
?> 
<!DOCTYPE html> 
<html> 
	<head> 
		<title>Sparkbank</title> 
		<link href="customerstyle.css" rel="stylesheet">
	</head> 
	<body> 

	
	

	<div class="table">

	<a href="home.php" style="color:white; font-size:20px; text-decoration:none; position:relative;top:1%; left:1%;font-weight:bold;cursor:pointer" >Home </a>
	<a href="history.php" style="color:white; font-size:20px; text-decoration:none; position:relative;top:1%; left:84%;font-weight:bold;" >Transactions </a>


	<h1 class="moneytext">Transfer Money</h1>

      <div class="money">
        <form action="customer.php" method=POST>
	     <h2 class="from">From</h2>
		 <input class="from" id="from" name="fromaccount" type="search" placeholder="paymentid">
		 <h2 class="from">To</h2>
		<input class="from" id="to" name="toaccount" type="search" placeholder="paymentid">
		<h2 class="from">Amount</h2>
		<input class="from" id="amount" name="amount" type="tel" placeholder="enter amount">
		<button class="from" id="transfer" name="transfer" type="submit">Transfer</button>
       </form>

		


      </div>


		<table class="customertable"> 
	<tr> 
		<th colspan="4" class="record"><h2>Customer Record</h2></th> 
		</tr> 
			  <th>Payment ID</th>
			  <th> Name </th> 
			  <th> Email </th> 
			  <th> Current Balance </th> 
			  
		</tr> 
		
		<?php while($rows=mysqli_fetch_assoc($result)) 
		{ 
		?> 
		<div class="data">
		<tr>
		<td align="center"><?php echo $rows['paymentid'];?></td>
		<td align="center"><?php echo $rows['Name']; ?></td> 
		<td align="center"><?php echo $rows['Email']; ?></td> 
		<td align="center"><?php echo $rows['Balance']; ?></td> 
		</tr> 
		</div>
	<?php 
               } 
          ?>  

     </table> 


	 </div>
	</body> 
	</html>
    

	<?php

include_once('connection.php'); 
	
	if(isset($_POST['transfer']))
	{
		$fromid=$_POST['fromaccount'];
		$toid=$_POST['toaccount'];
		$amount=$_POST['amount'];
		
		$sql= "SELECT * FROM customer WHERE paymentid ='$fromid' ";
		$query = mysqli_query($conn,$sql);
	    $sql1 = mysqli_fetch_assoc($query);
    
		$sql = "SELECT * FROM customer WHERE paymentid= '$toid' ";
		$query = mysqli_query($conn,$sql);
        $sql2 = mysqli_fetch_assoc($query);
         
		if (($amount)<0)
		{
			 echo '<script type="text/javascript">';
			 echo ' alert("enter a valid amount")'; 
			 echo '</script>';
		 }
	 
	 
	 
		
		 else if($amount >$sql1['Balance'])
		 {
	 
			 echo '<script type="text/javascript">';
			 echo ' alert("Bad Luck! Insufficient Balance")'; 
			 echo '</script>';
		 }
	 
	 
	 
		 
		 else if($amount == 0){
	 
			  echo "<script type='text/javascript'>";
			  echo "alert('Oops! Zero value cannot be transferred')";
			  echo "</script>";
		  }

		  else if($toid==""){

			echo "<script type='text/javascript'>";
			  echo "alert('Oops!select an account')";
			  echo "</script>";

		  }
		  else if($fromid==""){

			echo "<script type='text/javascript'>";
			  echo "alert('Oops!select an account')";
			  echo "</script>";

		  }
	 
		
		else {

			// deducting amount from sender's account
			$newbalance = $sql1['Balance'] - $amount;
			$sql = "UPDATE customer set Balance=$newbalance where paymentid= '$fromid' ";
			mysqli_query($conn,$sql);


			// adding amount to reciever's account
			$newbalance = $sql2['Balance'] + $amount;
			$sql = "UPDATE customer set Balance=$newbalance where paymentid='$toid' ";
			mysqli_query($conn,$sql);

			$sender = $sql1['Name'];
			$receiver = $sql2['Name'];
			$sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
			$query=mysqli_query($conn,$sql);

			if($query){
				 echo "<script> alert('Transaction Successful');
								 window.location='customer.php';
					   </script>";

			}

		}


	}
	
   ?>


   
	
