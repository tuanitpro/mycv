<?php 
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

        $msg= urlencode('Bạn có một tin nhắn mới - MyCV '.$name);
        
        $url = 'https://bot.tuanitpro.com/api/v1/send?text='.$msg;
      
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL =>$url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

// Create the email and send the message
$to = 'tuanitpro@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "[MyCV] Contact Form:  $name";
$email_body = "Có một tin nhắn mới.<br/>"."Name: $name<br/><br/>Email: $email_address<br/><br/>Phone: $phone<br/><br/>Message:<br/>$message";
$headers = "From: tuanitpro@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
//mail($to,$email_subject,$email_body,$headers);
// return true;			
date_default_timezone_set('Etc/UTC');


require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "tuanitpro@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "";

//Set who the message is to be sent from
$mail->setFrom('tuanitpro@gmail.com', 'Le Thanh Tuan');

//Set an alternative reply-to address
$mail->addReplyTo('tuanitpro@gmail.com', 'Le Thanh Tuan');

//Set who the message is to be sent to
$mail->addAddress('tuanitpro@gmail.com', 'Le Thanh Tuan');

//Set the subject line
$mail->Subject = $email_subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($email_body);

//Replace the plain text body with one created manually
$mail->AltBody = $email_body;

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}