<?php     
function confirmUser($username, $password){
   global $db;
   /* Add slashes if necessary (for query) */
   if(!get_magic_quotes_gpc()) {
	$username = addslashes($username);
   }
$user = $db->select('password')->from('users')->where('login = %s', $username)->fetch();
if ($user) {
  return $user->password === $password ? 0:2;
}
return 1;
}

/**
 * checkLogin - Checks if the user has already previously
 * logged in, and a session with the user has already been
 * established. Also checks to see if user has been remembered.
 * If so, the database is queried to make sure of the user's 
 * authenticity. Returns true if the user has logged in.
 */
function checkLogin(){
   /* Check if user has been remembered */
   if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
      $_SESSION['username'] = $_COOKIE['cookname'];
      $_SESSION['password'] = $_COOKIE['cookpass'];  
//test      
$uziv_row = dibi::fetch("SELECT id FROM users WHERE login = %s", $_SESSION['username']);
$uziv_row['id'] = $_SESSION['idses']; 

      $uzivatel = $_SESSION['username'];

	$vysledek = MySQL_Query("SELECT * FROM users WHERE login = '$uzivatel'");
	$zaznam = MySQL_Fetch_Array($vysledek);
  $idses = $zaznam["id"];
   	$_SESSION["idses"]=$idses;
    
    
   }

   /* Username and password have been set */
   if(isset($_SESSION['username']) && isset($_SESSION['password'])){
      /* Confirm that username and password are valid */
      if(confirmUser($_SESSION['username'], $_SESSION['password']) != 0){
         /* Variables are incorrect, user not logged in */
         unset($_SESSION['username']);
         unset($_SESSION['password']);  
         return false;
      }
      

      return true;
      
      

   }
   /* User not logged in */
   else{
      return false;
   }
}

function displayLogin(){
   global $logged_in;
   if($logged_in){
echo"<div style='padding-top:20px;'><h1>Účet</h1></div>";
echo"<div style='padding-left:5px;'>Jste přihlášen jako <b>".$_SESSION["username"]."</b>.<br><br>Přejít do <a href=\"/admin\"><strong>administrace webu</strong></a></div>";
   } else {
?>           
    
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Test login for Barion</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								
<?php if(isset($_GET['alert'])){
require "inc/error_msg.php"; // V tomto souboru jsou ty hlasky
$vypsatAlert=$_GET['alert'];
echo "$array[$vypsatAlert]";
}	 ?>

                 <form role="form" action="" method="post" class="mt">

									<label for="" class="text-uppercase text-sm">Uživatel</label>
									<input type="text" name="user" placeholder="Uživatel" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Heslo</label>
									<input type="password" name="pass" placeholder="Heslo" class="form-control mb">

									<div class="checkbox checkbox-circle checkbox-info">
										<input id="checkbox7" type="checkbox" name="remember" checked>
										<label for="checkbox7">
										  Zapamatovat si mě
										</label>
									</div>

									<button name="sublogin" class="btn btn-primary btn-block" type="submit">Přihlásit se</button>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>    
    
    
    
    
<?php
   }
}
if(isset($_POST['sublogin'])){
   /* Check that all fields were typed in */
   if(!$_POST['user'] || !$_POST['pass']){
header ("location: ?alert=1");
   }
   /* Spruce up username, check length */
   $_POST['user'] = trim($_POST['user']);
   if(strlen($_POST['user']) > 30){
header ("location: ?alert=2");
   }

   /* Checks that username is in database and password is correct */
   $md5pass = md5($_POST['pass']);
   $result = confirmUser($_POST['user'], $md5pass);

   /* Check error codes */
   if($result == 1){
header ("location: ?alert=3");
   }
   else if($result == 2){
header ("location: ?alert=4");
   } else  {




            /* Username and password correct, register session variables */
   $_POST['user'] = stripslashes($_POST['user']);

   $_SESSION['username'] = $_POST['user'];

   $_SESSION['password'] = $md5pass;


$uziv_row = dibi::fetch("SELECT id FROM users WHERE login = %s", $_SESSION['username']);
$uziv_row['id'] = $_SESSION['idses']; 
      header ("location: ?alert=5");
      $uzivatel = $_SESSION['username'];

	$vysledek = MySQL_Query("SELECT * FROM users WHERE login = '$uzivatel'");
	$zaznam = MySQL_Fetch_Array($vysledek);
  $idses = $zaznam["id"];
   	$_SESSION["idses"]=$idses;
$datum = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

 }

   /**
    * This is the cool part: the user has requested that we remember that
    * he's logged in, so we set two cookies. One to hold his username,
    * and one to hold his md5 encrypted password. We set them both to
    * expire in 100 days. Now, next time he comes to our site, we will
    * log him in automatically.
    */
   if(isset($_POST['remember'])){
      setcookie("cookname", $_SESSION['username'], time()+60*60*24*100, "/");
      setcookie("cookpass", $_SESSION['password'], time()+60*60*24*100, "/");
   }

   /* Quick self-redirect to avoid resending data on refresh */
   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
   return;
} 
/* Sets the value of the logged_in variable, which can be used in your code */
$logged_in = checkLogin();


?>