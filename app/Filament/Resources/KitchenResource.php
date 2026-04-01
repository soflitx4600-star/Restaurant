<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KitchenResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KitchenResource extends Resource
{
    // Conectamos esta vista con la tabla de Comandas
    protected static ?string $model = Order::class;

    // Le ponemos un iconito de fuego para la cocina 🔥
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    
    protected static ?string $navigationLabel = 'Pantalla de Cocina';
    protected static ?string $pluralModelLabel = 'Pedidos en Cocina';
    protected static ?string $slug = 'cocina';

    // MAGIA 1: Filtramos para que SOLO vea los pedidos que están pendientes
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'Pendiente');
    }

    // Desactivamos el Formulario (el cocinero no crea ni edita pedidos, solo los despacha)
    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s') // MAGIA 2: La pantalla se actualiza sola cada 10 segundos
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('N° Ticket')
                    ->sortable()
                    ->weight('bold')
                    ->size('lg'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Hora del Pedido')
                    ->date('H:i')
                    ->description(fn (Order $record) => $record->created_at->diffForHumans()), // Dice "Hace 5 minutos"

                // MAGIA 3: Armamos una lista limpia con las cantidades, el nombre del plato y las notas en rojo
                Tables\Columns\TextColumn::make('items_list')
                    ->label('Platos a Preparar')
                    ->getStateUsing(function (Order $record) {
                        $html = '<ul style="list-style-type: none; padding: 0;">';
                        foreach ($record->items as $item) {
                            // Si el mozo le puso una nota, la resaltamos
                            $nota = $item->note ? "<br><small style='color: #ef4444;'>⚠️ Nota: {$item->note}</small>" : '';
                            
                            $html .= "<li style='margin-bottom: 8px;'>
                                        <span style='font-size: 16px; font-weight: bold;'>{$item->quantity}x</span> 
                                        <span style='font-size: 16px;'>{$item->product->name}</span>
                                        {$nota}
                                      </li>";
                        }
                        $html .= '</ul>';
                        return $html;
                    })
                    ->html() // Le decimos a Filament que lea el código HTML de arriba
                    ->wrap(),
            ])
            ->actions([
                // El botón verde para cuando la comida ya está lista
                Tables\Actions\Action::make('despachar')
                    ->label('¡Plato Listo!')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation() // Le pregunta "¿Estás seguro?" por las dudas
                    ->action(function (Order $record) {
                        // Cambia el estado en la base de datos y desaparece de esta pantalla
                        $record->update(['status' => 'Pagado']); // O podés cambiarlo a un estado nuevo que se llame 'Listo'
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            // Como no hay creación ni edición, solo dejamos la vista de la tabla (index)
            'index' => Pages\ListKitchens::route('/'),
        ];
    }


    public static function canViewAny(): bool
    {
        // El Admin (1) o el Cocinero (2) pueden ver la pantalla de la cocina
        return auth()->user()->role_id === 1 || auth()->user()->role_id === 2;
    }
}