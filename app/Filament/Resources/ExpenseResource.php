<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Importaciones necesarias
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    // Le ponemos un iconito de billete/billetera
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Gastos';
    protected static ?string $modelLabel = 'Gasto';
    // Lo ponemos abajo en el menú
    protected static ?int $navigationSort = 4; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->label('Descripción del Gasto')
                    ->placeholder('Ej: Compra de carne, Luz, Sueldo...')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('amount')
                    ->label('Monto')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                DatePicker::make('expense_date')
                    ->label('Fecha del Gasto')
                    ->default(now()) // Te pone la fecha de hoy por defecto
                    ->required(),

                Select::make('category')
                    ->label('Categoría')
                    ->options([
                        'Proveedores' => 'Proveedores (Mercadería)',
                        'Servicios' => 'Servicios (Luz, Agua, Internet)',
                        'Sueldos' => 'Sueldos / Empleados',
                        'Mantenimiento' => 'Mantenimiento / Limpieza',
                        'Otros' => 'Otros Gastos',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('expense_date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge() // Lo hace ver como una etiqueta de color
                    ->color(fn (string $state): string => match ($state) {
                        'Proveedores' => 'warning',
                        'Servicios' => 'info',
                        'Sueldos' => 'success',
                        'Mantenimiento' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('amount')
                    ->label('Monto')
                    ->money('ars') // Le pone el formato de plata
                    ->sortable(),
            ])
            ->filters([
                // Acá después podemos agregar filtros para ver "solo los gastos de este mes"
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}