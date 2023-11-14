<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientRecordResource\Pages;
use App\Filament\Resources\PatientRecordResource\RelationManagers;
use App\Models\PatientRecord;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\PatientStatus;
use App\Enums\Status;

class PatientRecordResource extends Resource
{
    protected static ?string $model = PatientRecord::class;

    protected static ?string $navigationGroup = 'Patient';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    FileUpload::make('records')
                        ->columnSpan(2)
                        ->imageEditor()
                        ->previewable(),
                    Select::make('patient_parents_id')
                        ->relationship('patient_parents', 'parent_name')
                        ->label('Parent')
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('parent_name')
                                ->required(),
                            TextInput::make('parent_mail')
                                ->required()->email(),
                            TextInput::make('parent_number')
                                ->required()->tel(),
                        ])
                        ->columnSpan(1),
                    Select::make('patients_id')
                        ->relationship('patients', 'patient_name')
                        ->label('Patient')
                        ->native(false)
                        ->searchable()
                        ->preload()->required()
                        ->createOptionForm([
                            TextInput::make('patient_name'),
                            DatePicker::make('patient_dob')
                                ->native(false),
                            TextInput::make('description'),
                            Select::make('patient_parents_id')
                                ->relationship('patient_parents', 'parent_name')
                                ->label('Parent')
                                ->native(false)
                                ->searchable()
                                ->preload()
                        ]),
                    Select::make('status')
                        ->options(PatientStatus::class)
                        ->native(false),
                    DatePicker::make('visit_date')
                        ->columnSpan(1)
                        ->native(false),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('patients.patient_name')
                    ->searchable()
                    ->label('Patient Name'),
                TextColumn::make('patient_parents.parent_name')
                    ->searchable()
                    ->label('Parent Name'),
                TextColumn::make('visit_date')
                    ->label('Last Visit')
                    ->date(),
                TextColumn::make('status')->badge(),
                ImageColumn::make('records')
                    ->circular()
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPatientRecords::route('/'),
            'create' => Pages\CreatePatientRecord::route('/create'),
            'edit' => Pages\EditPatientRecord::route('/{record}/edit'),
        ];
    }
}
