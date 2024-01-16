<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfControllerTest extends Controller
{
    // public function __invoke(Order $order)
    // {
    //     return Pdf::loadView('pdf', ['record' => $order])
    //         ->download($order->order_number. '.pdf');
    // }

    public function __invoke(Order $order)
    {
        $pdf = Pdf::loadView('pdf\pdf', ['record' => $order]);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream($order->order_no . '.pdf');
    }
}
