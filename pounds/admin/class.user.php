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
	
	public function addItem($name,$n_price, $o_price, $category, $tag, $description, $featured, $image1, $image2, $image3)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO items(name, n_price, o_price, category, tag, description, featured, image1, image2, image3) VALUES(:uname, :n_price, :o_price, :category, :tag, :description, :featured, :image1, :image2, :image3)");
												  
			$stmt->bindparam(":uname", $name);
			$stmt->bindparam(":n_price", $n_price);
			$stmt->bindparam(":o_price", $o_price);
			$stmt->bindparam(":category", $category);
			$stmt->bindparam(":tag", $tag);
			$stmt->bindparam(":description", $description);
			$stmt->bindparam(":featured", $featured);
			$stmt->bindparam(":image1", $image1);
			$stmt->bindparam(":image2", $image2);
			$stmt->bindparam(":image3", $image3);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname,$umail,$upass)
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
					if ($userRow['role'] == "admin" ){
					$_SESSION['user_email'] = $userRow['email'];
					$_SESSION['user_session'] = $userRow['id'];
					$_SESSION['user_role'] = $userRow['role'];
					$_SESSION['user_name'] = $userRow['name'];
					return true;
				}
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
		$stmt = $this->conn->prepare("SELECT * from items");
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
		$stmt = $this->conn->prepare("SELECT * from myorder");
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
		$stmt = $this->conn->prepare("SELECT * from items");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
                      <td><?php echo $row["id"];    ?></td>
                      <td><?php echo $row["name"];    ?></td>
                      <td><?php echo $row["n_price"];    ?></td>
                      <td><?php echo $row["o_price"];    ?></td>
                      <td><?php echo $row["category"];    ?></td>
                      <td><?php echo $row["tag"];    ?></td>
                      <td><?php echo $row["description"];    ?></td>
                      <td><?php echo $row["featured"];    ?></td>
                      <td><img src="../<?php echo $row["image1"]; ?>" width="100px" height="100px"></td>
                      <td><img src="../<?php echo $row["image2"]; ?>" width="100px" height="100px"></td>
                      <td><img src="../<?php echo $row["image3"]; ?>" width="100px" height="100px"></td>
                      <td><a href="deleteitem.php?itemid=<?php echo $row["id"]; ?>" onclick="var r = confirm("Delete this item?"); if (r == true) {continue;} else {exit;}"">Delete</a></td>

                    </tr>

			<?php
		

		}
	}
		else{
			?>
			<tr>
                      <td colspan='11'>No Records found....</td>
                      
                    </tr>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}


public function viewUsers()
	{
		try
		{
		$stmt = $this->conn->prepare("SELECT * from user");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			?>
			<tr>
                      <td><?php echo $row["id"];    ?></td>
                      <td><?php echo $row["name"];    ?></td>
                      <td><?php echo $row["email"];    ?></td>
                      <td><?php echo $row["gender"];    ?></td>
                      <td><?php echo $row["role"];    ?></td>
                      <td><?php echo $row["phone"];    ?></td>
                      <td><?php echo $row["reg_date"];    ?></td>
                      <td><?php echo $row["address"];    ?></td>
                      <td><?php echo $row["state"];    ?></td>
                      <!-- <td><a class="" href="edituser.php?userid=<?php echo $row["user_id"]; ?>&name=<?php echo $row["name"]; ?>&email=<?php echo $row["email"]; ?>&phone=<?php echo $row["phone"]; ?>&accounttype=<?php echo $row["account_type"]; ?>&account_sel=<?php echo $row["account_selection"]; ?>&card=<?php echo $row["card_number"]; ?>&amount=<?php echo $row["amount"]; ?>">Edit User</a></td>
                      <td><a class="" href="changeuser.php?userid=<?php echo $row["user_id"]; ?>">Change Password</a></td> --> 

                      <td><a class="" href="deleteuser.php?userid=<?php echo $row["id"]; ?>" onclick="var r = confirm("Delete this user?"); if (r == true) {continue;} else {exit;}">Delete</a></td> 
                      </form>
                      </td>
                    </tr>

			<?php


		}
	}
		else{
			?>
			<tr>
                      <td colspan='13'>No Records found....</td>
                      
                    </tr>
			<?php
		}
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}
	
	public function delUsers($user_id)
	{
		try
		{
		$stmt = $this->conn->prepare("DELETE from user where id = '$user_id'");
		$res = $stmt->execute();
		
		return $res;
	
	}
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}
	
	public function delItems($item_id)
	{
		try
		{
		$stmt = $this->conn->prepare("DELETE from items where id = '$item_id'");
		$res = $stmt->execute();
		
		return $res;
	
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
                      <td><?php echo $row["sent_date"];    ?></td>
                      <td><?php echo $row["name"];    ?></td>
                      <td><?php echo $row["email"];    ?></td>

                      <td><?php echo $row["message"];    ?></td>
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
		$stmt = $this->conn->prepare("SELECT * from myorder ORDER BY order_date DESC");
		$stmt->execute();
		$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($userRow!=null){
		foreach( $userRow as $row )
		{
			$time = ($row["start_time"])/3600;
			?>
			<tr>
                      <td><?php echo $row["order_date"];    ?></td>
                      <td><?php echo $row["order_id"];    ?></td>
                      <td><?php echo $row["cart_id"];    ?></td>
                      <td><?php echo $row["user_email"];    ?></td>
                      <td><?php echo $row["user_phone"];    ?></td>
                      <td><?php echo $row["name"];    ?></td>
                      <td><?php echo $row["quantity"];    ?></td>
                      <td><?php echo $row["price"];    ?></td>
                      <td><?php echo $row["total_price"];    ?></td>
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
	
	public function updateUser($user_id, $name, $email, $account_type, $account_sel, $amount, $phone, $card)
	{
		$stmt = $this->conn->prepare("UPDATE user SET name ='$name',email='$email',account_type='$account_type',account_selection='$account_sel', amount='$amount', phone='$phone', card_number='$card' WHERE user_id='$user_id'");
		$res = $stmt->execute();
		return $res;
	}
	
	public function changeUser($user_id, $password)
	{
		$stmt = $this->conn->prepare("UPDATE user SET password ='$password' WHERE user_id='$user_id'");
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

	public function delete($table,$id)
	{
		$res = mysql_query("DELETE FROM $table WHERE user_id=".$id);
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