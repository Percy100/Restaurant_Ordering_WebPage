    
<?php
include ('./header.php');
require_once('./dao/customerDao.php');
?>

<?php

   try{
	 $customerDao = new customerDao();
	 $hasError = false;
	 $errorMessage = Array();
     
     
    
		if(isset($_POST['customerName'])|| 
			isset($_POST['phoneNumber'])|| 
			isset($_POST['emailAddress'])|| 
			isset($_POST['referral'])){
        
        if($_POST['customerName']==""){
            $hasError = true;
            $errorMessage['customerName'] = "Enter Name";
        }
		if (empty ( $_POST ['emailAddress'] ) || (! filter_var ( $_POST ['emailAddress'], FILTER_VALIDATE_EMAIL ))){
            $hasError = true;
            $errorMessage['emailAddress'] = "Enter Email Address";
        }
       
		if($customerDao->dupEmail($_POST['emailAddress'])){
            $hasError = true;
            $errorMessage['emailAddress'] = "Duplicate Email Address.";
        }
        if (empty($_POST["phoneNumber"])){
            $hasError = true;
            $errorMessage['phoneNumber'] = "Enter Phone Number";
        }
        if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST ['phoneNumber']) ){
            $hasError = true;
            $errorMessage['phoneNumber'] = "Invalid Phone Number, Please En-enter";
        }                
        if (empty($_POST["referral"])) {
            $hasError = true;
            $errorMessage['referral'] = "Please Check Referral ";
        }      
        if(!$hasError){
			$email = $_POST['emailAddress'];
			$hash = password_hash($email, PASSWORD_DEFAULT);
            $customer = new customer($_POST['customerName'],$_POST['phoneNumber'],$_POST['emailAddress'],$_POST['referral']);
            $addSuccess = $customerDao->addCustomer($customer);
            echo '<h3>'. $addSuccess .'</h3>';    
        }
    } 

		if(isset($_GET['deleted'])){
                if($_GET['deleted'] == true){
                    echo '<h3>Customer Deleted</h3>';
                }
            }
		
		if(isset($_POST["myfile"])){
				$path = 'files/';
				$upload_file = $path.basename($_FILES['fileUpload']['name']);
				if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$upload_file)){
						echo "<script>alert('File uploaded successfully!');</script>";
				} else {
						echo "<script>alert('Failed!');</script>";
				}
		}
						
				
				
?>					
            
            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
                <div class="main">
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Customer Name:</td>
                                <td><input type="text" name="customerName" id="customerName" placeholder="Tom Riddle" size='40'>
                                <?php 
                                if(isset($errorMessage['customerName'])){echo '<span style=\'color:red\'>'.$errorMessage['customerName'].'</span>';}
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" placeholder="123-456-7890" size='40'> 
                                <?php 
                                if(isset($errorMessage['phoneNumber'])){echo '<span style=\'color:red\'>'.$errorMessage['phoneNumber'].'</span>';}
                                ?>
								</td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" placeholder="triddle@yahoo.com" size='40'>
								<?php 
                                if(isset($errorMessage['emailAddress'])){echo '<span style=\'color:red\'>'.$errorMessage['emailAddress'].'</span>';}
                                ?>
								</td>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper">
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio'>
                                    TV<input type='radio' name='referral' id='referralTV' value='TV'>
                                    Other<input type='radio' name='referral' id='referralOther' value='other'>
                                    <?php 
                                if(isset($errorMessage['referral'])){
                        echo '<span style=\'color:red\'>' . $errorMessage['referral'] . '</span>';
                      }
            ?></td>
                            </tr>
									 <tr><!--File Upload form-->
														<td>File Upload:</td>
											<td><input type="file" name="fileUpload" id="fileUpload" value="Open File">&nbsp;&nbsp;<input type='submit' name="myfile" id="myfile" value="Upload"></td>
									</tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                                                             
                            </tr>
                        </table>
	<?php
        
        $customers = $customerDao->getCustomers();
            if($customers){
                
                echo '<table border=\'1\'>';
                echo '<tr><th>Name</th><th>Phone Number</th><th>Email Address</th><th>Referrer</th></tr>';
                foreach($customers as $customer){
                    echo '<tr>';
                    echo '<td>' . $customer->getCustomerName() . '</td>';
					echo '<td>' . $customer->getPhoneNumber() . '</td>';
					echo '<td><a href=\'edit_customer.php?emailAddress='. $customer->getEmailAddress() . '\'>' . $customer->getEmailAddress() . '</a></td>';
                    echo '<td>' . $customer->getReferrer() . '</td>';
                    echo '</tr>';
                }
            }
        
        }catch(Exception $e){
            
            echo '<h3>Error on page.</h3>';
            echo '<p>' . $e->getMessage() . '</p>';            
        }
        ?>			
		
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->


<?php 
	include './footer.php' 
?>