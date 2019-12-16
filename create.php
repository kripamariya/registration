<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "username" => $_POST['username'],
            "name"  => $_POST['name'],
            "email"     => $_POST['email'],
            "password"       => $_POST['password'],
            "mobileno"  => $_POST['mobileno']
        );
		$x=0;
		if (preg_match("/^[a-zA_Z -]+$/", $_POST['username'])===0)
		{
			echo "username is not valid";
			$x++;
		}
		
		
		if (preg_match("/^[a-zA_Z -]+$/", $_POST['name'])===0)
		{
			echo "name is not valid";
			$x++;
		}
		$email=$_POST["email"];
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
		}
		else{
			echo("<br>$email is not a valid email address");
			$x++;
		}
		$mobileno=$_POST['mobileno'];
		if(!is_numeric($mobileno))
		{
			echo"<br> mobile no should be in digit";
			$x++;
		}
		else if (strlen($mobileno)>11)
		{
			echo"not a valid mobileno";
			$x++;
		}
		$sql = "SELECT * FROM data WHERE username = :username";
        $statement= $connection->prepare($sql);
        $statement->bindValue(':username',$_POST['username']);
         $statement->execute();

if($row = $statement->fetch(PDO::FETCH_ASSOC)) 
{
$usernameExists = 1;
} 
else 
{
$usernameExists = 0;
}
$statement->closeCursor();
if ($usernameExists) 
{
  echo "username already Exist";
}
         else
{   
if($x<1)
		{	

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "data",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
		}
		else{
			echo"there are some errors";
		}
}
	}

     catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['name']; ?> successfully added.</blockquote>
<?php } ?>


<h2>Add a user</h2>

<form name="form"  method="post" onsubmit="return validate()";>
<script>
function validate()
{
	var username=document.forms["form"]["username"].value;
	var name=document.forms["form"]["name"].value;
	var email=document.forms["form"]["email"].value;
	var password=document.forms["form"]["password"].value;
	var mobileno=document.forms["form"]["mobileno"].value;
	
	if(username=="")
	{
		alert("enter user name");
		document.forms["form"]["username"].focus;
		return false; 
	}
	else if(!isNaN(username))
	{
		alert("enter valid username");
		document.forms["form"]["username"].focus;
		return false;
	}
	
	else if(name=="")
	{
		alert("enter name");
		document.forms["form"]["name"].focus;
		return false; 
	}
	else if(!isNaN(name))
	{
		alert("enter valid name");
		document.forms["form"]["name"].focus;
		return false; 
	}
	var atposition=email.indexOf("@");
	var dotposition=email.lastIndexOf(".");
	if(atposition<1||dotposition<atposition+2||dotposition+2>=email.length)
	{
		alert("enter a valid email");
		document.forms["form"]["email"].focus;
		return false; 
	}
	else if(password=="")
	{
		alert("enter password");
		document.forms["form"]["password"].focus;
		return false; 
	}
	
    else if(mobileno=="")
	{
		alert("enter mobileno");
		document.forms["form"]["mobileno"].focus;
		return false; 
	}
	
	
}
	</script>
    <label for="username">User name</label>
    <input type="text" name="username" id="username">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="password">password</label>
    <input type="text" name="password" id="password">
    <label for="mobileno">Mobile no</label>
    <input type="text" name="mobileno" id="mobileno">
    <input type="submit" name="submit" value="Submit">
	<a href="login.php">click to login.....</a>
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
	`