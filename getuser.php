<?php
include("pdoconnect.php");
// check for POST data
if ($_GET['username']&&$_GET['password']) {
   $username=$_GET['username'];
	$password=md5($_GET['password']);
	
$statement =$pdo->prepare("SELECT * FROM user where username='$username' and password='$password'");
  $statement->execute(); 
     $row=$statement->fetch(PDO::FETCH_ASSOC); 
	 //$response["users"]=array();
    if (!empty($row)) {
           // $admin = array();
            $response["users"]["userid"]   = $row["user_id"];
			$response["users"]["username"] = $row["username"];
           $response["users"]["sname"] = $row["surname"];
		   $response["users"]["email"] = $row["email"];
		   $response["users"]["photo"] = $row["photo"];
		   $response["users"]["gender"] = $row["gender"];
           $response["users"]["mobile"] = $row["phonenumber"];
           $response["users"]["status"] = $row["status"];
		   $response["users"]["subscribers"] = $row["count_subscribers"];
		    $response["users"]["phonenumber"] = $row["phonenumber"];
                    // success
            $response["success"] = 1;

         

         //   array_push($response["users"], $admin);

            // echoing JSON response
            echo json_encode($response);
        } else {
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
