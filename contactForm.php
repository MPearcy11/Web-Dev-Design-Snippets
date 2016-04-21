<?php

// CONTACT FORM FROM W3C SCHOOLS EXAMPLE, TWEAKED FOR BA SITE. ALSO USES BOOTSTRAP CLASSES

// define variables and set to empty values
$nameErr = $emailErr = $subjectErr = "";
$name = $agency = $email = $subject = $body = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["agency"])) {
     $agency = "";
   } else {
	$agency = test_input($_POST["agency"]);
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
   
   if (empty($_POST["subject"])) {
     $subjectErr = "Subject is required";
   } else {
     $subject = test_input($_POST["subject"]);
     // check if subject only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$subject)) {
       $subjectErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["body"])) {
     $body = "";
   } else {
     $body = test_input($_POST["body"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<section id="contactHead">
	<h1 class="alignCenter">We Would Love to Work With You!</h1>
	<form class="contactForm container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input class="col-xs-12 col-sm-6" type="text" name="name" placeholder="Name (required)" value="<?php echo $name;?>"/>
		   	<span><?php echo $nameErr;?></span>
		<input class="col-xs-12 col-sm-6" type="text" name="agency" placeholder="Agency" value="<?php echo $agency;?>"/><br>
		<input class="col-xs-12" type="email" name="email" placeholder="Your Email Address (required)" value="<?php echo $email;?>"/>
		   	<span><?php echo $emailErr;?></span><br>
		<input class="col-xs-12" type="text" name="subject" placeholder="Subject (required)" value="<?php echo $subject;?>"/>
			<span><?php echo $subjectErr;?></span><br>
		<textarea class="col-xs-12" name="body" rows="5" placeholder="Tell us how we can help!" wrap="hard" value="<?php echo $body;?>"></textarea>
		
		<input type="submit" name="submit" value="Submit"/>
	</form>
	
<?php
$body = wordwrap($body,70);
if($agency != ""){
	$subjectLine = $name." - ".$agency." - ".$subject;
}
else{
	$subjectLine = $name." - ".$subject;
}
$headers = $email . "\r\n" .
mail("Brockallencasting@gmail.com",$subjectLine,$body,$headers);
?>
</section>