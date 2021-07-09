<?php
if (!$_SESSION["idses"]){
echo '<div class="col-md-12">';
echo '<h1>Můj účet</h1>';  
prihlaseni_index();
echo '</div>';
} else {
echo '<div class="col-md-12">';
echo '<h1>Můj účet</h1></div>';
	$iduser = $_SESSION["idses"];					
	$odeslano = $_POST["odeslano"];
    if ($odeslano==ano){  	 	 
	$addjmeno = htmlspecialchars($_POST["addjmeno"]);
	$addprijmeni = htmlspecialchars($_POST["addprijmeni"]);
	$addulice = htmlspecialchars($_POST["addulice"]);  
	$addmesto = htmlspecialchars($_POST["addmesto"]);
	$addpsc = htmlspecialchars($_POST["addpsc"]);
	$addkraj = htmlspecialchars($_POST["addkraj"]);
  $addtelefon = htmlspecialchars($_POST["addtelefon"]);
  $email_odber = htmlspecialchars($_POST["email_odber"]);
  $email_premium = htmlspecialchars($_POST["email_premium"]);
  $addnazev_firmy = htmlspecialchars($_POST["addnazev_firmy"]);
  $addico = htmlspecialchars($_POST["addico"]);
  $addwwwstranky = htmlspecialchars($_POST["addwwwstranky"]);
	$mysql = MySQL_Query("UPDATE users SET
               telefon= '$addtelefon',
               email_odber= '$email_odber',
               email_premium= '$email_premium'
               WHERE id = '$iduser' LIMIT 1 ");
                   	if(!$mysql){
                   		echo error("Chyba!");
                    } else {
                    	echo ok("Účet byl upraven!");   
       }
     }
   $sql_user = MySQL_Query("SELECT * FROM users WHERE id = '$iduser' ");
    $row = MySQL_Fetch_Array($sql_user);
$email_premium = false;
	if ($row['email_premium']=="1") $email_premium = "CHECKED";
$email_odber = false;
	if ($row['email_odber']=="1") $email_odber = "CHECKED";  
echo '<div class="col-md-6">
        <div class="subtitle">Informace</div>
'; 
echo '<form name="edituserform" action="" method="post" class="form-horizontal">

        <div class="form-group row">
          <label for="mojeid" class="col-sm-2 col-form-label">MOJE ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="mojeid" value="'.$iduser.'" disabled>
          </div>
        </div>


        <div class="form-group row">
          <label for="uzivatel" class="col-sm-2 col-form-label">Uživatel:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="uzivatel" value="'.$row['login'].'" disabled>
          </div>
        </div>
 

        <div class="form-group row">
          <label for="jmeno" class="col-sm-2 col-form-label">Jméno:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="jmeno" value="'.$row['jmeno'].'" disabled>
          </div>
        </div>
 

        <div class="form-group row">
          <label for="prijmeni" class="col-sm-2 col-form-label">Příjmení:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="prijmeni" value="'.$row['prijmeni'].'" disabled>
          </div>
        </div>

 
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="email" value="'.$row['email'].'" disabled>
          </div>
        </div>

         
        <div class="form-group row">
          <label for="telefon" class="col-sm-2 col-form-label">Telefon:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="telefon" name="addtelefon" value="'.$row['telefon'].'">
          </div>
        </div>  

       <div class="col-md-12 no_margin_padding">    
        <div class="checkbox">
          <label>
            <input type="checkbox" name="email_odber" value="1"'.$email_odber.'> Souhlasím se zasíláním marketingových materiálů na email <strong>'.$row["email"].'</strong>.
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="email_premium" value="1"'.$email_premium.'> Chci dostávat na e-mail upozornění o novém  tipu (pokud máte aktivní PREMIUM účet).
          </label>
        </div>
        <input type="hidden" name="odeslano" value="ano">
        <div class="form-group">
          <div class="float-right">
          <button type="submit" class="btn btn-danger pull-right">Změnit údaje</button>
          </div>
        </div> 
       </div> 
      </form>';     
?>

</div>
<div class="col-md-6">
<div class="subtitle">Změna hesla</div>

<?php
	if ($_POST['odeslano']==1){
		$editpw_old = strip_tags(MD5($_POST["editpw_old"]));
		$editpw_new = strip_tags(MD5($_POST["editpw_new"]));		
		$editpw_new2 = strip_tags(MD5($_POST["editpw_new2"]));	
		$editid = $_POST["editid"];
    	if (strlen($editpw_old)==0){
        	error("Musíte zadat staré heslo!");
        } elseif (strlen($editpw_new)==0){
            	error("Musíte zadat nové heslo!");
            } elseif (strlen($editpw_new2)==0){
                	error("Musíte zadat nové heslo znovu!");
           } else {
  $search_pw = MySQL_Query("SELECT * FROM users WHERE id = ".$_SESSION['idses']." ");
    $row_pw = MySQL_Fetch_Array($search_pw);	
	 if (($editpw_old==$row_pw['password']) AND ($editpw_new==$editpw_new2)){
	       	$sql_edituser = MySQL_Query("UPDATE users SET password = '$editpw_new' WHERE id = '$editid' ");
        }else{ error("Staré heslo bylo špatně zadáno nebo se nová hesla neshodují!"); }
       if (!$sql_edituser){
       	error("Nastala chyba!");
         } else {
        	ok("Heslo bylo úspěšně změněno!");
       }
     }
   }
$search_user = MySQL_Query("SELECT * FROM users WHERE id = ".$_SESSION['idses']." ");
   $row = MySQL_Fetch_Array($search_user);	  



echo '<form name="changepw" action="" method="post" class="form-horizontal">
        <div class="form-group row">
          <label for="stareheslo" class="col-sm-3 col-form-label">Staré heslo:</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="stareheslo" name="editpw_old" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="noveheslo" class="col-sm-3 col-form-label">Nové heslo:</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="noveheslo" name="editpw_new" required>
          </div>
        </div>        
        <div class="form-group row">
          <label for="novehesloznovu" class="col-sm-3 col-form-label">Nové heslo znovu:</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="novehesloznovu" name="editpw_new2" required>
          </div>
        </div>     
        <input type="hidden" name="odeslano" value="1">
        <input type="hidden" name="editid" value="'.$row['id'].'">
        <div class="form-group">
          <div class="float-right">
          <button type="submit" class="btn btn-danger pull-right">Změnit heslo</button>
          </div>
        </div>
      </form>';

echo '</div>';
}
?>

<div class="col-md-12">
<div class="subtitle"id="balicky">Aktivace / prodloužit členství</div>
</div>
<?php include "modules/inc_platby.php";?>
