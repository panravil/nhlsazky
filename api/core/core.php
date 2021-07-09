<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/barion-web-php-master/library/BarionClient.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/dibi.min.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db_connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/core.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/login.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/core/balicky.php';


$myPosKey = "81ee4ed1aba54772a48365a58b7c698c"; // <-- Replace this with your POSKey!
$myEmailAddress = "roman.danko@email.cz"; // <-- Replace this with your e-mail address in Barion!

// Barion Client that connects to the TEST environment
$BC = new BarionClient($myPosKey, 2, BarionEnvironment::Prod);


function zalogovatPlatbu($akce, $stav, $id, $transaction_user)
{
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($transaction_user < 2) {
        $akce .= ' [X]';
    }
    mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
            values ('" . $akce . "','" . $stav . "', '" . $id . "', '" . $datum . "', '" . $transaction_user . "', '" . $ip . "');");
}


function zalogovatNovouPlatbu($akce, $id)
{
    $datum = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($_SESSION["idses"]) {
        $uzivatel = $_SESSION["idses"];
    } else {
        $akce .= ' [X]';
        $uzivatel = 0;
    }
    $referer = $_SERVER["HTTP_REFERER"];
    mysql_query("insert into transactions (user_id, payment_id, status, balicek, datum, referer) 
            values ('" . $uzivatel . "', '" . $id . "', 'Prepared', '" . $akce . "', '" . $datum . "', '" . $referer . "');");
    if ($uzivatel > 2) {
        mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
            values ('" . $akce . "', 'Prepared', '" . $id . "', '" . $datum . "', '" . $uzivatel . "', '" . $ip . "');");
    }
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
                $do = date('Y-m-d', strtotime('2020-11-01'));
        } else {
            $do = date('Y-m-d', strtotime($od . '+ ' . $delka . 'days'));
        }
        if ($delka == 270)
            $do = date('Y-m-d', strtotime('2020-11-01'));
        echo $do;
        mysql_query("UPDATE users
                SET platnost_premium= '" . $do . "' WHERE users.id = '" . $userId . "'");
        mysql_query("UPDATE transactions
                SET activated = true WHERE payment_id = '" . $paymentId . "'");
        mysql_query("insert into logy (akce, kde, id_kde, datum, uzivatel, ip) 
                values ('" . $akce . "', '" . $do . "', '" . $paymentId . "', '" . $datum . "', '" . $userId . "', '" . $ip . "');");

        $predmet = "NHLsazeni.cz - Aktivace členství";
        $zprava = "<html><body>";
        $zprava .= '<hr>';
        $zprava .= "<p>Právě vám bylo aktivováno premium členství na webu: <a href='https://nhlsazeni.cz/premium-tipy'>NHLsazeni.cz</a>.</p>";
        $zprava .= '<p>Pokud nechcete dostávat tento informační e-mail, odškrtněte si "dostávat na e-mail upozornění o novém premium tipu" po kliknutí na "Můj účet"</p>';
        $zprava .= "<br>";
        $zprava .= "<hr>";
        $zprava .= "Toto je automatický e-mail, neodpovídejte! </body> </html>";
        $hlavicky = 'From: nhlsazeni@gmail.com' . "\n"; // můj e-mail
        $hlavicky .= "MIME-Version: 1.0\n";
        $hlavicky .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\n"; // způsob kódování
        $hlavicky .= "X-Mailer: Html\n";
        $hlavicky .= "X-Priority: 1\n"; // priorita (1 nejvyšší, 2 velká, 3 normální ,4 nejmenší)
        $hlavicky .= "Content-Type: text/html; charset=UTF-8\n"; // Kódování
        mail($uziv_row["stav_premium"], $predmet, $zprava, $hlavicky);
    }
}