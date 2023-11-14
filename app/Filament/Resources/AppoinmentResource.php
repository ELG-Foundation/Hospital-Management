<?php

namespace App\Filament\Resources;

use App\Enums\AppoinmentStatus;
use App\Enums\AppointmentStatus;
use App\Enums\PatientStatus;
use App\Filament\Resources\AppoinmentResource\Pages;
use App\Filament\Resources\AppoinmentResource\RelationManagers;
use App\Models\Appoinment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                Section::make([
                    Select::make('patient_parents_id')
                        ->relationship('patient_parents', 'parent_name')
                        ->label('Parent Name')
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
                        ->columnSpan(1)->required(),
                    Select::make('parent_name')
                        ->relationship('patients', 'patient_name')
                        ->label('Patient Name')
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->required()
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
                    DatePicker::make('appoinment_date')
                        ->columnSpan(1)->label('Appointment')
                        ->native(false)->required(),
                    Select::make('status')
                        ->options(AppointmentStatus::class)
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
                TextColumn::make('patient_parents.parent_number')
                    ->searchable()
                    ->label('Parent Number'),
                TextColumn::make('appoinment_date')
                    ->label('Appoinment')
                    ->date(),
                TextColumn::make('status')->badge(),
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
    public static function getModelLabel(): string
    {
        return __('Appointment');
    }
}
