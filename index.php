<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Mailer</title><!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />

</head>
<body>
<div class="container theme-showcase" role="main">
  <h1>Updates Mailer!<br><small>A simple mail application to communicate with clients!</small></h1>
  <form id="main_email_form" >
      <div class="form-group">
        <label for="email">Email address(es) Separate with Commas:</label>
        <input type="text" class="form-control" id="email" name="recipient" placeholder="masterchief@pillarofautumn.com, cortana@pillarofautumn.com">
      </div>
      <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" class="form-control" id="subject" name="subject">
      </div>
      <!-- Body Titles Template chooser -->
      <div class="form-group">
        <label for="topic1">Choose a Template:</label>
       <select name="" id="select_template">
       <option value="default">Please Choose</option>
       <option value="amazon_default">Deafult - Amazon</option>
       <option value="custom_email">Custom Email</option>
       </select>
      </div>
      <!-- Start Body Titles -->
      <div class="body_template">

      </div>
      <!-- End Body Titles -->			
      <button id="submit_btn" style="margin-top:25px;margin-bottom:25px;" type="submit" class="btn btn-primary btn-block btn-lg" >Submit</button>
    </form>
    <div id="submit_response"></div>
  <?php
    date_default_timezone_set("America/Indianapolis");
    echo date("l, F j, Y");
  ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type=text/javascript>
$( "#main_email_form" ).submit(function( event ) {
    $('#submit_btn').html('Sending your mail! <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    $('#submit_btn').prop('disabled', true);
    var body_topics = {};
    var full_form = [];
    $('#main_email_form *').filter(':input[name=body_topic]').each(function(){
        body_topics[$(this).attr('id')] = $(this).val();
    });
    var data = $('#main_email_form').serializeArray(true);
    sendform(data,body_topics);
    event.preventDefault();
    
});
//ajax functio to send email
//running slow currently....
function sendform(formData,body_topics) {
    JSON.stringify(body_topics);
    JSON.stringify(formData);
  $.ajax({
    type: "POST",
    data: {formData,body:body_topics},
    url: "emailHandler.php",
    async: true,
    success: function(data) {
      $('#submit_btn').html('Send');
      $('#submit_btn').prop('disabled', false);
      $('#submit_response').html(data);
    }
  });    
} 
$('#select_template').change(function(){
  switch (this.value) { 
	case 'default': 
    console.log("Default"); 
    $('.body_template').html('');
		break;
	case 'amazon_default':
    console.log("Amazon Default"); 
    $('.body_template').load('./public/email_templates/default_amazon.html');
		break;
    case 'custom_email':
    console.log("Custom!"); 
    $('.body_template').load('./public/email_templates/custom.html');
		break;
	default:
		alert(this.value);
}

});
</script>
</body>
</html>