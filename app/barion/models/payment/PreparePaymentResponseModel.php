<?php

namespace App\barion\models\payment;
use App\barion\common\Currency;
use App\barion\common\FundingSourceType;
use App\barion\common\PaymentType;
use App\barion\common\QRCodeSize;
use App\barion\helpers\iBarionModel;
use App\barion\models\BaseRequestModel;
use App\barion\models\BaseResponseModel;
use App\barion\models\common\FundingInformationModel;
use App\barion\models\common\ItemModel;
use function App\barion\helpers\jget;

/**
 * Copyright 2016 Barion Payment Inc. All Rights Reserved.
 * <p/>
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * <p/>
 * http://www.apache.org/licenses/LICENSE-2.0
 * <p/>
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
class PreparePaymentResponseModel extends BaseResponseModel implements iBarionModel
{
    public $PaymentId;
    public $PaymentRequestId;
    public $Status;
    public $Transactions;
    public $QRUrl;
    public $RecurrenceResult;
    public $PaymentRedirectUrl;

    function __construct()
    {
        parent::__construct();
        $this->PaymentId = "";
        $this->PaymentRequestId = "";
        $this->Status = "";
        $this->QRUrl = "";
        $this->RecurrenceResult = "";
        $this->PaymentRedirectUrl = "";
        $this->Transactions = array();
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            parent::fromJson($json);
            $this->PaymentId = jget($json, 'PaymentId');
            $this->PaymentRequestId = jget($json, 'PaymentRequestId');
            $this->Status = jget($json, 'Status');
            $this->QRUrl = jget($json, 'QRUrl');
            $this->RecurrenceResult = jget($json, 'RecurrenceResult');
            $this->Transactions = array();

            if (!empty($json['Transactions'])) {
                foreach ($json['Transactions'] as $key => $value) {
                    $tr = new TransactionResponseModel();
                    $tr->fromJson($value);
                    array_push($this->Transactions, $tr);
                }
            }

        }
    }
}