<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeasiswaResource\Pages;
use App\Models\Beasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class BeasiswaResource extends Resource
{
    protected static ?string $model = Beasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Data Beasiswa';
    protected static ?string $navigationGroup = 'Manajemen Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nim')
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('fakultas')
                ->required(),

            Forms\Components\TextInput::make('ipk')
                ->numeric()
                ->minValue(0)
                ->maxValue(4)
                ->step(0.01)
                ->required(),

            Forms\Components\TextInput::make('jenis')
                ->required(),

            Forms\Components\TextInput::make('nominal')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Forms\Components\TextInput::make('periode')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('nim')->searchable(),
                Tables\Columns\TextColumn::make('fakultas'),
                Tables\Columns\TextColumn::make('ipk'),
                Tables\Columns\TextColumn::make('jenis'),
                Tables\Columns\TextColumn::make('nominal')->money('IDR', true),
                Tables\Columns\TextColumn::make('periode'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Input')
                    ->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeasiswas::route('/'),
            'create' => Pages\CreateBeasiswa::route('/create'),
            'edit' => Pages\EditBeasiswa::route('/{record}/edit'),
        ];
    }
}
