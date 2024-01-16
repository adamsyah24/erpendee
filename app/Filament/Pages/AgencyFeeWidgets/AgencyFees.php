<?php

namespace App\Filament\Pages\AgencyFeeWidgets;

use App\Models\Account;
use App\Models\AgencyFee;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Department;
use Filament\Forms;
use Filament\Tables;
use Filament\Widgets\TableWidget as PageWidget;
use Illuminate\Database\Eloquent\Builder;


class AgencyFees extends PageWidget
{
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getTableQuery(): Builder
    {
        return AgencyFee::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('agency_fee')->label('Agency Fee'),
        ];
    }
    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                ->form([
                    Forms\Components\TextInput::make('agency_fee')->maxLength(100),
                ]),

                Tables\Actions\EditAction::make()
                ->form([
                    Forms\Components\TextInput::make('agency_fee')->integer()->maxLength(100)->autofocus()->required(),
                ]),
            ]),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()
            ->form([
                Forms\Components\TextInput::make('agency_fee')->integer()->required()->maxLength(100)->autofocus(),
            ]),
        ];
    }
}
