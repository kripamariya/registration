<?php
$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "datas";
      
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) 
	    {
          die("Connection failed: " . $conn->connect_error);
        } 
		else
		{
		 echo "Succesfull";
		}
	    
	    $uname=$_POST['uname'];
	    $pass=$_POST['password'];
		  if($uname=="")
          {
	       echo "User Name is not valid<br>";
	     
          }
       if($pass=="")
         {
	     echo "Password is not valid<br>";
	    
         }
		
		$sql = "SELECT * FROM data WHERE username='$uname'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
		 {
    // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        echo "Email: " . $row["email"]. " - User name: " . $row["username"]. "<br>";
        echo "Password: " . $row["password"]. "<br>";
        }
        } 
		else 
		{
        echo "0 results";
		}
		?>