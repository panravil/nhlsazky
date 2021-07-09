<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/barion-web-php-master/library/BarionClient.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/dibi.min.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db_connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/core.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/login.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/core/balicky.php';


$myPosKey = "9e02508a56f14e0e9ddfd7ec02b1814d";
$myEmailAddress = "roman.danko@email.cz";

// Barion Client that connects to the TEST environment
$BC = new BarionClient($myPosKey, 2, BarionEnvironment::Test);


function zalogovatPlatbu($akce, $stav, $id, $transaction_user)
{
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($transaction_user < 2) {
        $akce .= ' [TESTX]';
    } else {
        $akce .= ' [TEST]';
    }
    mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
            values ('" . $akce . "','" . $stav . "', '" . $id . "', '" . $datum . "', '" . $transaction_user . "', '" . $ip . "');");
}


function zalogovatNovouPlatbu($akce, $id)
{
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($_SESSION["idses"]) {
        $akce .= ' [TEST]';
        $uzivatel = $_SESSION["idses"];
    } else {
        $akce .= ' [TESTX]';
        $uzivatel = 0;
    }

    mysql_query("insert into transactions (user_id, payment_id, status, balicek, datum) 
            values ('" . $uzivatel . "', '" . $id . "', 'Prepared', '" . $akce . "', '" . $datum . "');");
    mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
            values ('" . $akce . "', 'Prepared', '" . $id . "', '" . $datum . "', '" . $uzivatel . "', '" . $ip . "');");
}


function zmenitStavPlatby($akce, $stav, $id)
{
    mysql_query("UPDATE transactions 
            SET status = '" . $stav . "' WHERE payment_id = '" . $id . "'");
}

function aktivovatClenstvi($delka, $userId, $paymentId)
{
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $akce = 'Aktivace';
    if ($userId > 2) {
        $uziv_row = dibi::fetch("SELECT id,login, email, platnost_premium >= CURDATE() AS stav_premium, platnost_premium FROM users WHERE id = %i", $userId);
        $uziv_platnost = $uziv_row->platnost_premium;
        $od = date("Y-m-d");
        if ($uziv_row["stav_premium"] == "1") {
            $akce = 'Prodlouzeni';
            $od = date('Y-m-d', strtotime($uziv_platnost));
            $do = date('Y-m-d', strtotime($uziv_platnost . '+ ' . $delka . 'days'));
            if ($delka == 270)
                $do = date('Y-m-d', strtotime('2020-07-01'));
        } else {
            $do = date('Y-m-d', strtotime($od . '+ ' . $delka . 'days'));
        }
        if ($delka == 270)
            $do = date('Y-m-d', strtotime('2020-07-01'));
        echo $do;
        mysql_query("UPDATE users
                SET platnost_premium= '" . $do . "' WHERE users.id = '" . $userId . "'");
        mysql_query("UPDATE transactions
                SET activated = true WHERE payment_id = '" . $paymentId . "'");
        mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
                values ('".$akce."', '" . $do . "', '" . $paymentId . "', '" . $datum . "', '" . $userId . "', '" . $ip . "');");
    }
}