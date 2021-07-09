<?php

$adresa = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

define('URL', $adresa);


function zalogovatZmrda($akce, $kde)  {

    $uzivatel = $_SESSION["idses"];

    $datum = date("Y-m-d H:i:s");

    $ip = $_SERVER['REMOTE_ADDR'];  

    mysql_query("insert into logyZmrda (akce, kde, datum, uzivatel, ip) values ('".$akce."', '".$kde."', '".$datum."', '".$uzivatel."', '".$ip."');");

  }


  function zalogovat($akce, $kde, $id)  {

    $uzivatel = $_SESSION["idses"];

    $datum = date("Y-m-d H:i:s");

    $ip = $_SERVER['REMOTE_ADDR'];	

    mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) values ('".$akce."', '".$kde."', '".$id."', '".$datum."', '".$uzivatel."', '".$ip."');");

  }

   function povinne()  {

  echo'<div style="font-size:13px;"><strong>Tučně označené položky</strong> je nutné <span style="color:red;"><strong>vyplnit!</div>';

  }



// odhlášení  

if (!isset($_GET['strana'])){$_GET['strana']='';}  

if (($_GET["strana"]=="odhlasit") && ($_SESSION['idses'])){

   setcookie("cookname", "", time()-60*60*24*100, "/");

   setcookie("cookpass", "", time()-60*60*24*100, "/");

   unset($_SESSION['username']);

   unset($_SESSION['password']);

   $_SESSION = array(); 

   session_destroy();

   echo "<meta http-equiv=\"Refresh\" content=\"2;URL=/\">";             

}



function ok ($text)

{

print '

<div class="alert alert-success">

  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> 

    '.$text.'

</div>';

} 

function error ($text)

{

print '

<div class="alert alert-danger">

  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> 

    '.$text.'

</div>';

} 

function info ($text)

{

print '

<div class="alert alert-info">

  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span> 

    '.$text.'

</div>';

}

function not ($text)

{

print '

<div class="alert alert-warning">

  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <span class="glyphicon glyphicon glyphicon-info-sign" aria-hidden="true"></span> 

    '.$text.'

</div>';

}



// SKLONOVANI

function sklonovani($pocet, $nula, $jeden, $malo) {

    $string = $pocet."&nbsp;";

    if ($pocet == 0 OR $pocet >= 5) $string .= $nula;

    elseif ($pocet == 1) $string .= $jeden;

elseif ($pocet < 5) $string .= $malo;

 

    return $string;

} 



// texts

$lng_pridat = 'Přidat';

$lng_upravit = 'Upravit';

$lng_error = 'Nastala neočekávaná chyba, zkuste to prosím znovu nebo kontaktujte webmastra.';

$lng_not = 'Žádná změna nebyla provedena.';

?>