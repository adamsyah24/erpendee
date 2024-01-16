<?php

namespace App\Filament\Pages\ProjectWidgets;

use Filament\Forms;
use Filament\Tables;
use Filament\Widgets\TableWidget as PageWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use Filament\Pages\Page;

class Projects extends PageWidget
{
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getTableQuery(): Builder
    {
        return Project::query();
    }

    protected function getTableColumns(): array
    {
        return [
            // Tables\Columns\TextColumn::make('products.product_name', 'product_name')->label('Product Name'),
            Tables\Columns\TextColumn::make('project_name')->label('Project Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('project_desc')->label('Project Description'),
            // Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            // Tables\Columns\TextColumn::make('email'),
            // Tables\Columns\TextColumn::make('website'),
            // Tables\Columns\TextColumn::make('departments_count')->counts('departments')->label('Departments'),
            // Tables\Columns\TextColumn::make('employees_count')->counts('employees')->label('Employees'),
            // Tables\Columns\TextColumn::make('banks_count')->counts('banks')->label('Banks'),
            // Tables\Columns\TextColumn::make('accounts_count')->counts('accounts')->label('Accounts'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                ->form([
                    // Forms\Components\Select::make('product_id')->relationship('products', 'product_name')->required()->label('Product Name'),
                    Forms\Components\TextInput::make('project_name')->maxLength(100)->autofocus(),
                    Forms\Components\TextInput::make('project_desc')->label('Project Description'),
                ]),

                Tables\Actions\EditAction::make()
                ->form([
                    // Forms\Components\Select::make('product_id')->relationship('products', 'product_name')->required()->label('Product Name'),
                    Forms\Components\TextInput::make('project_name')->maxLength(100)->autofocus(),
                    Forms\Components\TextInput::make('project_desc')->label('Project Description'),
                ]),
            ]),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()
            ->form([
                // Forms\Components\Select::make('product_id')->relationship('products', 'product_name')->required()->label('Product Name'),
                Forms\Components\TextInput::make('project_name')->maxLength(100)->autofocus()->required(),
                Forms\Components\TextInput::make('project_desc')->label('Project Description')->required(),
        ]),
        ];
    }
}
