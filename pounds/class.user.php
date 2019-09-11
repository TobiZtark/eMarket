<?php
require_once('config/dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new connect();
		$db = $database->connect();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname,$umail,$upass,$ugender)
	{
		try
		{
			$new_password = $upass;
			$pid = substr(md5(uniqid(rand(1,6))), 0, 8);
			$reg_date = date("d/m/Y");
			$utoken = "0";
			$urole = "non-admin";
			$stmt = $this->conn->prepare("INSERT INTO user(id,name,email,password,gender,reg_date,token, role) 
		                                               VALUES(:pid, :uname, :umail, :upass, :ugender, :uregister, :utoken, :urole)");
			
			$stmt->bindparam(":pid", $pid);									  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":ugender", $ugender);
			$stmt->bindparam(":uregister", $reg_date);
			$stmt->bindparam(":utoken", $utoken);
			$stmt->bindparam(":urole", $urole);									  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}


	public function doMessage($umail,$umessage,$uname)
	{
		try
		{
			
			$sent_date = date("d/m/Y");
			$stmt = $this->conn->prepare("INSERT INTO message(name,email,message,sent_date) 
		                                               VALUES(:uname, :umail, :umessage, :uregister)");
											  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":umessage", $umessage);
			$stmt->bindparam(":uregister", $sent_date);								  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	

	public function cartItem($user,$uitem,$uquantity, $uname, $uprice)
	{
		try
		{
			
			$add_date = date("d/m/Y");
			$status = "unconfirmed";
			$stmt = $this->conn->prepare("INSERT INTO cart(user_id,item_id,quantity,add_date, status, name, price) 
		                                               VALUES(:user, :uitem, :uquantity, :uregister, :ustatus, :uname, :uprice)");
											  
			$stmt->bindparam(":user", $user);
			$stmt->bindparam(":uitem", $uitem);
			$stmt->bindparam(":uquantity", $uquantity);
			$stmt->bindparam(":uregister", $add_date);
			$stmt->bindparam(":ustatus", $status);	
			$stmt->bindparam(":uname", $uname);	
			$stmt->bindparam(":uprice", $uprice);								  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function doLogin($umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id, name, email, password, role FROM user WHERE email=:umail ");
			$stmt->execute(array(':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() >= 1)
			{
				if(md5($upass) == $userRow['password'])
				{
					//if ($userRow['role'] == "admin" ){
					$_SESSION['user_phone'] = $userRow['phone'];
					$_SESSION['user_email'] = $userRow['email'];
					$_SESSION['user_session'] = $userRow['id'];
					$_SESSION['user_role'] = $userRow['role'];
					$_SESSION['user_name'] = $userRow['name'];
					return true;
				//}
			}


				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}


	public function checkPayment($name,$email,$phone,$address,$country)
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from users WHERE user_email= :email");
		$stmt->execute(array(':email'=>$email));

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() < 1)
		{
			$pid = substr(md5(uniqid(rand(1,6))), 0, 8);
			$stmt1 = $this->conn->prepare("INSERT INTO users(user_id,user_name,user_email,user_country,user_address,user_phone) 
		                                               VALUES(:pid, :uname, :umail, :ucountry, :uaddress, :uphone)");
			
			$stmt1->bindparam(":pid", $pid);									  
			$stmt1->bindparam(":uname", $name);
			$stmt1->bindparam(":umail", $email);
			$stmt1->bindparam(":ucountry", $country);
			$stmt1->bindparam(":uaddress", $address);
			$stmt1->bindparam(":uphone", $phone);									  
				
			$stmt1->execute();	
			$_SESSION['user_session'] = $pid;
			$_SESSION['username'] = $name;

			return 1;


		}
		else{

			return 0;
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function viewTransaction($search)
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from payment WHERE reference_number= :search");
		$stmt->execute(array(':search'=>$search));

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() >= 1)
		{

			return true;


		}
		else{

			return false;
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function countEnrolment()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from user");
		$stmt->execute();

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		$res = $stmt->rowCount();

		return $res;
		
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function countPayment()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from account");
		$stmt->execute();

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		$res = $stmt->rowCount();

		return $res;
		
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function countBooking()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from loan");
		$stmt->execute();

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		$res = $stmt->rowCount();

		return $res;
		
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}
	
	public function countMessage()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from message");
		$stmt->execute();

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		$res = $stmt->rowCount();

		return $res;
		
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	


public function createCentre($name,$address,$country)
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from ecentre WHERE centre_name= :name");
		$stmt->execute(array(':name'=>$name));

		$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() < 1)
		{
			$eid = substr(md5(uniqid(rand(1,6))), 0, 8);
			$status = "inactive";
			$stmt1 = $this->conn->prepare("INSERT INTO ecentre(eid,centre_name,centre_country,centre_address,centre_status)VALUES(:pid, :uname, :ucountry, :uaddress, :status)");
			
			$stmt1->bindparam(":pid", $eid);									  
			$stmt1->bindparam(":uname", $name);
			$stmt1->bindparam(":ucountry", $country);
			$stmt1->bindparam(":uaddress", $address);
			$stmt1->bindparam(":status", $status);									  
				
			$res = $stmt1->execute();	

			return $res;


		}
		else{

			return false;
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function runPayment()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from account");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
                      <td><?php echo $row["user_id"];    ?></td>
                      <td><?php echo $row["amount"];    ?></td>
                      <td><?php echo $row["account"];    ?></td>
                      <td><?php echo $row["bank"];    ?></td>
                      <td><?php echo $row["address"];    ?></td>
                      <td><?php echo $row["swift"];    ?></td>
                      <td><?php echo $row["date"];    ?></td>
                      <td><?php echo $row["status"];    ?></td>
                    </tr>

			<?php
		


		}
	}
		else{
			?>
			<tr>
                      <td colspan='8'>No Records found....</td>
                      
                    </tr>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function viewItem($category)
	{

		?>
<!-- Start Portfolio Section -->
			<section id="fs" class="section">
				<div class="row">
						<div class="span10">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view >Category List: <?php echo $category; ?></h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items WHERE name LIKE '%$category%' OR category LIKE '%$category%' OR tag LIKE '%$category%' OR description LIKE '%$category%'");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="category.php?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class="portfolio-img"><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->

			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}



public function descItem($item)
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items WHERE id ='$item'");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<div class="fullpage">
			<!-- Start About Section -->
			<section id="about">
				<div class="cols-container">
					<div class="gap200"></div>
					<div class="row span6">
						<div class="col-4" data-scrolled-into-view>
							<div class="project-slider">
								<div class="item"><img src="<?php echo $row["image1"]; ?>" alt="Pounds Apparel" style="max-width: 100%; height: auto;"></div>
								<div class="item"><img src="<?php echo $row["image2"]; ?>" alt="Pounds Apparel" style="max-width: 100%; height: auto;"></div>
								<div class="item"><img src="<?php echo $row["image3"]; ?>" alt="Pounds Apparel" style="max-width: 100%; height: auto;"></div>
							</div>
							<div class="project-num-slides">1/3</div>
						</div>
					</div>
					<div class="row span6">
						<div class="col-4" data-scrolled-into-view>
							<h2><?php echo $row["name"]; ?></h2><hr>
							<h4>Tag: <?php echo $row["tag"]; ?></h4>
							<h1>Price: N<?php echo $row["n_price"]; ?>  &nbsp;&nbsp; <s style="font-size:50%;"><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s> </h1><hr>
							<h3>Description: <?php echo $row["description"]; ?></h3><hr><br>
							<a class="span12 button spec-hover" href="view_item.php?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>"><span><i class="ion-ios-cart"></i> Add to Cart </span></a>
							<br/><br/>
							<a class="span12 button spec-hover" style="margin-top: 10px;" href="index.php#contacts"><i class="ion-ios-call"></i> <span>Contact Us</span></a>

						</div>
					</div>
					<div class="gap200"></div>
				</div>
			</section>
			<!-- End About Section -->
		</div><!-- end div .fullpage -->

			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Item found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}




	public function viewAllItem()
	{

		?>
<!-- Start Portfolio Section -->
			<section id="fs" class="section">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view>Category List: All Items</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items ORDER BY id DESC");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="category.php?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class="portfolio-img"><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->

			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function viewProfile($user)
	{

		?>
<!-- Start Portfolio Section -->
			<section id="fs" class="section">
				<div class="row">
						<div class="span4">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view>My Profile</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from user WHERE id='$user'");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="edit_profile.php" class="portfolio-like"><i class="ion-ios-person"></i></a>
							<time> Email: <?php echo $row["email"]; ?></time>
							<a href="" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<br>
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="edit_profile.php">
								<div class="portfolio-item-title">
									<!-- <div class="meta-categories"></div> --><!-- portfolio categories -->
									<h3 align="left"><b>Name:</b> <?php echo $row["name"]; ?></h3> 
									<h3 align="left"><b>Phone:</b> <?php echo $row["phone"]; ?></h3>
									<h3 align="left"><b>State:</b> <?php echo $row["state"]; ?></h3>
									<br>
									<b>Address</b> <h3><?php echo $row["address"]; ?></h3>
									<!-- portfolio title -->
								</div>
								<figure class="portfolio-img"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->
					<div class="span10" style="margin-left:18%;">
					<img src="images/info-ipad.png">
					</img>
				</div>
			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No User found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function editProfile($user)
	{

		?>
<!-- Start Portfolio Section -->
			<section id="fs" class="section">
				<div class="row">
						<div class="span4">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view>Edit Profile</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from user WHERE id='$user'");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="edit_profile.php" class="portfolio-like"><i class="ion-ios-person"></i></a>
							<time> Email: <?php echo $row["email"]; ?></time>
							<a href="" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="edit_profile.php">
								<div class="portfolio-item-title">
									<div class="meta-categories"></div><!-- portfolio categories -->
									Name<h3><?php echo $row["name"]; ?></h3> 
									Phone<h3><?php echo $row["phone"]; ?></h3>
									Address<h3><?php echo $row["address"]; ?></h3>
									State<h3><?php echo $row["state"]; ?></h3><!-- portfolio title -->
								</div>
								<figure class="portfolio-img"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->
					<div class="span10" style="margin-left:18%;">
					<form method="post" action="#">
        			<input type="text" name="name" placeholder="Enter Name...">
					<input type="email" name="email" placeholder="Enter Email...">
					<input type="tel" name="phone" placeholder="Enter Phone Number...">
					<input type="text" name="address" placeholder="Enter Address...">
					<input type="text" name="state" placeholder="Enter State...">
					<button class="button spec-hover" name="updateProfile" value="submit" style="margin-bottom: 10%;"><span>Update Profile</span></button>
					</form>
				</div>
			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No User found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

public function cart($user)
	{

		?>
<!-- Start Portfolio Section -->
			<section id="" class="section">
				<div class="row">
						<div class="span4">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h3 data-scrolled-into-view>Shopping Cart</h3>
								</div>
							</div>
						</div>
					</div>
				<div class="">
					<table class="table table-bordered table-responsive">
						<tr>
							<th>Item ID</th>
							<th>Description</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Action</th>
						</tr><!-- start portfolio container -->
		<?php
		try
		{
			$total_price="";
		$stmt = $this->conn->prepare("SELECT * from cart WHERE user_id='$user' AND status='unconfirmed'");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			$total = ($row["price"] * $row["quantity"]);
			?>
					<tr>
							<td><?php echo $row["item_id"];?></td>
							<td><?php echo $row["name"];?></td>
							<td><?php echo $row["price"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td><?php echo $total;
								$total_price += $total;
							?></td>
							<td><a href="#<?php echo $row["id"];?>" data-toggle="modal" data-target="#<?php echo $row["id"];?>">Edit</a><br>
								<a href="cart.php?cart_id=<?php echo $row["id"]; ?>&delete=delete">Delete</a> </td>
						</tr>


		<div id="<?php echo $row["id"];?>" class="modal fade" role="dialog" style="">
  		<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ff6f00; padding: 15px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cart Update</h4>
      </div>
      <div class="modal-body" style="background-color: black;">
        <form method="post" action="#">
        			<?php echo $row["name"];?>
        			<input type="hidden" name="id" value="<?php echo $row["id"];?>">
        			<input type="number" name="quantity" value="<?php echo $row["quantity"];?>">
					<button class="button spec-hover" name="cartUpdate" value="submit" style="margin-bottom: 10%;"><span>Update Cart</span></button>
					</form>
      </div>
    </div>
  </div>
</div>
			<?php


		}  


		?>
			<tr>
				<th colspan="4" align="right">
					TOTAL
				</th>
				<td><h2><?php echo "N".$total_price; ?></h2> </td>
				<td><a href="cart.php?order=order_created&total=<?php echo $total_price; ?>" class="button spec-hover"><span>Place Order</span></a> </td>
			</tr>

		<?php
	}
		else{
			?>
			<tr><td colspan="6">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">Cart is Empty....</h2>
                      
                    </td></tr>
			<?php
		}
		?>
		</table>
	</div>
</section>
<?php
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}



public function orders($user)
	{

		?>
<!-- Start Portfolio Section -->
			<section id="" class="section">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view>My Orders</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="">
					<table class="table table-bordered table-responsive">
						<tr>
							<th>Order Date</th>
							<th>Order ID</th>
							<th>Description</th>
							<th>Price/unit</th>
							<th>Quantity</th>
							<th>Order Total</th>
							<th>Status</th>
							<th>Action</th>
						</tr><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from myorder WHERE user_email='$user' AND (status='processing' OR status='confirmed')");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			$total = ($row["price"] * $row["quantity"]);
			?>
					<tr>
							<td><?php echo $row["order_date"];?></td>
							<td><?php echo $row["order_id"];?></td>
							<td><?php echo $row["name"];?></td>
							<td><?php echo $row["price"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td><?php echo $row["total_price"];?></td>
							<td><?php echo $row["status"];?></td>
							<td>
								<a href="my_orders.php?order_id=<?php echo $row["order_id"]; ?>&orderdelete=delete">Delete</a> </td>
						</tr>

			<?php


		}  
	}
		else{
			?>
			<tr><td colspan="8">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Orders found....</h2>
                      
          </td></tr>
			<?php
		}
		?>
		</table>
	</div>
</section>
<?php
}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}



public function orderItems($order_id, $user_id, $email, $phone, $total)
	{
		try
		{
		$stmta = $this->conn->prepare("SELECT * from cart WHERE user_id='$user_id' AND status='unconfirmed'");
		$stmta->execute();
		$userRow=$stmta->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			$cart_id = $row["id"];
			$name = $row["name"];
			$price = $row["price"];
			$quantity = $row["quantity"];
			$status = "processing";
			$order_date = date("d/m/Y");
			$stmt = $this->conn->prepare("INSERT INTO myorder(order_id,cart_id,user_email,quantity, status, name, price, order_date,user_phone, total_price) 
		                                               VALUES(:pid, :cart_id, :umail, :quantity,:status, :name, :price, :uregister, :phone, :total)");
			
			$stmt->bindparam(":pid", $order_id);									  
			$stmt->bindparam(":cart_id", $cart_id);
			$stmt->bindparam(":umail", $email);
			$stmt->bindparam(":quantity", $quantity);
			$stmt->bindparam(":uregister", $order_date);
			$stmt->bindparam(":phone", $phone);
			$stmt->bindparam(":total", $total);	
			$stmt->bindparam(":status", $status);
			$stmt->bindparam(":name", $name);
			$stmt->bindparam(":price", $price);								  
				
			$stmt->execute();	
			
			if($stmt){
				$stmte = $this->conn->prepare("DELETE FROM cart WHERE id='$cart_id'");
				$res = $stmte->execute(); 
			}

		}
		return true;  
	}
		else{
			return false;
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function featItem()
	{

		?>
<!-- Start Portfolio Section -->
			<section id="fs" class="section" style="margin-top:-10%;">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view align="center">Featured Shop</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items WHERE featured ='1' ORDER BY id DESC LIMIT 9");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="index.php#fs?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class=""><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->

			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function newItem()
	{

		?>
<!-- Start Portfolio Section -->
			<section id="na" class="section">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view align="center">New Arrivals</h2>
								</div>
							</div>
						</div>
					</div>
				<!-- start portfolio container -->
				<div class="row portfolio-container five-per-row" data-scrolled-into-view>
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items ORDER BY id DESC LIMIT 9");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			
			<tr>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="index.php#na?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class=""><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->
				<!--</tr>-->
			
		
			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
		?>
		<?php
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function topItem()
	{

		?>
<!-- Start Portfolio Section -->
			<section id="ts" class="section">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view align="center">Top Shop</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from cart ORDER BY id DESC LIMIT 9");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//echo count($userRow);
		if($userRow!=null){
		foreach( $userRow as $rows )
		{
		$item = $rows['item_id'];
		$stmt = $this->conn->prepare("SELECT * from items WHERE id ='$item'");
		$stmt->execute();
		$userRoww=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRoww!=null){
		foreach( $userRoww as $row )
		{
			?>
			<tr>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="index.php#ts?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class=""><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->

			<?php
		}
	}

		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

public function fivekItem()
	{

		?>
<!-- Start Portfolio Section -->
			<section id="u5s" class="section">
				<div class="row">
						<div class="span6">
							<div class="info-block pad-top-liq">
								<div class="title-block">
									<h2 data-scrolled-into-view align="center">Under 5K Shop</h2>
								</div>
							</div>
						</div>
					</div>
				<div class="row portfolio-container five-per-row" data-scrolled-into-view><!-- start portfolio container -->
		<?php
		try
		{
		$stmt = $this->conn->prepare("SELECT * from items WHERE n_price <= 5000 ORDER BY id DESC LIMIT 9");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
				<div class="portfolio-item dark"><!-- start portfolio item -->
						<div class="portfolio-meta"><!-- start portfolio meta -->
							<a href="index.php#u5s?item_id=<?php echo $row["id"]; ?>&name=<?php echo $row["name"]; ?>&price=<?php echo $row["n_price"]; ?>" class="portfolio-like"><i class="ion-ios-cart" alt="Add to Cart"></i></a>
							<time> N<?php echo $row["n_price"]; ?>  &nbsp; <s><?php if ($row["o_price"]!= ""){ echo "N".$row["o_price"];} ?></s></time>
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>" class="portfolio-item-more"><i class="ion-ios-arrow-right"></i></a>
						</div><!-- end portfolio meta -->
						<header class="portfolio-header"><!-- start portfolio header -->
							<a href="view_item.php?item_id=<?php echo $row["id"]; ?>">
								<div class="portfolio-item-title">
									<div class="meta-categories"><?php echo $row["category"]; ?></div><!-- portfolio categories -->
									<h3><?php echo $row["name"]; ?></h3> <!-- portfolio title -->
								</div>
								<figure class=""><img src="<?php echo $row["image1"]; ?>" alt="<?php echo $row["name"]; ?>" class="featured-image"></figure><!-- portfolio featured image -->
							</a>
						</header><!-- end portfolio header -->
					</div><!-- end portfolio item -->

			<?php


		}
	}
		else{
			?>
			<div class="span12">
                      <h2 data-scrolled-into-view style="text-align:center;color:black;">No Items found....</h2>
                      
                    </div>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}





	public function viewCentres()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from message");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
                      <td><?php echo $row["date"];    ?></td>
                      <td><?php echo $row["name"];    ?></td>
                      <td><?php echo $row["email"];    ?></td>
                      <td><?php echo $row["phone"];    ?></td>
                      <td><?php echo $row["user_id"];    ?></td>
                      <td><?php echo $row["reason"];    ?></td>
                      <td><?php echo $row["comment"];    ?></td>
                      </form>
                      </td>
                    </tr>

			<?php
		


		}
	}
		else{
			?>
			<tr>
                      <td colspan='7'>No Records found....</td>
                      
                    </tr>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function viewBooking()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from loan");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			$time = ($row["start_time"])/3600;
			?>
			<tr>
                      <td><?php echo $row["date"];    ?></td>
                      <td><?php echo $row["user_id"];    ?></td>
                      <td><?php echo $row["account"];    ?></td>
                      <td><?php echo $row["amount"];    ?></td>
                      <td><?php echo $row["status"];    ?></td>
                      </td>
                    </tr>

			<?php
		}
	}
		else{
			?>
			<tr>
                      <td colspan='5'>No Records found....</td>
                      
                    </tr>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


	public function updateRole($userid, $upass, $urole)
	{
		$pass= md5($upass);
		$stmt = $this->conn->prepare("UPDATE users SET user_pass='$pass', user_role='$urole', tokenCode='1', role_status='1' WHERE user_id='$userid'");
		$res = $stmt->execute(); 
		return $res;
	}

	public function updatePass($uname, $umail, $upass)
	{
		$stmt = $this->conn->prepare("UPDATE user SET password='$upass' WHERE name='$uname' AND email='$umail'");
		$res = $stmt->execute(); 
		return $res;
	}


	public function updateCart($id, $quantity)
	{
		$stmt = $this->conn->prepare("UPDATE cart SET quantity='$quantity' WHERE id='$id'");
		$res = $stmt->execute(); 
		return $res;
	}
	
	public function updateProfile($user, $name, $email, $phone, $address, $state)
	{
		$stmt = $this->conn->prepare("UPDATE user SET name ='$name',email='$email',phone='$phone',address='$address', state='$state' WHERE id='$user'");
		$res = $stmt->execute();
		return $res;
	}

	public function updateCentre($centre)
	{
		$stt = $this->conn->prepare("SELECT * from ecentre WHERE eid= :centre");
		$stt->execute(array(':centre'=>$centre));

		$userRow=$stt->fetch(PDO::FETCH_ASSOC);
		if($stt->rowCount() >= 1){
			if ($userRow["centre_status"] =="active"){
				$status = "inactive";

			}
			else{

				$status = "active";
			}

		$stmt = $this->conn->prepare("UPDATE ecentre SET centre_status='$status' WHERE eid='$centre'");
		$res = $stmt->execute(); 
		return $res;
	}
	else{
		return false;
	}
	}


	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function deleteItem($id)
	{
		$stmt = $this->conn->prepare("DELETE FROM cart WHERE id='$id'");
		$res = $stmt->execute();
		return $res;
	}

	public function deleteorder($id)
	{
		$stmt = $this->conn->prepare("UPDATE myorder SET status='archived' WHERE id='$id'");
		$res = $stmt->execute();
		return $res;
	}
	
	public function update($table,$user_id, $uname, $ucountry, $ustate, $ufirstname, $ulastname)
	{
		$res = mysql_query("UPDATE $table SET user_name='$uname', user_first='$ufirstname', user_lastname='$ulastname', user_state='$ustate'user_country='$ucountry' WHERE user_id='$user_id'");
		return $res;
	}
	
	static public function buildMessageXml($recipient, $message) {
      $xml = new SimpleXMLElement('<MESSAGES/>');

      $authentication = $xml->addChild('AUTHENTICATION');
      $authentication->addChild('PRODUCTTOKEN', 'bfb11e0e-3242-419b-9ab5-dd2a0ff77c9d');

      $msg = $xml->addChild('MSG');
      $msg->addChild('FROM', 'NIMCEnrol');
      $msg->addChild('TO', $recipient);
      $msg->addChild('BODY', $message);

      return $xml->asXML();
    }

     public function sendMessage($recipient, $message) {
      $xml = this :: buildMessageXml($recipient, $message);

      $ch = curl_init();
      curl_setopt_array($ch, array(
          CURLOPT_URL            => 'https://sgw01.cm.nl/gateway.ashx',
          CURLOPT_HTTPHEADER     => array('Content-Type: application/xml'),
          CURLOPT_POST           => true,
          CURLOPT_POSTFIELDS     => $xml,
          CURLOPT_RETURNTRANSFER => true
        )
      );

      $response = curl_exec($ch);

      curl_close($ch);
      return $response;
    }
}
?>