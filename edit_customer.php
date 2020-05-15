

<?php
require_once('./dao/customerDao.php');

if(isset($_GET['emailAddress'])){
    $customerDao = new customerDao();
	$customer = $customerDao->getCustomer($_GET['emailAddress']);
	if ($customer){
?>

        <h3>Edit Customer</h3>
        <form name="editCustomer" method="post" action="process_customer.php?action=edit">
            <table>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="hidden" name="customerName" id="customerName" 
                               value="<?php echo $customer->getCustomerName();?>"><?php echo $customer->getCustomerName();?></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="text" name="phoneNumber" id="phoneNumber" 
                               value="<?php echo $customer->getPhoneNumber();?>"></td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td><input type="text" name="emailAddress" id="emailAddress" 
                               value="<?php echo $customer->getEmailAddress();?>"></td>
                </tr>
				<tr>
                    <td>Referrer:</td>
                    <td><input type="text" name="referrer" id="referrer" 
                               value="<?php echo $customer->getReferrer();?>"></td>
                </tr>
                <tr>
                    <td cospan="2"><a onclick="return confirmDelete('<?php echo $customer->getCustomerName() . ' ' . $customer->getPhoneNumber() . ' ' . $customer->getReferrer();?>')" href="process_customer.php?action=delete&emailAddress=<?php echo $customer->getEmailAddress();?>">DELETE <?php echo $customer->getCustomerName();?></a></td>
                </tr>
                <tr>
                    <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Update Customer"></td>
                    <td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>
                </tr>
            </table>
        </form>
       <h4><a href="contact.php">Back to main page</a></h4>
		</body>
</html>
<?php } else{
//Send the user back to the main page
header("Location: contact.php");
exit;
}

} ?>
