<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/api/core/coreTest.php';

header('Cache-Control: no-cache');
header('Pragma: no-cache');
header("HTTP/1.1 200 OK");

if (isset($_GET['paymentId'])) {
    $paymentId = $_GET['paymentId'];
    $paymentDetails = $BC->GetPaymentState($paymentId);
        if ($paymentDetails->Status != PaymentStatus::Prepared and count($paymentDetails->Errors) == 0) {
            $vysledek = MySQL_Query("SELECT * FROM transactions WHERE payment_id = '$paymentId'");
	    $transaction = MySQL_Fetch_Array($vysledek);
        $celkem = count($transaction);
        $item = $paymentDetails->Transactions[0]->Items[0]->Name;
        $status = $paymentDetails->Status;
        echo 'o';
        if ($celkem > 1) {

            echo 'k';
            zmenitStavPlatby($item, $status, $paymentId);
            if ($paymentDetails->Status != PaymentStatus::Expired) {
                zalogovatPlatbu($item, $status, $paymentId, $transaction['user_id']);
            }
            if ($paymentDetails->Status == PaymentStatus::Succeeded) {
                $delka = 0;
                switch ($paymentDetails->Transactions[0]->Items[0]->SKU) {
                    case 'PREMIUM_10':
                        $delka = 10;
                        break;
                    case 'PREMIUM_30':
                        $delka = 30;
                        break;
                    case 'PREMIUM_60':
                        $delka = 60;
                        break;
                    case 'PREMIUM_FULL':
                        $delka = 270;
                        break;
                }
                if ($transaction['activated'] != true and $transaction['user_id'] > 2) {
                    aktivovatClenstvi($delka, $transaction['user_id'], $paymentId);
                }
            }
        }
    }
}

