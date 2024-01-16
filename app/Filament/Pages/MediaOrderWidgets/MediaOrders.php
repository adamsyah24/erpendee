<?php

namespace App\Filament\Pages\MediaOrderWidgets;

use App\Models\MediaOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\QuotationProduct;
use App\Models\Brand;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Widgets\TableWidget as PageWidget;
use Illuminate\Database\Eloquent\Builder;


class MediaOrders extends PageWidget
{
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];
    // protected function getTableColumns(): array
    // {
    //     return [
    //         Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
    //         Tables\Columns\TextColumn::make('order_no')->sortable()->searchable(),
    //         Tables\Columns\TextColumn::make('order_series')->sortable()->searchable(),
    //         Tables\Columns\TextColumn::make('created_at')->sortable()->searchable(),            // Add more columns as needed
    //     ];
    // }


    protected function getTableQuery(): Builder
    {
        return MediaOrder::query();
        return Order::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('mo_series_number')->sortable()->searchable()->label('Media Order Series'),
            Tables\Columns\TextColumn::make('quotationM.order_no', 'order_no')->label('Order No')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('quotationM.statusO.status', 'status')->label('Status')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('created_at')->sortable()->searchable(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()
                ->label('Add New Media Order')
                ->form([
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('order_id')->relationship('quotationM', 'order_no')->required()->label('Order Number')->reactive(),
                        Forms\Components\TextInput::make('mo_series_number')->numeric()->label('Media Order Series'),

                    ])
                    ->columns([
                        'sm' => 2,
                    ]),
                ])
            // Tables\Actions\PDFAction::make()
            //     ->label('Add New')

        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                Action::make('Download Pdf')
                    ->icon('heroicon-o-document-download')
                    ->url(fn (MediaOrder $record) => route('mediaorder.pdf.download', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\Select::make('order_id')->relationship('quotationM', 'order_no')->label('Order Number')->reactive(),
                        Forms\Components\TextInput::make('mo_series_number')->numeric()->label('Media Order Series'),

                    ]),

                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make('order_id')->relationship('quotationM', 'order_no')->required()->label('Order Number')->reactive(),
                        Forms\Components\TextInput::make('mo_series_number')->numeric()->label('Media Order Series'),
                    ]),
            ]),
        ];
    }
}
