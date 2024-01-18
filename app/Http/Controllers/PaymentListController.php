<?php

namespace App\Http\Controllers;

use App\Models\PaymentList;
use Illuminate\Http\Request;

class PaymentListController extends Controller
{
    public function index()
    {
        $response = PaymentList::with(['mode'])
            ->filter(request()->only('sort', 'search', 'start_date', 'end_date', 'status'))
            ->paginate(10)
            ->withQueryString();
        $response->setPath(url()->full());
        // dd($response);
        return $response;
    }
}
