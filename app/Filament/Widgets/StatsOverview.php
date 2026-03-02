<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Expense;
use App\Models\OrderItem; // <-- Importamos los pedidos

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {

        $totalGastos = Expense::sum('amount');

        
        $totalIngresos = OrderItem::with('product')->get()->sum(function ($item) {
      
            return $item->quantity * ($item->product->price ?? 0);
        });

   
        $gananciaNeta = $totalIngresos - $totalGastos;

        return [
            Stat::make('Ingresos Totales', '$' . number_format($totalIngresos, 2, ',', '.'))
                ->description('Plata real de las ventas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Gastos Totales', '$' . number_format($totalGastos, 2, ',', '.'))
                ->description('Lo que salió (Proveedores, Sueldos)')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Ganancia Neta', '$' . number_format($gananciaNeta, 2, ',', '.'))
                ->description('Lo que te queda en el bolsillo')
                ->descriptionIcon('heroicon-m-wallet')
                ->color($gananciaNeta >= 0 ? 'success' : 'danger'),
        ];
    }
}