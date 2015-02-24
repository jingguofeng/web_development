<?php

session_start();
if(!$_SESSION['protect'])  { 
	$_SESSION['protect']=0; 
}
include "connect.php";

if($_POST){
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$user_name = trim($_POST['user_name']);
$pwd = trim($_POST['pwd']);
$email = trim($_POST['email']);
$time = trim($_POST['time']);

if( $first_name == "" || $first_name == null){
	header('Location: register?error=First Name cannot be empty');
}else if($last_name == "" || $last_name == null){
	header('Location: register?error=Last Name cannot be empty');
}else if($user_name == "" || $user_name == null){
	header('Location: register?error=User Name cannot be empty');
}else if($pwd == "" || $pwd == null){
	header('Location: register?error=Password cannot be empty');
}else if($email == "" || $email == null){
	header('Location: register?error=Email cannot be empty');
}


$sth = $dbh->prepare("SELECT * FROM users WHERE user_name = :user_name LIMIT 1");
$sth->bindParam(':user_name', $user_name);
$sth->execute();

$user = $sth->fetch(PDO::FETCH_ASSOC);
if($user){
	header('Location: register?error=User Name had already been token');
}

$sth = $dbh->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
$sth->bindParam(':email', $email);
$sth->execute();

$user = $sth->fetch(PDO::FETCH_ASSOC);
if($user){
	header('Location: register?error=Email had already been token');
}



echo "<h1>Thank you for your register with us!</h1>";


$sth = $dbh->prepare("INSERT INTO users ( first_name, last_name, user_name, pwd, email, create_time ) values ( :first_name, :last_name
		,:user_name, :pwd, :email, NOW())");

$sth->bindValue(':first_name', $first_name);
$sth->bindValue(':last_name', $last_name);
$sth->bindValue(':user_name', $user_name);
$sth->bindValue(':email', $email);
//$sth->bindValue(':create_time', $time);

$pw_out = create_hash($pwd);
$params = explode(":", $pw_out);
$pwd_in = $params[HASH_SALT_INDEX].":".$params[HASH_PBKDF2_INDEX];
$sth->bindValue(':pwd', $pwd_in);

$sth->execute();

}
$ok = 1;
?>

	
<?php if($ok == 1):?>
	<?php if($_SESSION['protect']<=2):?>
		<div id="error">
			<span style="color:red;"><?php echo $_GET['error'];?></span>
		</div>
		<form method="post" action="show">
			<input type="text" name="user_name" placeholder="Enter your user name"><br>
			<input type="text" name="pwd" placeholder="Enter your password"><br>
			<input type="submit" value="Login in">
		</form>
		<br>
		<a href="register">Go back</a>
	<?php else:?>	
		<span></span>
	<?php endif;?>
<?php endif;?>