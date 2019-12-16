<!DOCTYPE html>
<html>
<head>
<link href="style.css" type="text/css" rel="stylesheet">


<script> 
     function validate()
	 {
		 var uname=document.forms["form"]["uname"].value;
		 var pass=document.forms["form"]["password"].value;
		 if(uname=="")
		 {
			 alert("Please enter your name");
			 document.forms["form"]["uname"].focus();
			 return false;
		 }
		 if(pass=="")
		 {
			 alert("Please enter your password");
			 document.forms["form"]["password"].focus();
			 return false;
		 }
	 }
</script>
</head><body>
    <div class="reg">
	<h2><center> Login </center></h2><br><hr><br>
      <form action="home.php" method="post" name="form" onsubmit="return validate();">
        <input type="text" name="uname" placeholder="User Name" class="fld">
		<input type="password" name="password" placeholder="Password" class="fld">
        <input type="submit" class="btn" value="Login" name="submit">
      </form>
	</div>
</body>
</html>