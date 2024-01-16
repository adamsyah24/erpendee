<!DOCTYPE html>
<html>

<head>

    @php
        $title = 'QUOTATION';
    @endphp
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    {{--  <link rel="stylesheet" href="{{asset('public/css/')}}/rtl/bootstrap.min.css"/>  --}}

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .invoice-box {
            max-width: 1200px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 16px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .logo-header {
            font-size: 1rem;
        }

        /** NEW TABLE **/
        .inv-tr tr td {
            vertical-align: middle;
            padding: 1px;
        }

        .inv-tr tr {
            font-size: 11px;
        }

        .spacer {
            padding: 10px;
        }
    </style>
</head>

<body>
    {{--  <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title flex">
                                <img src="vendor/invoices/LOGO.jpg" style="width: 100%; max-width: 200px" />
                                PT. ANUGERAH MEDIA KARYATAMA
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br />
                                12345 Sunny Road<br />
                                Sunnyville, CA 12345
                            </td>

                            <td>
                                Acme Corp.<br />
                                John Doe<br />
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>

                <td>Check #</td>
            </tr>

            <tr class="details">
                <td>Check</td>

                <td>1000</td>
            </tr>

            <tr class="heading">
                <td>Item</td>

                <td>Price</td>
            </tr>

            <tr class="item">
                <td>Website design</td>

                <td>$300.00</td>
            </tr>

            <tr class="item">
                <td>Hosting (3 months)</td>

                <td>$75.00</td>
            </tr>

            <tr class="item last">
                <td>Domain name (1 year)</td>

                <td>$10.00</td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total: $385.00</td>
            </tr>
        </table>
    </div>  --}}
    <div class="invoice-box">
        <table>
            <tr>
                <td>
                    <table style="width: 45%;">
                        <td>
                            <img src="vendor/invoices/LOGO.jpg" style="width: 80%; max-width: 200px" />
                        </td>
                        <td>
                            <p
                                style="margin-left: -18%; margin-top: -1%; text-align: left; font-size: 11.5px; line-height:1.5em">
                                PT ANUGERAH MEDIA KARYATAMA <br>
                                Taman Meruya Plaza III Blok A11 <br>
                                Meruya - Jakarta Barat <br>
                                Jakarta - Indonesia <br>
                                Phone&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;+62 21 5861212<br>
                                Fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;+62 21 5860379
                            </p>
                        </td>
                    </table>
                </td>
            </tr>
            <tr>
                <table style="margin-top: -1%; padding: 0 0 0 10px; width: 80%;">
                    <tr>
                        <td style="padding-left:10px; background-color: black;">
                            <p
                                style="font-weight: bold; margin-top: 0%;padding-bottom: 0 !important; margin-bottom: -1%; font-size: 20px; color: white;">
                                {{ $title }}
                            </p>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                </table>
            </tr>
            <tr>
                <td>
                    <table style="font-size: 12px; line-height: 120%">
                        <tr>
                            {{--  @foreach ($clients as $client)
                                @foreach ($brands as $brand)
                                    @foreach ($medias as $media)  --}}
                            <td>
                                <p style="margin-top: -5px;">
                                    Client&nbsp; <br>
                                    Brand <br>
                                    Project&nbsp;&nbsp; <br>
                                    Media <br>
                                    Period <br>
                                </p>
                            </td>
                            <td>
                                <p style="margin-top: -5px; margin-left: -15%;">
                                    : {{ $record->clientsO->client_name }}<br>
                                    : {{ $record->brandsO->brand_name }}<br>
                                    : {{ $record->project }}<br>
                                    : {{ $record->mediaO->media_name }}<br>
                                    : {{ date('F d', strtotime($record->period_start)) }} -
                                    {{ date('d F Y', strtotime($record->period_end)) }}
                                    <br>
                                </p>
                            </td>
                            <td>
                                <p style="margin-top: -5px; margin-left: 30%">
                                    No. <br>
                                    <br>
                                    Prepared &nbsp;&nbsp;<br>
                                    Revision <br>
                                    Date Rev. <br>
                                </p>
                            </td>
                            <td>
                                <p style="margin-top: -5px; margin-left:  -20px;">
                                    : {{ $record->order_no }} -
                                    AMK/{{ $record->clientsO->client_slug }}/{{ date('m') }}/{{ date('Y') }}<br>
                                    <br>
                                    : {{ $record->prepared ? date('d F Y', strtotime($record->prepared)) : null }} <br>
                                    : {{ $record->revision }} <br>
                                    : {{ $record->date_revision ? date('d F Y', strtotime($record->date_revision)) : null }}

                                </p>
                            </td>
                            {{--  @endforeach
                                @endforeach
                            @endforeach  --}}
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="padding-left: 1%; padding-right: 1%;">
            <table class="inv-tr" style="text-align: center;">
                <tr style="border: 1px solid black">
                    <td style="border: 1px solid black">NO</td>
                    <td style="border: 1px solid black">ITEMS</td>
                    <td style="border: 1px solid black">REMARKS</td>
                    <td style="border: 1px solid black">PERIOD</td>
                    <td colspan="2" style="border: 1px solid black">COST</td>
                    <td style="border: 1px solid black">QTY</td>
                    {{--  <td style="border: 1px solid black">FREQ</td>  --}}
                    <td style="border: 1px solid black">TOTAL</td>
                </tr>
                <tr class="spacer" style="border: 1px solid black">
                    <td style="border: 1px solid black" colspan="8">&nbsp;</td>
                </tr>

                /////////////////////COLUMN LOOP CALCULATION////////////////////////

                @php
                    $name = $record->clientsO->client_name;
                    $client_slug = $record->clientsO->client_slug;
                    $brand_slug = $record->brandsO->brand_slug;
                    $orderNo = $record->order_no;
                    $project = $record->project;
                    $periodStr = $record->period_start;
                    $periodEnd = $record->period_end;
                    $prepared = $record->prepared;
                    $revision = $record->revision;
                    $daterevision = $record->date_revision;
                    $tax = $record->taxOrder->vat_tax;
                    $agency_fee = $record->afO->agency_fee;
                    $brands = $record->brandsO->brand_name;
                    $clients = $record->clientsO->client_name;
                    $medias = $record->mediaO->media_name;

                    $total = 0;
                    $items = $record->oQuote->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->nama_produk,
                            'remarks' => $item->remarks,
                            'periode' => date('F d', strtotime($item->periodstart)) . ' - ' . date('d F Y', strtotime($item->periodend)),
                            'cost' => $item->priced,
                            'qty' => $item->qty,
                            'freq' => $item->freq,
                        ];
                    });

                    $groups = collect($items)->groupBy('name');
                    $rowspan = $groups->map->count(); // Remove the extra comma here
                @endphp

                @foreach ($groups as $name => $items)
                    @foreach ($items as $index => $item)
                        <tr style="border: 1px solid black;">
                            @if ($index === 0)
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $item['id'] }}</td>
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $name }}</td>
                            @endif
                            <td style="border: 1px solid black">{{ $item['remarks'] }}</td>
                            @if ($index === 0)
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $item['periode'] }}</td>
                            @endif
                            <td colspan="2" style="border: 1px solid black">Rp
                                {{ number_format($item['cost'], 2, ',', '.') }}</td>
                            <td style="border: 1px solid black">{{ $item['qty'] }}</td>
                            <td style="border: 1px solid black">Rp
                                {{ number_format($item['qty'] * $item['cost'], 2, ',', '.') }}</td>
                        </tr>
                        @php
                            $total += $item['qty'] * $item['cost']; // Add semicolon here
                        @endphp
                    @endforeach
                @endforeach

                {{--  @php
                $items = $record->oQuote->map(function ($item) {
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
                    $groups = collect($items)->groupBy('name');
                    $rowspan = $groups->map->count();
                @endphp

                @foreach ($groups as $name => $items)
                    @foreach ($items as $index => $item)
                        <tr style="border: 1px solid black;">
                            @if ($index === 0)
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $item['id'] }}</td>
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $name }}</td>
                            @endif
                            <td style="border: 1px solid black">{{ $item['remarks'] }}</td>
                            @if ($index === 0)
                                <td style="border: 1px solid black" rowspan="{{ $rowspan[$name] }}">
                                    {{ $item['periode'] }}</td>
                            @endif
                            <td colspan="2" style="border: 1px solid black">Rp
                                {{ number_format($item['cost'], 2, ',', '.') }}</td>
                            <td style="border: 1px solid black">{{ $item['qty'] }}</td>
                            <td style="border: 1px solid black">Rp
                                {{ number_format($item['qty'] * $item['cost'], 2, ',', '.') }}</td>
                        </tr>
                        @php
                            $total += $item['qty'] * $item['cost']; // add product of qty and cost to total
                        @endphp
                    @endforeach
                @endforeach  --}}



                <tr style="border: 1px solid black">
                    <td colspan="7" style="text-align: right;">Total</td>
                    <td style="border: 1px solid black">Rp {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td colspan="2" style="border: 1px solid black; text-align: right;">Sub Total</td>
                    <td style="border: 1px solid black">Rp {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
                @if ($agency_fee > 0)
                    <tr>
                        <td colspan="5" style="text-align: right;"></td>
                        <td colspan="2" style="border: 1px solid black; text-align: right;">Agency Fee Service
                            {{ $agency_fee }}%</td>
                        <td style="border: 1px solid black">Rp
                            {{ number_format(($agency_fee / 100) * $total, 2, ',', '.') }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td colspan="2" style="border: 1px solid black; text-align: right;">SUB TOTAL</td>
                    <td style="border: 1px solid black">Rp
                        {{ number_format($total + ($agency_fee / 100) * $total, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td colspan="2" style="border: 1px solid black; text-align: right;">VAT {{ $tax }}%
                    </td>
                    <td style="border: 1px solid black">Rp
                        {{ number_format(($tax / 100) * ($total + ($agency_fee / 100) * $total), 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td colspan="2" style="border: 1px solid black; text-align: right;">GRAND TOTAL</td>
                    <td style="border: 1px solid black">Rp
                        {{ number_format($total +  (($agency_fee / 100) * $total) + (($tax / 100) * ($total + ($agency_fee / 100) * $total)), 2, ',', '.') }}
                    </td>
                </tr>






                {{--  <tr>
                    <td colspan="5"></td>
                    <td colspan="2">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td style="border: 1px solid black; text-align: center;">Prepared By</td>
                    <td style="border: 1px solid black; text-align: center;">Acknowledged By</td>
                    <td style="border: 1px solid black">Approved by Client</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td style="border: 1px solid black; text-align: center; height: 100px;"></td>
                    <td style="border: 1px solid black; text-align: center;"></td>
                    <td style="border: 1px solid black"></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td style="border: 1px solid black; text-align: center;">Rizka Nahriah</td>
                    <td style="border: 1px solid black; text-align: center;">Andy Gusena</td>
                    <td style="border: 1px solid black">CLIENT</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"></td>
                    <td style="border: 1px solid black; text-align: center;">Digital Buying</td>
                    <td style="border: 1px solid black; text-align: center;">Managing Director</td>
                    <td style="border: 1px solid black">{{ $clients }}</td>
                </tr>  --}}

            </table>
        </div>


    </div>
</body>

</html>
