<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/dibi.min.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db_connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/core.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/login.php';
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $userId = 3188;
    $paymentId = 'TEST';
    $delka = 270;
    if ($userId > 2) {
        $uziv_row = dibi::fetch("SELECT id,login, email, platnost_premium >= CURDATE() AS stav_premium, platnost_premium FROM users WHERE id = %i", $userId);
        $uziv_platnost = $uziv_row->platnost_premium;
        $od = date("Y-m-d");
        if($uziv_row["stav_premium"]=="1") {
            $od = date('Y-m-d', strtotime($uziv_platnost));
            $do = date('Y-m-d', strtotime($uziv_platnost. '+ '.$delka.'days'));
            if ($delka == 270)
                $do = date('Y-m-d', strtotime('2020-07-01'));
        } else {
            $do = date('Y-m-d', strtotime($od . '+ '.$delka.'days'));
        }
            if ($delka == 270)
                $do = date('Y-m-d', strtotime('2020-07-01'));
            echo $do;
        mysql_query("UPDATE users
                SET platnost_premium= '" . $do . "' WHERE users.id = '" . $userId . "'");
        //mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) values ('Aktivace', '" . $do . "', '" . $paymentId . "', '" . $datum . "', '" . $userId . "', '" . $ip . "');");
        /*
        mysql_query("UPDATE transactions
                SET activated = true WHERE payment_id = '" . $paymentId . "'");
        */
    }