<!DOCTYPE html>

<html>
<head>
<met
<title> Sign up </title>a charset="UTF-8">
<meta name="author" content="Tuan Phan">
</head>


<body>

<?php
require_once'includes/partials/header.php';
?>
<div id="signupForm">
<form id="details" method ='post' >
<h4>First name:<input type="text" name="surname" placeholder="Enter your first name"  required></h4>
<br>
<h4>Surname:<input type="text" name="surname" placeholder="Enter your last name"  required></h4>
<br>
<h4>Email address:<input type="email" name="email address" placeholder="abc@gmail.com" required ></h4>
<h4>Telephone : &nbsp; <input type="tel" id="tel" name="tel" pattern="\d{10}" placeholder="Enter a 10 digits telephone number" required /></h4>
<h4>Your password:<input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" 
type="password" required 
pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
																	if(this.checkValidity()) form.pwd2.pattern = this.value;
"></h4>

<h4>Re-enter password: <input title="Please re-enter the password correctly" type="password" name="pwd2" required ></h4>
<input type="submit" value="Submit">
<input type="reset" value="Reset">

</form>
</div>
<?php
require_once'includes/partials/footer.php';
?>
</body>


</html>