<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/api/core/core.php';

header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('mixed-content: noupgrade');



function is_bot(){

        if(isset($_SERVER['HTTP_USER_AGENT']))
        {
            return preg_match('/rambler|abacho|acoi|accona|aspseek|altavista|estyle|scrubby|lycos|geona|ia_archiver|alexa|sogou|skype|facebook|twitter|pinterest|linkedin|naver|bing|google|yahoo|duckduckgo|yandex|baidu|teoma|xing|java\/1.7.0_45|bot|crawl|slurp|spider|mediapartners|\sask\s|\saol\s/i', $_SERVER['HTTP_USER_AGENT']);
        }

        return true;
}


function preparePaymentRequest($package, $currency)
{
    global $prices;
    global $items;
    $item = new ItemModel();
    $item->Name = $items['name'][$package];
    $item->Description = $items['desc'][$package];
    $item->Quantity = 1;
    $item->Unit = "piece";
    $item->UnitPrice = $prices[$currency][$package];
    $item->ItemTotal = $prices[$currency][$package];
    $item->SKU = $items['SKU'][$package];
    $trans = new PaymentTransactionModel();
    $trans->POSTransactionId = "TRANS-01";
    $trans->Payee = "roman.danko@email.cz";
    $trans->Total = $item->ItemTotal;
    $trans->Currency = $currency == 'eur' ? Currency::EUR : Currency::CZK;
    $trans->Comment = "Platba za premium";
    $trans->AddItem($item);

    if ($_SESSION["idses"]) {
        $uziv_row = dibi::fetch("SELECT id,login, email FROM users WHERE id = %i", $_SESSION["idses"]);
        $uziv_email = $uziv_row->email;
    } else {
        $uziv_email = 'nhlsazeni';
    }

    $payReq = new PreparePaymentRequestModel();
    $payReq->GuestCheckout = true;
    $payReq->PaymentType = PaymentType::Immediate;
    $payReq->FundingSources = array(FundingSourceType::All);
    $payReq->PaymentRequestId = "PAYMENT-01";
    $payReq->PayerHint = $uziv_email;
    $payReq->PayerPhoneNumber = "true";
    $payReq->Locale = $currency == 'eur' ? UILocale::SK : UILocale::CZ;
    $payReq->OrderNumber = "ORDER-0001";
    $payReq->Currency = $currency == 'eur' ? Currency::EUR : Currency::CZK;
    $payReq->RedirectUrl = "https://nhlsazeni.cz/dekujeme";
    $payReq->CallbackUrl = "https://nhlsazeni.cz/api/callback.php";
    $payReq->AddTransaction($trans);
    return $payReq;
}

if(!is_bot()) {
 if (isset($_GET['balicek'])) {
        if (isset($_GET['currency'])) {
            $currency = $_GET['currency'];
        } else {
            $currency = 'czk';
        }
        $package = $_GET['balicek'];
        $payReq = preparePaymentRequest($package, $currency);
        $myPayment = $BC->PreparePayment($payReq);
        if ($myPayment->RequestSuccessful === true) {
            zalogovatNovouPlatbu($items['name'][$package], $myPayment->PaymentId);
            header("Location: " . BARION_WEB_URL_PROD . "?id=" . $myPayment->PaymentId);
        } else {
            header("Location: https://nhlsazeni.cz/error");
        }
    } else {
        header("Location: https://nhlsazeni.cz/error");
    }
} else {
    echo '
<!DOCTYPE html>

<html lang="cs">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="keywords"
          content=“sázkař,sázky,sázení,sázka,kurzy,sázkové,poradenství,investice,nhl,tip,tipy,tips,betting,hokej“/>

    <meta name="description"
          content="Inspirujte se tipy na NHL, diskutujte při live sázkách a vydělávejte desetitisíce měsíčně."/>
<link rel="canonical" href="https://www.nhlsazeni.cz/" />
    <meta name="author" content="NHLSAZENI.CZ | Sázkové poradenství"/>

    <meta name="googlebot" content="snippet, archive, nofoolow, index"/>

    <meta name="robots" content="index, nofollow"/>

    <meta name="og:title" content="NHLSAZENI.CZ | Sázkové poradenství"/>

    <meta name="og:description"
          content="Nejlepší sázkové poradenství v ČR a SK. Inspirujte se mými tipy na NHL a vydělávejte až desetitisíce měsíčně."/>

    <meta name="og:image" content="https://nhlsazeni.cz/images/nhlsazenicz.png"/>

    <meta property="og:site_name" content="NHLSAZENI.CZ| Sázkové poradenství">

    <meta property="og:url" content="https://nhlsazeni.cz/">
    <!-- Web Application Manifest -->
    <link rel="manifest" href="https://nhlsazeni.cz/manifest.json">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#212121">
    <link rel="icon" href="/favicon.ico">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="Maxiclub">
    <meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#212121">
<meta name="apple-mobile-web-app-title" content="NHL Sazeni">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">
<link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">
<meta name="msapplication-TileColor" content="#212121">
<meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">
    <title>NHLSAZENI.CZ | Sázkové poradenství</title></head><body></body></html>';
}