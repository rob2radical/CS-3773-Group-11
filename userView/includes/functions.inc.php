<?php

function emptyInputHotel($hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff, $numAmenities) {
	//$result;
	//if (empty($hotelname) || empty($numRoomS) || empty($numRoomQ) || empty($numRoomK) || empty($standardPrice) || empty($queenPrice) || empty($kingPrice) || empty($weekendDiff) || empty($numAmenities))
	if (empty($hotelname)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

//Check if hotel name is a valid one
function invalidHotelName($hotelname) {
	//$result;
	if (!preg_match("/^[a-zA-Z0-9\s]*$/", $hotelname)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid Integers (numberOfRooms) 
function invalidNumberInt($numRoom) { 
	//$result;
	if(!preg_match("/^[0-9]*$/", $numRoom)) { 
		$result = true;
	} 
	else { 
		$result = false;
	}
	return $result;
}

// Check for valid Float (prices and decimals)
function invalidNumberFloat($price) { 
	//$result;
	if(!preg_match("/^\d*\.?\d*$/", $price) ) {
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

function hotelExists($conn, $hotelname) {
	$sql = "SELECT * FROM hotels WHERE hotelName = ?;";
	  $stmt = mysqli_stmt_init($conn);
	  if (!mysqli_stmt_prepare($stmt, $sql)) {
		   header("location: ../createHotel.php?error=stmtfailed");
		  exit();
	  }
  
	  mysqli_stmt_bind_param($stmt, "s", $hotelname);
	  mysqli_stmt_execute($stmt);
  
	  // "Get result" returns the results from a prepared statement
	  $resultData = mysqli_stmt_get_result($stmt);
  
	  if ($row = mysqli_fetch_assoc($resultData)) {
		$result = true;
		return $result;
	  }
	  else {
		$result = false;
		return $result;
	  }
  
	  mysqli_stmt_close($stmt);
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

function phoneExists($conn, $phone) { 
	$sql = "SELECT * FROM users WHERE usersPhone = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) 
	{ 
		header("location: ../userSignUp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $phone);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData)) { 
		return $row;
	}
	else { 
		$result = false;
		return $result;
	} 
	mysqli_stmt_close($stmt);
}

function emailExists($conn, $email) { 
	$sql = "SELECT * FROM users WHERE usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) 
	{ 
		header("location: ../userSignUp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData)) { 
		return $row;
	}
	else { 
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

// Insert new hotel into database
function createHotelq($conn, $hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff, $numAmenities) {
	$sql = "INSERT INTO hotels (hotelName, numRoomS, numRoomQ, numRoomK, standardPrice, queenPrice, kingPrice, weekendDiff) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
  
	if(intval($numRoomQ) == 0)
	{
		$numRoomQ = NULL;
		$queenPrice = NULL;
	}
	if(intval($numRoomK) == 0)
	{
		$numRoomK = NULL;
		$kingPrice = NULL;
	}
	  $stmt = mysqli_stmt_init($conn);
	  if (!mysqli_stmt_prepare($stmt, $sql)) {
		   header("location: ../createHotel.php?error=stmtfailed");
		  exit();
	  }
  
	  mysqli_stmt_bind_param($stmt, "ssssssss", $hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff);
	  mysqli_stmt_execute($stmt);
	  mysqli_stmt_close($stmt);
	  mysqli_close($conn);
	  header("location: ../createHotel.php?error=none&hotelname=$hotelname&numAmenities=$numAmenities");
	  exit();
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
function updateUser($conn, $name, $email, $phone, $username, $userId, $role)
{
		$sql = "SELECT * FROM users WHERE usersId = ?"; 
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			if($role == 1)
			{
				header("location: ../adminProfile.php?error=stmtfailed");
			}
			else
			{
				header("location: ../profile.php?error=stmtfailed");
			}
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
			if($role == 1)
			{
				header("location: ../adminProfile.php?error=updateerror");
			}
			else
			{
				header("location: ../profile.php?error=updateerror");
			}
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
			if($role == 1)
			{
				header("location: ../adminProfile.php?error=stmtfailed");
			}
			else
			{
				header("location: ../profile.php?error=stmtfailed"); 
			}
			exit(); 
		} 
		mysqli_stmt_bind_param($updateStmt, "sssss",$nameChange, $emailChange, $phoneChange, $usernameChange, $userId); 
		mysqli_stmt_execute($updateStmt);
		if($role == 1)
		{
			header("location: ../adminProfile.php?error=none");
		}
		else
		{
			header("location: ../profile.php?error=none");
		}
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

function createAmenity($conn, $hotelID, $hotelname, $amenity){
	$sql = "INSERT INTO amenities (hotelId, hotelName, amenity) VALUES (?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../createHotel.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "sss", $hotelID, $hotelname, $amenity);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	//header("location: ../userSignUp.php?error=none");
	//exit();
}

function amenityExists($conn, $amenity, $hotelID){
	$sql = "SELECT * FROM amenities WHERE hotelId = ? AND amenity = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../createHotel.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $hotelID, $amenity);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
	  $result = true;
	  return $result;
	}
	else {
	  $result = false;
	  return $result;
	}

	mysqli_stmt_close($stmt);
}

function deleteHotel($conn, $hotelName)
{
	$sql = "DELETE FROM hotels WHERE hotelName = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../modProp.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $hotelName);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);
}

function deleteAmenities($conn, $hotelName)
{
	$sql = "DELETE FROM amenities WHERE hotelName = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../modProp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $hotelName);
	mysqli_stmt_execute($stmt);
	header("location: ../modifyHotel.php?success=delete");
	mysqli_stmt_close($stmt);
}

function updateHotel($conn, $hotelname, $newHName, $hnumRoomS, $hnumRoomQ, $hnumRoomK, $hstandardPrice, $hqueenPrice, $hkingPrice, $hweekendDiff){
	
	$sql = "SELECT * FROM hotels WHERE hotelName = ?"; 
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../modProp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $hotelname);
	mysqli_stmt_execute($stmt);
	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($resultData);
	mysqli_stmt_close($stmt); 

	if(empty($newHName) && empty($hnumRoomS) && empty($hnumRoomQ) && empty($hnumRoomK) && empty($hstandardPrice) && empty($hqueenPrice) && empty($hkingPrice) && empty($hweekendDiff)) 
	{ 
		//$result = false;
		header("location: ../modProp.php?error=updateerror");
		//return $result;
	}

	$hotelID = $row["hotelId"];
	//name
	if(!empty($newHName) && $newHName != $row["hotelName"]) 
	{ 
		$nameChange = $newHName;
	} 
	else
	{
		$nameChange = $row["hotelName"];
	}

	if( !empty($hnumRoomS) &&  $hnumRoomS != $row["numRoomS"]) 
	{ 
		$numSChange = $hnumRoomS;
	} 
	else
	{	
		$numSChange = $row["numRoomS"];
	}

	//QUEEN ROOM CHECK IF EMPTY OR NUMERIC(0) AND NOT THE SAME AS CURRENT VALUE
	if( (!empty($hnumRoomQ) || is_numeric($hnumRoomQ)) &&  $hnumRoomQ != $row["numRoomQ"]) 
	{ 
		if($hnumRoomQ > 0)
		{
			$numQChange = $hnumRoomQ;
		}
		else
		{
			$numQChange = NULL;
		}
	} 
	else
	{	
		$numQChange = $row["numRoomQ"];
	}

	if( (!empty($hnumRoomK) || is_numeric($hnumRoomK)) &&  $hnumRoomK != $row["numRoomK"]) 
	{ 
		if($hnumRoomK > 0)
		{
			$numKChange = $hnumRoomK;
		}
		else
		{
			$numKChange = NULL;
		}
	} 
	else
	{	
		$numKChange = $row["numRoomK"];
	}

	if(!empty($hstandardPrice) && $hstandardPrice != $row["standardPrice"]) 
	{ 
		$priceSChange = $hstandardPrice;
	} 
	else
	{	
		$priceSChange = $row["standardPrice"];
	}

	if($numQChange == NULL) 
	{ 
		$priceQChange = NULL;
	} 
	else if(!empty($hqueenPrice) && $hqueenPrice != $row["queenPrice"])
	{
		$priceQChange = $hqueenPrice;
	}
	else
	{
		$priceQChange = $row["queenPrice"];
	}

	if($numKChange == NULL) 
	{ 
		$priceKChange = NULL;
	} 
	else if(!empty($hkingPrice) && $hkingPrice != $row["kingPrice"]) 
	{ 
		$priceKChange = $hkingPrice;
	} 
	else
	{	
		$priceKChange = $row["kingPrice"];
	}

	if(!empty($hweekendDiff) && $hweekendDiff != $row["weekendDiff"]) 
	{ 
		$diffChange = $hweekendDiff;
	} 
	else
	{
		$diffChange = $row["weekendDiff"];
	}

	$sqlUpdate = "UPDATE hotels SET hotelName = ?, numRoomS = ?, numRoomQ = ?, numRoomK = ?, standardPrice = ?, queenPrice = ?, kingPrice = ?, weekendDiff = ? WHERE hotelId = ?"; 
	$updateStmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($updateStmt, $sqlUpdate)) {
		header("location: ../modProp.php?error=stmtfailed"); 
		exit(); 
	} 
	mysqli_stmt_bind_param($updateStmt, "sssssssss", $nameChange, $numSChange, $numQChange, $numKChange, $priceSChange, $priceQChange, $priceKChange, $diffChange, $hotelID); 
	mysqli_stmt_execute($updateStmt);

	//header("location: ../modProp.php?error=none");
	mysqli_stmt_close($updateStmt);
	//return $result;
	
}

function updateAmenitiesForHotel($conn, $hotelname, $newHName, $hotelID){
	$sqlUpdate = "UPDATE amenities SET hotelName = ? WHERE hotelName = ?"; 
	$updateStmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($updateStmt, $sqlUpdate)) {
		header("location: ../modProp.php?error=stmtfailed"); 
		exit(); 
	} 
	mysqli_stmt_bind_param($updateStmt, "ss", $newHName, $hotelname); 
	mysqli_stmt_execute($updateStmt); 
	header("location: ../modProp.php?error=none&id=$hotelID");
	mysqli_stmt_close($updateStmt);
}