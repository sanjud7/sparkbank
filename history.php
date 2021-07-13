<?php 
include_once('connection.php'); 
$query1="SELECT * FROM  transaction"; 
$result=mysqli_query($conn,$query1); 
?> 

<!DOCTYPE html> 
<html> 
	<head> 
		<title>Sparkbank</title> 
		<link href="history.css" rel="stylesheet">
	</head> 
	<body> 

	<div class="table">

    <a href="home.php" class="navibtn">Home</a>
    <a href="customer.php" class="navibtn1">Transfer Money</a>




		<table class="customertable"> 
	<tr> 
		<th colspan="4" class="record"><h2>Transaction History</h2></th> 
		</tr> 
			  <th>Sender</th>
			  <th>Reciever</th> 
			  
			  <th> Current Balance </th> 
			  
		</tr> 
		
		<?php while($rows=mysqli_fetch_assoc($result)) 
		{ 
		?> 
		<div class="data">
		<tr>
		<td align="center"><?php echo $rows['sender'];?></td>
		<td align="center"><?php echo $rows['receiver']; ?></td> 
		<td align="center"><?php echo $rows['balance']; ?></td> 
		</tr> 
		</div>
	<?php 
               } 
          ?>  

     </table> 

     </div>
	</body> 
	</html>