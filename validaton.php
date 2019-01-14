<?php
if($_POST)
{
    $to_email       = "graphic_designer_1@baranseli.ru"; //Recipient email, Replace with own email here
    $from_email     = "filatovaverapavlovna@gmail.com"; //from mail, it is mandatory with some hosts and without it mail might endup in spam.
    	
    //check if its not an ajax request just exit!
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        print "Can't access directly!";
        exit;
    } 

    //Sanitize input data using PHP filter_var().
    $title            = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
    $surname          = filter_var($_POST["surname"], FILTER_SANITIZE_STRING);
    $email            = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $name             = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $subject          = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
	$company_name     = filter_var($_POST["company_name"], FILTER_SANITIZE_STRING);
	$adress           = filter_var($_POST["adress"], FILTER_SANITIZE_STRING);
    $message          = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
	$tel              = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    

    //Additional
    if(strlen($name)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то ваше имя слишком короткое'));
       die($output);
	}
    if(strlen($surname)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то ваша фамилия слишком короткая'));
      die($output);
    }
    if(strlen($midname)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то ваше отчество слишком короткое'));
      die($output);
    }
	 if(strlen($email)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то ваш email слишком короткий'));
       die($output);
	}   
    if(strlen($company_name)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то имя вашей компании слишком короткое'));
      die($output);
    }
	if(strlen($subject)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то имя вашей компании слишком короткое'));
      die($output);
    }
	if(strlen($adress)<2){ // If length is less than 2 it will output JSON error.
       $output = json_encode(array('type'=>'error', 'text' => 'Что-то имя вашей компании слишком короткое'));
      die($output);
    }
	if(!filter_var($tel, FILTER_SANITIZE_NUMBER_FLOAT)){ //check for valid numbers in phone number field
        print json_encode(array('type'=>'error', 'text' => 'Enter only digits in phone number'));
        exit;
    }
	 if(strlen($message)<3){ //check emtpy message
        print json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
        exit;
    }
    
	
 	//email body
    $message_body =   "$name\r\n";
    $message_body .=  "$surname\r\n";
    $message_body .=  "$midname\r\n";
	$message_body .=  "$email\r\n";
    $message_body .=  "$tel\r\n";
	$message_body .=  "$company_name\r\n";
    $message_body .=  "$adress\r\n";
    $message_body .=  "------------------------------\r\n";
    $message_body .=  "$message\r\n";
 
	    
    //proceed with PHP email.
    $headers = "From: info@baranseli.ru\r\n"; 
    $headers .= "To: graphic_designer_1@baranseli.ru\r\n";
    $headers .= "Cc: filatovaverapavlovna@gmail.com\r\n";
	$headers .= "Cc: admin@baranseli.ru\r\n";
	$headers .= "Cc: secretatry@baranseli.ru\r\n";
	$headers .= "Cc: account@baranseli.ru\r\n";
    $headers .= "Bcc: filatovaverapavlovna@gmail.com\r\n";
    
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
    
    
    $subject=base64_encode($subject);
    $subject="=?utf-8?b?$subject?=";
	
	
    $send_mail = mail($to_email, $subject, $message_body, $headers);
     
      
    if(!$send_mail){
        //If mail couldn't be sent, this is probably server's fault, check your mail configuration or consult your host
        print json_encode(array('type'=>'error', 'text' => '<strong>NO OK</strong>'));
        exit;
    }else{
        print json_encode(array('type'=>'message', 'text' =>  $sender_name.'<strong>OK</strong>'));
        exit;
    }
}
?>





