<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientParentsResource\Pages;
use App\Filament\Resources\PatientParentsResource\RelationManagers;
use App\Models\PatientParents;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientParentsResource extends Resource
{
    protected static ?string $model = PatientParents::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Patient';

    protected static ?string $navigationLabel = 'Patient Parent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Parent Details')
                    ->description('For Edit, Create, Delete Parent Details')
                    ->schema([
                        TextInput::make('parent_name')
                        ->required(),
                        TextInput::make('parent_mail')
                        ->required()->email(),
                        TextInput::make('parent_number')
                        ->required()->tel(),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('S.No'),
                TextColumn::make('parent_name'),
                TextColumn::make('parent_mail'),
                TextColumn::make('parent_number'),
                TextColumn::make('updated_at')
                ->label('Last vist')
                ->date('d M Y'),
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
            'index' => Pages\ListPatientParents::route('/'),
            'create' => Pages\CreatePatientParents::route('/create'),
            'edit' => Pages\EditPatientParents::route('/{record}/edit'),
        ];
    }    
}
