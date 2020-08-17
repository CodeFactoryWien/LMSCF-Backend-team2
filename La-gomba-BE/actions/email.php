<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['desc'])) {
	$name = @trim(stripslashes($_POST['name'])); 
 	$email = @trim(stripslashes($_POST['email']));
 	$desc = @trim(stripslashes($_POST['desc']));
 	$subject = "Contact Nora:\n\n";

    $email_from = $email;
    $email_to = 'asaraseli@gmail.com';

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email. "\n\n" . 'Subject: ' . $subject . 'Data: ' . $desc;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');
    echo 'Message send to '. $email_to;
}
else{
    echo 'Message did not send';
}
?>