<?php

include "connect.php";

?>
<div id="error">
	<span style="color:red;"><?php echo $_GET['error'];?></span>
</div>
<form method="post" action="login">
	<input type="text" name="first_name" placeholder="First Name" length=22><br>
	<input type="text" name="last_name" placeholder="Last Name" length=22><br>
	<input type="text" name="user_name" placeholder="Create your user name"><br>
	<input type="text" name="pwd" placeholder="Enter your new password"><br>
	<input type="text" name="email" placeholder="Enter your new email"><br>
	<input type="hidden" name="time" value="<?php echo date('Y-m-d H:i:s');?>">
	<input type="submit" value="Register">
</form>