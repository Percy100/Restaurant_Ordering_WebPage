
	<?php
		include './menuItem.php';
		
		$item_1 = 'The WP Burger';
		$description_1 = 'Freshly made all-beef patty served up with homefries';
        $price_1 ='$14:00';
		$menuItem_1 = new Menuitem($item_1, $description_1, $price_1);
		
		$item_2 = 'WP Kebobs';
		$description_2 = 'Tender cuts of beef and chicken, served with your choice of side';
		$price_2 ='$17:00';
		$menuItem_2 = new Menuitem($item_2, $description_2, $price_2)
	?>

	<?php
		include './header.php';
	?>
   
            <div id="content" class="clearfix">
                <aside>
                        <h2><?php $date = DateTime::createFromFormat('Y-m-d', date("Y-m-d")); echo $date->format('l'); ?>'s Specials</h2>
                        <hr>
						<img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
                        <h3><?php echo $menuItem_1->getItemName(); ?></h3>
                        <p><?php echo $menuItem_1->getDescription().' - '.$menuItem_1->getPrice();?></p>
                        <hr>
                        <img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
                        <h3><?php echo $menuItem_2->getItemName(); ?></h3>
                        <p><?php echo $menuItem_2->getDescription().' - '.$menuItem_2->getPrice(); ?></p>
						
                        <hr>
                </aside>
                <div class="main">
                    <h1>Welcome</h1>
                    <img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <h2>Book your Christmas Party!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div><!-- End Main -->
            </div><!-- End Content -->
            
			<?php
				include 'footer.php';
			?>
	
