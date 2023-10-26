<?php

namespace App\Http\Controllers\Member\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MemberTransactionPrintController extends Controller
{
    /**
     * Print transaction
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Transaction $transaction): View
    {

        return view('member.print_transaction', compact('transaction'));
    }
}
