<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Media;
use App\Models\Brand;
use App\Models\QuotationProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Order $record)
    {
        $record = Order::with('clientsO', 'brandsO', 'mediaO', 'oQuote')->find($record->id);

        $data = [
            'title' => 'QUOTATION',
            'name' => $record->clientsO->client_name,
            'client_slug' => $record->clientsO->client_slug,
            'brand_slug' => $record->brandsO->brand_slug,
            'orderNo' => $record->order_no,
            'project' => $record->project,
            'periodStr' => $record->period_start,
            'periodEnd' => $record->period_end,
            'prepared' => $record->prepared,
            'revision' => $record->revision,
            'daterevision' => $record->date_revision,
            'tax' => $record->taxOrder->vat_tax,
            'agency_fee' => $record->afO->agency_fee,
            'brands' => $record->brandsO->brand_name,
            'clients' => $record->clientsO->client_name,
            'medias' => $record->mediaO->media_name,
            'total' => 0,
            // 'no' => $items->id,
            'items' => $record->oQuote->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama_produk,
                    'remarks' => $item->remarks,
                    'periode' => date('F d', strtotime($item->periodstart)) . ' - ' . date('d F Y', strtotime($item->periodend)),
                    // 'periodawal' => $item->periodstart,
                    // 'periodakhir' => $item->periodend,
                    'cost' => $item->priced,
                    'qty' => $item->qty,
                    'freq' => $item->freq,
                ];
            }),
        ];

        $pdf = PDF::loadView('pdf/myPDF', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download();
    }
}
