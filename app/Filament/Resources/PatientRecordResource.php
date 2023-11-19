<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientRecordResource\Pages;
use App\Filament\Resources\PatientRecordResource\RelationManagers;
use App\Models\PatientRecord;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientRecordResource extends Resource
{
    protected static ?string $model = PatientRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Patient';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
                    ->label('Parent Name')
                    ->required(),
                    TextInput::make('number')
                    ->label('Parent Number')
                    ->required(),
                    TextInput::make('address')
                    ->label('Parent Address')
                    ->required(),
                    Select::make('patient_id')
                    ->label('Patient Name')
                    ->relationship('patient', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload(),
                    FileUpload::make('doc_img')
                    ->image()
                    ->imageEditor()
                    ->directory('/patient_doc')
                    ->columnSpan(2)
                ])->columns(2)
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
            'index' => Pages\ListPatientRecords::route('/'),
            'create' => Pages\CreatePatientRecord::route('/create'),
            'edit' => Pages\EditPatientRecord::route('/{record}/edit'),
        ];
    }
}
