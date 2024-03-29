<?php

namespace App\Filament\Pages\MediaOrderWidgets;

use App\Models\MediaOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Brand;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Widgets\TableWidget as PageWidget;
use Illuminate\Database\Eloquent\Builder;


class QuotationApproved extends PageWidget
{
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];
    protected function getTableQuery(): Builder
    {
        return Order::query()->where('status_id', '1');
        return MediaOrder::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('order_no')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('status')->enum([
                'draft' => 'Draft',
                'reviewing' => 'Reviewing',
                'published' => 'Published',
            ]),
            Tables\Columns\TextColumn::make('created_at')->sortable()->searchable(),
        ];
    }


    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('createMediaOrder')
                    ->label('Create Media Order')
                    ->icon('heroicon-o-document-download')
                    ->action(function (Order $record, array $data) {
                        MediaOrder::create([
                            'order_id' => $record->id,
                            'order_no' => $record->order_no,
                            'status' => $record->status_id,
                            'mo_series_number' => $data['mo_series_number'],
                            // Add more fields from Order model that you want to copy
                            // 'field_name' => $record->field_name,
                        ]);
                    })
                    ->form([
                        Forms\Components\TextInput::make('order_no')
                            ->label('Order No.')
                            ->disabled()
                            ->default(fn (Order $record) => $record->order_no),
                        Forms\Components\TextInput::make('id')
                            ->label('Order ID')
                            ->disabled()
                            ->default(fn (Order $record) => $record->id),
                        Forms\Components\TextInput::make('mo_series_number')
                            ->label('Series Number')
                        // ->disabled()
                        // ->default(fn (MediaOrder $record) => $record->mo_series_number),
                        // Add more fields that you want to show in the form
                        // Forms\Components\TextInput::make('field_name')
                        //     ->label('Field Label')
                        //     ->default(fn (Order $record) => $record->field_name),
                    ])
                    ->modalButton('Save to Media Order'),
            ]),
        ];
    }

    // protected function getTableHeaderActions(): array
    // {
    //     return [
    //         Tables\Actions\CreateAction::make()
    //             ->label('Add New Quotation')
    //             ->form([
    //                 Forms\Components\Card::make()
    //                     // ->label('Quotation Item')
    //                     ->schema([
    //                         Forms\Components\Card::make()
    //                             ->schema([
    //                                 Forms\Components\TextInput::make('order_no')->label('Order No.')->unique()->numeric(),
    //                                 Forms\Components\TextInput::make('order_series')->label('Order Series'),
    //                             ])
    //                             ->columns([
    //                                 'sm' => 2
    //                             ]),
    //                         Forms\Components\Select::make('client_id')->relationship('clientsO', 'client_name')->required()->label('Client Name')->reactive(),
    //                         Forms\Components\Select::make('brand_id')->relationship('brandsO', 'brand_name')->required()->label('Brand Name')
    //                             ->options(function (callable $get) {
    //                                 $clientID = $get('client_id');
    //                                 if ($clientID) {
    //                                     return Brand::where('client_id', $clientID)->pluck('brand_name', 'id')->toArray();
    //                                 }
    //                             }),
    //                         Forms\Components\Select::make('media_id')->relationship('mediaO', 'media_name')->required()->label('Media'),
    //                         Forms\Components\Select::make('status_id')->relationship('statusO', 'status')->label('Status'),
    //                         // Forms\Components\Select::make('product_id')->relationship('productsO', 'product_name')->label('Product'),
    //                         Forms\Components\TextInput::make('project')->label('Project'),
    //                         Forms\Components\DatePicker::make('period_start')->label('Period Start')->required(),
    //                         Forms\Components\DatePicker::make('period_end')->label('Period End')->required(),
    //                         Forms\Components\DatePicker::make('prepared'),
    //                         Forms\Components\TextInput::make('revision'),
    //                         Forms\Components\DatePicker::make('date_revision')->label('Date Revision'),
    //                         Forms\Components\TextInput::make('tax')->numeric()->required(),
    //                     ])
    //                     ->columns([
    //                         'sm' => 2
    //                     ]),

    //                 Forms\Components\Repeater::make(name: 'oQuote')
    //                     ->label('Add New Product')
    //                     ->relationship()
    //                     ->defaultItems(1)
    //                     ->schema([
    //                         Forms\Components\Card::make()
    //                             ->schema([
    //                                 Forms\Components\Select::make(name: 'product_id')
    //                                     // ->relationship('qProduct', 'product_name')
    //                                     ->options(Product::query()->pluck(column: 'product_name', key: 'id'))
    //                                     ->required()
    //                                     ->reactive()
    //                                     ->label('Product Name'),
    //                                 Forms\Components\TextInput::make('remarks')
    //                                     ->required(),
    //                                 Forms\Components\DatePicker::make('periodstart')
    //                                     ->label('Period Start')
    //                                     ->reactive(),
    //                                 Forms\Components\DatePicker::make('periodend')
    //                                     ->label('Period End')
    //                                     ->reactive(),
    //                                 Forms\Components\TextInput::make('qty')
    //                                     ->numeric()
    //                                     ->reactive(),
    //                                 Forms\Components\TextInput::make('priced')->numeric()->required()->reactive(),
    //                                 // Forms\Components\TextInput::make('freq'),
    //                             ])
    //                             ->columns([
    //                                 'sm' => 4
    //                             ]),
    //                     ]),
    //             ]),
    //         // Tables\Actions\PDFAction::make()
    //         //     ->label('Add New')

    //     ];
    // }
}
