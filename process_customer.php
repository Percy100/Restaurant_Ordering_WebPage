<?php
require_once('./dao/customerDao.php');
if(isset($_GET['action'])){
    
	 if($_GET['action'] == "edit"){
        if(isset($_POST['customerName']) && 
                isset($_POST['phoneNumber']) && 
				isset($_POST['emailAddress']) &&
                isset($_POST['referrer'])){
        
        
               
                $customerDAO = new customerDAO();
                $result = $customerDAO->editCustomer($_POST['emailAddress'], 
                        $_POST['customerName'], $_POST['phoneNumber'], $_POST['referrer']);
                

                if($result > 0){
                    header('Location:edit_customer.php?recordsUpdated='.$result.'&emailAddress=' . $_POST['emailAddress']);
                } else {
                    header('Location:edit_customer.php?emailAddress=' . $_POST['emailAddress']);
                }
            } else {
                header('Location:edit_customer.php?missingFields=true&emailAddress=' . $_POST['emailAddress']);
            }
        } else {
            header('Location:edit_customer.php?error=true&emailAddress=' . $_POST['emailAddress']);
        }
    }
    
    if($_GET['action'] == "delete"){
        if(isset($_GET['emailAddress'])){
            $customerDao = new customerDao();
            $success = $customerDao->deleteCustomer($_GET['emailAddress']);
            echo $success;
            if($success){
                header('Location:contact.php?deleted=true');
            } else {
                header('Location:contact.php?deleted=false');
            }
        }
    }

?>