<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppoinmentResource\Pages;
use App\Filament\Resources\AppoinmentResource\RelationManagers;
use App\Models\Appoinment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppoinmentResource extends Resource
{
    protected static ?string $model = Appoinment::class;

    protected static ?string $navigationGroup = 'Patient';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListAppoinments::route('/'),
            'create' => Pages\CreateAppoinment::route('/create'),
            'edit' => Pages\EditAppoinment::route('/{record}/edit'),
        ];
    }    
}
