<?php

    $error = '';
    $fullName = '';
    $phoneNumber = '';
    $email = '';
    $pass = '';

function clean_text($string){
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlspecialchars($string);

	return $string ;
}

if(isset($_POST["createAccount"])){
	if(empty($_POST["fullName"]))
	{
		$error .= '<p><label class = "text-danger"> Please Enter your Name</label></p>';
	}else{
		$fullName = clean_text($_POST["fullName"]);

		if(!preg_match("/^[a-zA-Z ]*$/", $fullName)){
			$error .= '<p><label class = "text-danger"> Only letters and white space allowed </label></p>';
		}
	}

	if(empty($_POST["phoneNumber"])){
		$error .= '<p> <label class = "text-danger">Please Enter your Phone Number.</label></p>';
	}else{
		$phoneNumber = $_POST["phoneNumber"];
	}


	if(empty($_POST["email"]))
	{
		$error .= '<p> <label class = "text-danger">Please Enter your Email </label></p>';
	}else{
		$email = clean_text($_POST["email"]);

		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$error .= '<p> <label class = "text-danger">Invalid email format</label></p>';
		}
	}


	if(empty($_POST["pass"])){
		$error .= '<p><label class = "text-danger"> Please Enter your Password</label></p>';
	}
	else{
		$pass = $_POST["pass"];
	}


if($error == ''){
	$file_open = fopen("signUp_data.csv","a");
	$no_of_row = count(file("signUp_data.csv"));

	if($no_of_row > 1){
		$no_of_row = ($no_of_row - 1)+1;
	}

	$from_data = array(
		'sr_no' => $no_of_row,
		'Name' => $fullName ,
		'PhoneNumber'  => $phoneNumber,
		'Email' => $email,
		'Password'  => $pass,
	);

	fputcsv($file_open, $from_data);

	$error = '<p> <label class = "text-danger">Sign Up Successfully</label></p>';

	$fullName = '';
    $phoneNumber = '';
    $email = '';
    $pass = '';
}

}

    
?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">


    <title>Bootstrap</title>
</head>
<body>
	
<div class="signup-form">
<form action="" method ="POST" enctype="multipart/form-data">

<?php echo $error; ?>
	
<h1>Sign Up</h1>
<div>
<input type="text" placeholder="Full Name" name="fullName" class="txtb" value="<?php echo $fullName; ?>">
</div>

<div>
<input type="text" placeholder="Phone Number" name="phoneNumber" class="txtb" value="<?php echo $phoneNumber; ?>">
</div>

<div>
<input type="email" placeholder="Email" name="email" class="txtb" value="<?php echo $email; ?>">
</div>

<div>
<input type="password"  placeholder="Password" name="pass" class="txtb" value="<?php echo $pass; ?>" >
</div>

<div>
<input  type="submit" value="Create Account" name="createAccount" class="signup-btn">
</div>

<div>
<a href="signUp_csv_html_table.html"> Show CSV File. </a>
</div>

</form>
 
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>