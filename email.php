<?php
if($_POST)
{
    $to_email       = "kaue@email.com"; //Recipient email, Replace with own email here
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'This request cannot be accepted.'
        ));
        die($output); //exit script outputting json data
    } 
    
    //Sanitize input data using PHP filter_var().
    $user_name      = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
    $user_phone     = filter_var($_POST["user_phone"], FILTER_SANITIZE_STRING);
    $message        = filter_var($_POST["msg"], FILTER_SANITIZE_STRING);
    
    //additional php validation
    if(strlen($user_name)<2){ // If length is less than 2 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => '<p>Please provide your name.</p>'));
        die($output);
    }    
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => '<p>Please enter a valid e-mail.</p>'));
        die($output);
    }
    if(strlen($user_phone)<10){ // If length is less than 2 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => '<p>Please enter a valid phone number.</p>'));
        die($output);
    }    
    if(strlen($message)<2){ //check emtpy message
        $output = json_encode(array('type'=>'error', 'text' => '<p>Please enter a valid message.</p>'));
        die($output);
    }
    
    //subject
    $subject = "Contact from LetsCross.com - ".$user_name;

    //email body
    $message_body = $message."\r\n\r\nFrom : ".$user_name."\r\nEmail : ".$user_email;
    
    //proceed with PHP email.
    $headers = 'From: '.$user_name.'' . "\r\n" .
    'Reply-To: '.$user_email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    $send_mail = mail($to_email, $subject, $message_body, $headers);
    
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => '<p>There was a server error: ERR001.</p>'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => '<h4>Thank you '.$user_name .'!</h4><p>Your message has been sent and we will contact you shortly!</p>'));
        die($output);
    }
}
?>