<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// --- IMPORTACIONES QUE FALTABAN ---
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    // --- CAMBIOS VISUALES (La máscara) ---
    protected static ?string $navigationIcon = 'heroicon-o-tag'; // Ícono de etiqueta
    protected static ?string $navigationLabel = 'Categorías';    // En el menú dirá "Categorías"
    protected static ?string $modelLabel = 'Categoría';          // Singular
    protected static ?string $pluralModelLabel = 'Categorías';   // Plural
    // ------------------------------------

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Campo para escribir el nombre de la categoría (Ej: Bebidas)
                TextInput::make('name')
                    ->label('Nombre de la Categoría') 
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Columna para ver el nombre en la lista
                TextColumn::make('serial_no')->label('No.')->rowIndex(),
                TextColumn::make('name')->searchable()->sortable(),    

                
                TextColumn::make('update_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}