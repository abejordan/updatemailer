<?php
//Set Timezone
date_default_timezone_set("America/Indianapolis");
//Include Mail Class
include_once('./classes/mail.php');
$mail = new MailClass();
$body_topics = $_POST['body'];
$headers = [];
$full_body ="";
foreach ($_POST['formData'] as $key => $value) {
    $headers[$value['name']] = $value['value'];
}
$email_opening = "<h2> Today's Overview for: ".date("l, F j, Y")."</h2><br>";
foreach ($body_topics as $topic => $body_subject) {
    # code...
    $body = "<div>";
    $body .= "<h3>".$topic.":</h3><br>";
    $body .= "<p>".$body_subject."</p>";
    $body .= "<hr>";
    $body .= "<div>";
    $full_body = "{$full_body}{$body}";
}

if($mail->sendmail($headers['recipient'],"abby@businessbabysitting.com",$headers['subject'],"{$email_opening}{$full_body}") == 1){
    echo "Your message was sent succesfully!";
}else{
    echo "There was an issue sending your email. Check the logs";
}

?>