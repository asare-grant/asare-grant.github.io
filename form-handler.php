<?php

$nameErr = $visitors_emailErr = $subjectErr = $messageErr = "";
$name = $visitors_email = $subject = $message = "";

if($_SERVER[REQUEST_METHOD] == "POST"){
    if(empty($_POST["name"])){
        $nameErr = "Name is required"
    }
    else{
        $name = test_input($_POST["name"])
        if(!preg_match("/^[A-Za-z-' ]*$/"), $name){
            $nameErr = "Only letters and white spaces are allowed";
        }
    }

    if(empty($_POST["email"])){
        $visitors_emailErr = "Email is required";
    }
    else{
        $visitors_email = test_input($_POST["email"]);
        if(!filter_var($visitors_email, FILTER_VALIDATE_EMAIL)){
            $visitors_emailErr = "Invalid email format";
        }
    }

    if(empty($_POST["subject"])){
        $subjectErr = "Subject is required";
    }
    else{
        $subject = test_input($_POST["subject"]);
        if(!preg_match("/^[A-Za-x-' ]*$/"), $subject){
            $subjectErr = "Only letters and white spaces are allowed";
        }
    }
    if(empty($_POST["message"])){
        $messageErr = "Message is required";
    }
    else{
        $message = test_input($_POST["message"]);
        if(!preg_match("/^[A-Za-z-' ]*$/"), $message){
            $message = "Only letters and white spaces are allowed";
        }
    }
}

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

$email_from = "p.asaregrant@outlook.com";

$email_subject = "New Form Submission";

$email_body = "User Name: $name. \n".
               "User Email: $visitors_email. \n".
                "Subject: $subject. \n".
                 "Message: $message. \n";

$to = "p.asaregrant@gmail.com";

$headers = "From: $email_from";

$headers .= "Reply-To: $visitors_email";

mail($to, $email_subject, $email_body, $headers);

header("Location: contact.html");

?>