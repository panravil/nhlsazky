<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::where('status', '=', 'Succeeded')->orderBy('id', 'desc');
        if ($request->input() != null) {

            if ($request->input('all') == '1') {
                $transactions = Transaction::orderBy('id', 'desc');
            }
            if ($request->input('search') != null) {
                $transactions = Transaction::where('user_email', 'LIKE', '%' . $request->input('search') . '%');
            }
        }
        return view('admin.transakce.index')->with('data', $transactions->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function callback(Request $request)
    {
        $paymentId = $request->get('paymentId');
        try {
            $status = \Barion::getPaymentState($paymentId);
            $transaction = Transaction::where('payment_id', '=', $paymentId)->firstOrFail();
            $transaction->status = $status->Status;
            if ($status->Status == 'Succeeded' and $transaction->activated_date == null) {
                $transaction->user_email = $status->Transactions[0]->Payer->Email;
                $transaction->save();
                $user = User::where('email', '=', $status->Transactions[0]->Payer->Email)->first(); // model or null
                if ($user) {
                    $transaction->activate();
                }
            }
            $transaction->user_email = $status->Transactions[0]->Payer->Email;
            $transaction->save();
            return 200;
        } catch (\Exception $e) {
            return 200;
        }
    }


    public function callbackPost(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $status = \Barion::getPaymentState($paymentId);
        dd($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
