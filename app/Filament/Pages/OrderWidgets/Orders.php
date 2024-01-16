<?php

namespace App\Filament\Pages\OrderWidgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Brand;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Widgets\TableWidget as PageWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;

class Orders extends PageWidget
{
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getTableQuery(): Builder
    {
        return Order::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('order_no')->sortable()->searchable(),
            Tables\Columns\ViewColumn::make('clientsO.client_slug', 'client_slug')->view('tables.columns.order-series')->label('Order Series'),
            Tables\Columns\TextColumn::make('created_at')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('statusO.status', 'status')->label('Status')->sortable()->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                // Action::make('Download Pdf')
                //     ->icon('heroicon-o-document-download')
                //     ->url(fn (Order $record) => route('order.pdf.download', $record))
                //     ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\FileUpload::make('file_path')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->label('View Uploaded File')
                                    ->imagePreviewHeight('200')
                                    ->enableDownload()
                                    ->enableOpen()
                                // FileUpload::make('file_path')
                                //     ->disk('public')
                                //     ->directory('quotations')
                                //     ->visibility('public')
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Card::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('order_no')->label('Order No.')->unique()->numeric(),
                                    ])
                                    ,
                                Forms\Components\Select::make('client_id')->relationship('clientsO', 'client_name')->label('Client Name')->reactive(),
                                Forms\Components\Select::make('brand_id')->relationship('brandsO', 'brand_name')->label('Brand Name')
                                    ->options(function (callable $get) {
                                        $clientID = $get('client_id');
                                        if ($clientID) {
                                            return Brand::where('client_id', $clientID)->pluck('brand_name', 'id')->toArray();
                                        }
                                    }),
                                Forms\Components\Select::make('media_id')->relationship('mediaO', 'media_name')->required()->label('Media'),
                                Forms\Components\Select::make('status_id')->relationship('statusO', 'status')->label('Status'),
                                Forms\Components\DatePicker::make('period_start')->label('Period Start')->required(),
                                Forms\Components\DatePicker::make('period_end')->label('Period End')->required(),
                                Forms\Components\TextInput::make('project')->label('Project'),
                                Forms\Components\DatePicker::make('prepared'),
                                Forms\Components\TextInput::make('revision'),
                                Forms\Components\DatePicker::make('date_revision')->label('Date Revision'),
                                Forms\Components\Select::make('tax_id')->relationship('taxOrder', 'vat_tax')->label('Tax'),
                                Forms\Components\Select::make('agency_fee_id')->relationship('afO', 'agency_fee')->label('Agency Fee'),
                                ])
                            ->columns([
                                'sm' => 2
                            ]),
                        Forms\Components\Repeater::make(name: 'oQuote')
                            ->label('Add Product')
                            ->relationship()
                            ->defaultItems(1)
                            ->schema([
                                Forms\Components\Card::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_produk')
                                            // ->relationship('qProduct', 'product_name')
                                            // ->options(Product::query()->pluck(column: 'product_name', key: 'id'))
                                            ->required()
                                            // ->reactive()
                                            ->label('Product Name'),
                                        Forms\Components\TextInput::make('remarks')
                                            ->required(),
                                        Forms\Components\DatePicker::make('periodstart')
                                            ->label('Period Start')
                                            ->reactive(),
                                        Forms\Components\DatePicker::make('periodend')
                                            ->label('Period End')
                                            ->reactive(),
                                        Forms\Components\TextInput::make('qty')
                                            ->numeric()
                                            ->reactive(),
                                        Forms\Components\TextInput::make('priced')->numeric()->required()->reactive(),
                                        // Forms\Components\TextInput::make('freq'),
                                    ])
                                    ->columns([
                                        'sm' => 4
                                    ]),
                            ]),
                    ]),

                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Card::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('order_no')->label('Order No.')->numeric(),
                                    ])
                                    ->columns([
                                        'sm' => 2
                                    ]),
                                Forms\Components\Select::make('client_id')->relationship('clientsO', 'client_name')->label('Client Name')->reactive(),
                                Forms\Components\Select::make('brand_id')->relationship('brandsO', 'brand_name')->label('Brand Name')
                                    ->options(function (callable $get) {
                                        $clientID = $get('client_id');
                                        if ($clientID) {
                                            return Brand::where('client_id', $clientID)->pluck('brand_name', 'id')->toArray();
                                        }
                                    }),
                                Forms\Components\Select::make('media_id')->relationship('mediaO', 'media_name')->required()->label('Media'),
                                Forms\Components\Select::make('status_id')->relationship('statusO', 'status')->label('Status'),
                                Forms\Components\DatePicker::make('period_start')->label('Period Start')->required(),
                                Forms\Components\DatePicker::make('period_end')->label('Period End')->required(),
                                Forms\Components\TextInput::make('project')->label('Project'),
                                Forms\Components\DatePicker::make('prepared'),
                                Forms\Components\TextInput::make('revision'),
                                Forms\Components\DatePicker::make('date_revision')->label('Date Revision'),
                                Forms\Components\Select::make('tax_id')->relationship('taxOrder', 'vat_tax')->required()->label('Tax'),
                                Forms\Components\Select::make('agency_fee_id')->relationship('afO', 'agency_fee')->label('Agency Fee')->required(),
                                ])
                            ->columns([
                                'sm' => 2
                            ]),

                        Forms\Components\Repeater::make(name: 'oQuote')
                            ->label('Add Product')
                            ->relationship()
                            ->defaultItems(1)
                            ->schema([
                                Forms\Components\Card::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_produk')
                                            // ->relationship('qProduct', 'product_name')
                                            // ->options(Product::query()->pluck(column: 'product_name', key: 'id'))
                                            ->required()
                                            // ->reactive()
                                            ->label('Product Name'),
                                        Forms\Components\TextInput::make('remarks')
                                            ->required(),
                                        Forms\Components\DatePicker::make('periodstart')
                                            ->label('Period Start')
                                            ->reactive(),
                                        Forms\Components\DatePicker::make('periodend')
                                            ->label('Period End')
                                            ->reactive(),
                                        Forms\Components\TextInput::make('qty')
                                            ->numeric()
                                            ->reactive(),
                                        Forms\Components\TextInput::make('priced')->numeric()->required()->reactive(),
                                        // Forms\Components\TextInput::make('freq'),
                                    ])
                                    ->columns([
                                        'sm' => 4
                                    ]),
                            ]),
                    ]),

                    Tables\Actions\Action::make('pdf')
                        ->label('PDF')
                        ->color('success')
                        ->icon('heroicon-o-document-download')
                        ->url(fn (Order $record) => route('pdf', $record))
                        ->openUrlInNewTab(),
                ]),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('upload')
                ->label('Upload Quotation')
                ->action(function (array $data) {
                    $order = new Order();

                    $order->file_path = $data['file_path']; // Assuming 'order_no' might be optional
                    $order->order_no = $data['order_no']; // Assuming 'order_no' might be optional
                    $order->client_id = $data['client_id'];
                    $order->brand_id = $data['brand_id'];
                    $order->media_id = $data['media_id'];
                    $order->status_id = $data['status_id'];
                    $order->tax_id = $data['tax_id'];

                    $order->save();
                })
                ->form([
                    Forms\Components\Card::make()
                        ->schema([
                            FileUpload::make('file_path')
                                ->disk('public')
                                ->directory('quotations')
                                ->visibility('public')
                                ->storeFileNamesIn('file_path' . 'attachment_file_names')
                                ->preserveFilenames()

                        ]),
                    Forms\Components\Card::make()
                        ->schema([
                            Forms\Components\Card::make()
                                ->schema([
                                    Forms\Components\TextInput::make('order_no')->label('Order No.')->unique()->numeric(),
                                ])
                                ,
                            Forms\Components\Select::make('client_id')->relationship('clientsO', 'client_name')->required()->label('Client Name')->reactive(),
                            Forms\Components\Select::make('brand_id')->relationship('brandsO', 'brand_name')->required()->label('Brand Name')
                                ->options(function (callable $get) {
                                    $clientID = $get('client_id');
                                    if ($clientID) {
                                        return Brand::where('client_id', $clientID)->pluck('brand_name', 'id')->toArray();
                                    }
                                }),
                            Forms\Components\Select::make('media_id')->relationship('mediaO', 'media_name')->required()->label('Media'),
                            Forms\Components\Select::make('status_id')->relationship('statusO', 'status')->label('Status'),
                        ])
                        ->columns([
                            'sm' => 2
                        ]),
                ]),

            Tables\Actions\CreateAction::make()
                ->label('Add New Quotation')
                ->form([
                    Forms\Components\Card::make()
                        // ->label('Quotation Item')
                        ->schema([
                            Forms\Components\Card::make()
                                ->schema([
                                    Forms\Components\TextInput::make('order_no')->label('Order No.')->unique()->numeric(),
                                ])
                                ,
                            Forms\Components\Select::make('client_id')->relationship('clientsO', 'client_name')->required()->label('Client Name')->reactive(),
                            Forms\Components\Select::make('brand_id')->relationship('brandsO', 'brand_name')->required()->label('Brand Name')
                                ->options(function (callable $get) {
                                    $clientID = $get('client_id');
                                    if ($clientID) {
                                        return Brand::where('client_id', $clientID)->pluck('brand_name', 'id')->toArray();
                                    }
                                }),
                            Forms\Components\Select::make('media_id')->relationship('mediaO', 'media_name')->required()->label('Media'),
                            Forms\Components\Select::make('status_id')->relationship('statusO', 'status')->label('Status'),
                            // Forms\Components\Select::make('product_id')->relationship('productsO', 'product_name')->label('Product'),
                            Forms\Components\TextInput::make('project')->label('Project'),
                            Forms\Components\DatePicker::make('period_start')->label('Period Start')->required(),
                            Forms\Components\DatePicker::make('period_end')->label('Period End')->required(),
                            Forms\Components\DatePicker::make('prepared')->formatStateUsing(fn($state) => $state ? $state : ''),
                            Forms\Components\TextInput::make('revision'),
                            Forms\Components\DatePicker::make('date_revision')->label('Date Revision')->formatStateUsing(fn($state) => $state ? $state : ''),
                            Forms\Components\Select::make('tax_id')->relationship('taxOrder', 'vat_tax')->required()->label('Tax'),
                            Forms\Components\Select::make('agency_fee_id')->relationship('afO', 'agency_fee')->label('Agency Fee')->required(),
                        ])
                        ->columns([
                            'sm' => 2
                        ]),

                    Forms\Components\Repeater::make(name: 'oQuote')
                        ->label('Add New Product')
                        ->relationship()
                        ->defaultItems(1)
                        ->schema([
                            Forms\Components\Card::make()
                                ->schema([
                                    Forms\Components\TextInput::make('nama_produk')
                                    // ->relationship('qProduct', 'product_name')
                                        // ->options(Product::query()->pluck(column: 'product_name', key: 'id'))
                                        ->required()
                                        ->reactive()
                                        ->label('Product Name'),
                                    Forms\Components\TextInput::make('remarks')
                                        ->required(),
                                    Forms\Components\DatePicker::make('periodstart')
                                        ->label('Period Start')
                                        ->reactive(),
                                    Forms\Components\DatePicker::make('periodend')
                                        ->label('Period End')
                                        ->reactive(),
                                    Forms\Components\TextInput::make('qty')
                                        ->numeric()
                                        ->reactive(),
                                    Forms\Components\TextInput::make('priced')->numeric()->required()->reactive(),
                                    // Forms\Components\TextInput::make('freq'),
                                ])
                                ->columns([
                                    'sm' => 4
                                ]),
                        ]),
                ]),
            // Tables\Actions\PDFAction::make()
            //     ->label('Add New')

        ];
    }
}
