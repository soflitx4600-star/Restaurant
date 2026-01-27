<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Importaciones para las columnas de la tabla
use Filament\Tables\Columns\TextColumn;
// Importaciones para el formulario (ESTO TE FALTABA)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Cambié el ícono por uno de usuarios

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Nombre
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // 2. Email (Obligatorio y debe ser email)
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                // 3. Contraseña (Se oculta al escribir)
                TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create') // Solo obligatorio al crear
                    ->dehydrated(fn ($state) => filled($state)) // Si está vacío no lo actualiza
                    ->revealable(), // Botoncito para ver la clave

                // 4. Selector de Rol (Conecta con tu tabla de Roles)
                Select::make('role_id')
                    ->relationship('role', 'name') // Busca en la relación 'role' y muestra el 'name'
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->searchable(),
                    
                // ¡Esto está perfecto! Va a mostrar "Admin", "Chef", etc.
                TextColumn::make('role.name')
                    ->label('Rol') // Le ponemos etiqueta bonita
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Agregué el botón de borrar individual
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}