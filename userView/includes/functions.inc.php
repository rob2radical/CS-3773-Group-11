<?php

function emptyInputHotel($hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff, $numAmenities) {
	//$result;
	if (empty($hotelname) || empty($numRoomS) || empty($numRoomQ) || empty($numRoomK) || empty($standardPrice) || empty($queenPrice) || empty($kingPrice) || empty($weekendDiff) || empty($numAmenities)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check for empty input signup
function emptyInputSignup($name, $email, $phone, $username, $pwd, $pwdRepeat) {
	//$result;
	if (empty($name) || empty($email) || empty($phone) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username) {
	//$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	//$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
} 

// Check invalid phone 
function invalidPhone($phone) { 
	//$result;
	if(!filter_var($phone, FILTER_VALIDATE_INT)) { 
		$result = true;
	} 
	else { 
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	//$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../userSignUp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $name, $email, $phone, $username, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersPhone, usersUid, usersPwd) VALUES (?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../userSignUp.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $username, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../userSignUp.php?error=none");
	exit();
}

// Update new user in the existing database
function updateUser($conn, $name, $email, $phone, $username, $userId)
{
		#$userId = $_SESSION["userid"];
		$sql = "SELECT * FROM users WHERE usersId = ?"; 
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			 header("location: ../profile.php?error=stmtfailed");
			exit();
		}
	
		mysqli_stmt_bind_param($stmt, "s", $userId);
		mysqli_stmt_execute($stmt);
		// "Get result" returns the results from a prepared statement
		$resultData = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($resultData);
		mysqli_stmt_close($stmt); 

		if(empty($name) && empty($email) && empty($phone) && empty($username)) 
		{ 
			$result = false;
			header("location: ../profile.php?error=updateerror");
			return $result;
		}
	
		//name
		if(!empty($name) && $name != $row["usersName"]) 
		{ 
			$nameChange = $name;
			$result = true;
		} 
		else
		{	//echo "is not set"; 
			$nameChange = $row["usersName"];
			$result = false;
		}

		//email
		if(!empty($email) && $email != $row["usersEmail"]) 
		{ 
			$emailChange = $email;
			$result = true;
		} 
		else
		{	//echo "is not set"; 
			$emailChange = $row["usersEmail"];
			$result = false;
		}

		//phone number
		if(!empty($phone) && $phone != $row["usersPhone"]) 
		{ 
			$phoneChange = $phone;
			$result = true;
		} 
		else
		{	//echo "is not set"; 
			$phoneChange = $row["usersPhone"];
			$result = false;
		}

		//username
		if(!empty($username) && $username != $row["usersUid"]) 
		{ 
			$usernameChange = $username;
			$result = true;
		} 
		else
		{	//echo "is not set"; 
			$usernameChange = $row["usersUid"];
			$result = false;
		}
	
		$sqlUpdate = "UPDATE users SET usersName = ?, usersEmail = ?, usersPhone = ?, usersUid = ? WHERE usersId = ?"; 
		$updateStmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($updateStmt, $sqlUpdate)) {
			header("location: ../profile.php?error=stmtfailed"); 
			exit(); 
		} 
		mysqli_stmt_bind_param($updateStmt, "sssss",$nameChange, $emailChange, $phoneChange, $usernameChange, $userId); 
		mysqli_stmt_execute($updateStmt);
		header("location: ../profile.php?error=none");
		mysqli_stmt_close($updateStmt);
		return $result;
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	//$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../userLogin.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../userLogin.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		$_SESSION["usersname"] = $uidExists["usersName"];
		$_SESSION["usersemail"] = $uidExists["usersEmail"];
		$_SESSION["usersphone"] = $uidExists["usersPhone"];
		$_SESSION["isAdmin"] = $uidExists["isAdmin"];
		header("location: ../index.php?error=none");
		exit();
	}
}
