<?php
	if(isset($_POST)){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$nsu_id = $_POST['nsu_id'];
		$address = $_POST['address'];
		$c_number = $_POST['c_number'];
		$gender = $_POST['gender'];

		$sql = "INSERT INTO users (name,email,password,nsu_id,address,c_number,gender) VALUES(?,?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$name,$email,$password,$nsuid,$address,$number,$gender]);
		if ($result){
			echo 'Successful'; }
		else {
			echo 'Not Successful';
			}
	}

	else {
		echo "No Data Found";
	}


?>
