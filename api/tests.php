<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/api/core/core.php';

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
        if ($celkem > 1) {
            $user_id = $transaction['user_id'];
            $email = $paymentDetails->Transactions[0]->Payer->Email;
            echo $user_id . '   ';
            echo $email . '   ';
            if ($user_id <= 2) {
                 $uziv_row = dibi::fetch("SELECT id,login, email, platnost_premium >= CURDATE() AS stav_premium, platnost_premium FROM users WHERE email = %s", $email);
                if (count($uziv_row) > 1) {
                    $user_id = $uziv_row['id'];
                    echo $user_id . ' ';
                    print_r($uziv_row);
                    //mysql_query("UPDATE transactions SET user_id = '" . $uziv_row['id'] . "' WHERE payment_id = '" . $paymentId . "'");
                }

            }
            //zmenitStavPlatby($item, $status, $paymentId);
            if ($paymentDetails->Status != PaymentStatus::Expired) {
                //zalogovatPlatbu($item, $status, $paymentId, $user_id);
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
                if ($transaction['activated'] != true and $user_id > 2) {

                    echo $delka . '   ';
                    //aktivovatClenstvi($delka, $transaction['user_id'], $paymentId);
                }
            }
        }
    }
}

