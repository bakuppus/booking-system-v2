<?php

session_start();
include('database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = 0;
    $company_name = $_POST['company_name'];
    $venue_type = $_POST['venue_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(isset($_POST['email'])) {
    	$email = $_POST['email'];	
    } else {
    	$email = null;
    }
    
    $address_one = $_POST['address_one'];
    
    if(isset($_POST['address_two'])) {
    	$address_two = $_POST['address_two'];
    } else {
    	$address_two = null;
    }
    
    $country = $_POST['country'];
    $city = $_POST['city'];
    $post_code = $_POST['post_code'];
   	
   	if(isset($_POST['booking_available'])) {
   		$booking_available = 1;
   	} else {
   		$booking_available = 0;
   	}

    $description = $_POST['description'];

    $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";
    
    if($conn->query($sql)) {

    	$sql = "SELECT max(id) as user_id from users";
	    $result = $conn->query($sql);
	    $row = $result->fetch_assoc();
	    $user_id = $row['user_id'];
	    $_SESSION["user"] = $user_id;

	    $sql = "INSERT INTO pubs(user_id, company_name, venue_type, address_one, address_two, country, city, post_code, description, booking_available) VALUES ('$user_id', '$company_name', '$venue_type', '$address_one', '$address_two', '$country', '$city', '$post_code', '$description', '$booking_available')";

	    if($conn->query($sql)) {

	    	$sql = "SELECT max(id) as pub_id from pubs";
		    $result = $conn->query($sql);
		    $row = $result->fetch_assoc();
		    $pub_id = $row['pub_id'];

		    $countfiles = count($_FILES['image']['name']);
 
			for($i = 0; $i < $countfiles; $i++) {
				
				$filename = $_FILES['image']['name'][$i];
				move_uploaded_file($_FILES['image']['tmp_name'][$i], '../uploads/'.$filename);
				$sql = "INSERT INTO images(pub_id, image) VALUES ('$pub_id', '$filename')";
				$conn->query($sql);
			}

		    $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Mon', '" . $_POST['mon_from'] . "', '" . $_POST['mon_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Tue', '" . $_POST['tue_from'] . "', '" . $_POST['tue_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Wed', '" . $_POST['wed_from'] . "', '" . $_POST['wed_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Thu', '" . $_POST['thu_from'] . "', '" . $_POST['thu_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Fri', '" . $_POST['fri_from'] . "', '" . $_POST['fri_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Sat', '" . $_POST['sat_from'] . "', '" . $_POST['sat_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	        $sql = "INSERT INTO opening_hours(pub_id, day, from_time, to_time) VALUES ('$pub_id', 'Sun', '" . $_POST['sun_from'] . "', '" . $_POST['sun_to'] . "')";
	        if(!$conn->query($sql)) {
	        	$error = 1;
	        }

	    } else {
	    	$error = 1;
	    }

    } else {
    	$error = 1;
    }

    if($error == 0) {
    	echo "<script> alert('Data added successfully.'); </script>";
    	echo "<script> window.location = '../dashboard'; </script>";
    } else {
    	echo "<script> alert('An error has occurred.'); </script>";
    	echo "<script> window.location = '../partner'; </script>";
    }

}