<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function generatePDF(Order $order) 
    {
        $order->load(['user','products']);
        $dateNow=date('m/d/Y');

        $data = [
            'date' => $dateNow,
            'order' => $order
        ];

        $pdf = Pdf::loadView('order.pdf-invoice-order', $data);
        return $pdf->download('order-invoice.pdf');
    }
}
