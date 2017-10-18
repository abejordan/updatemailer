<?php
require('./classes/db.php');
class MailClass extends DbClass
{
    //init vars
    var $send_success=0;
        /**
         * Send Emails
         *
         * @param $recipient, $from, $email_subject, $body
         * @return booloean If mail send successful return true If failed return false
         */
    function sendMail($recipient="",$from="",$email_subject="",$body=""){
        // Multiple recipients
$to = $recipient; // note the comma
// Subject
$subject = $email_subject;

// Message
$message ='
<html>
<head>
  <title>Business Babysitters</title>
  <style>
  .wrap {
    width: 75%;
    margin: auto;
}
img.center {
    display: block;
    margin: 0 auto;
    max-width:100%;
}
hr{
    margin: 0 auto;
}
  </style>
</head>
<body>
<div class="wrap">
<div class="row">
<img src="http://107.147.24.85/bbmailer/public/images/fbheader.png" class="center" alt="business babysitters logo">
</div>';
$message .= $body;
$message .='
</div>
</div>
</body>';
$message .='</html>';
// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
// Additional headers
$headers[] = 'From: Business Babysitters <'.$from.'>';
$headers[] = 'Reply-to: Business Babysitters <'.$from.'>';
// Mail it
if(@mail($to, $subject, $message, implode("\r\n", $headers)))
{
    $this->send_success = 1;
}else{
    $this->send_success = 0;
}
        //log the mail event
        $this->logMail();
        //return mail status
        return $this->send_success;
    }
        /**
         * Log Emails
         *
         * @param globals
         * @return mome
         */
    function logMail(){
        //Write to DB
        $log_response = json_encode($this->query("INSERT INTO `Emails` (`Recipient`,`Message`,`Status`) VALUES (1,1,$this->send_success)"));
    }
    }


?>