<form method="post" action="register.php?mode=verify">
  <script type="text/javascript">
    var RecaptchaOptions = {
      theme : 'clean'
    };
  </script>
  <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=<?php echo $rPublic; ?>"></script>

	<noscript>
  		<iframe src="https://www.google.com/recaptcha/api/noscript?k=<?php echo $rPublic; ?>" height="300" width="500" frameborder="0"></iframe><br/>
  		<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	</noscript>
</form>