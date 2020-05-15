<?php

	include ('./header.php');
	require_once('./dao/customerDao.php');
	
	
	require_once('./websiteUser.php');
	session_start();
	session_regenerate_id(false);
	
		if(isset($_SESSION['AdminID'])){
		if(!$_SESSION['websiteUser']->isAuthenticated()){
		header('Location:login.php'); 
		}
		} else {
		header('Location:login.php');
		}
		
	$customerDao = new customerDao;
	$customers=$customerDao->getCustomers();
	
	echo '<div>'.'SessionID: ' . session_id() .'</div>';
	echo '<div>'.'Session AdminID: ' . $_SESSION['AdminID'].'</div>';
			if($_SESSION['websiteUser']->getDate()!=null){
				echo '<div>'.'Last login date: ' . $_SESSION['websiteUser']->getDate().'</div>';
			}else{
				echo '<div>'.'The first time to log in' .'</div>';  
			}
				echo("<button onclick=\"location.href='logout.php'\">Logout!</button>");
	
	
	/*if ($customers){
		echo '<h3>'.'<span style=\'color:green\'>'.'Congratulations! You have sucessfully signed up!'.'</span>'.'</h3>';
		echo '<table width="100%" height="100%" border="5">';
		echo '<tr><th>customerName</th> <th>phoneNumber</th> <th>emailAddress</th> <th>referral</th></tr>';
           // $ID = $customerDao->getID();               
          //  $counter=0;
			foreach($customers as $customer){
				echo '<tr>';
				echo '<td>' . $customer->getCustomerName() . '</td>';
                echo '<td>' . $customer->getPhoneNumber() . '</td>';
                echo '<td><a href=\'edit_customer.php?emailAddress='. $customer->getEmailAddress() . '\'>' . $customer->getEmailAddress() . '</a></td>';
                echo '<td>' . $customer->getReferrer() . '</td>';
                echo '</tr>';
            }
            echo '</table>';
	}
	else{
		echo '<h3>'.'No Existing Mailing Information'.'</h3>';
	}
	*/
			mysqli_report(MYSQLI_REPORT_STRICT);
			$connect = mysqli_connect("localhost", "wp_eatery", "password", "wp_eatery") or die('Error: ' . mysqli_error($link));
			$query = "SELECT * FROM mailinglist" ;
			$log = $connect->query($query) or die('Error: ' . mysqli_error($conect));
            echo '<table style=\"text-align:center;\" border="2">';
			echo "<tr><th style=\"width:150px;\">Customer Name</th><th style=\"width:150px;\">Phone Number</th><th style=\"width:250px;\"><center>Email Address</center></th><th style=\"width:100px;\"><center>Referrer</center></th></tr>";
			while ($row = mysqli_fetch_array($log)) 
			{
            //echo "<tr><td style=\"text-align:center;\">".$row['customerName']."</td><td style=\"text-align:center;\">".$row['phoneNumber']."</td><td style=\"word-break:break-all;\">".$row['emailAddress']."</td><td style=\"text-align:center;\">".$row['referrer']."</td></tr>";	
            echo '<tr>';
            echo '<td style="text-align:center">' . $row['customerName'] . '</td>';
            echo '<td style="text-align:center">' . $row['phoneNumber'] . '</td>';
            echo '<td style="word-break:break-all; text-align:center;">' . $row['emailAddress'] .'</td>';
            echo '<td style="text-align:center">' . $row['referrer'] .'</td>';
            echo '</tr>';
			}
			echo "</table>";
			mysqli_close($connect);

	
	?>
	
	<?php 
		include './footer.php' 
	?>