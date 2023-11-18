<?php

namespace App\Filament\Resources;

use App\Enums\BloodType;
use App\Filament\Resources\PatientViewResource\Pages;
use App\Filament\Resources\PatientViewResource\RelationManagers;
use App\Models\PatientView;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
<<<<<<< Updated upstream
=======
use Filament\Forms\Components\FileUpload;
>>>>>>> Stashed changes
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
<<<<<<< Updated upstream
=======
use Filament\Tables\Columns\ImageColumn;
>>>>>>> Stashed changes
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientViewResource extends Resource
{
    protected static ?string $model = PatientView::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Patient';

    protected static ?string $navigationLabel = 'Patient Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
<<<<<<< Updated upstream
                    ->required(),
                    DatePicker::make('dob')
                    ->required()
                    ->native(false),
                    Select::make('blood_type')
                    ->required()
                    ->native(false)
                    ->options([
                        'AB+' => 'AB+',
                        'AB-' => 'AB-'
                    ]),
                    TextInput::make('description')
                    ->required(),
=======
                    ->required()
                    ->columnSpan(1)
                    ->label('Name'),
                    DatePicker::make('dob')
                    ->required()->native(false)
                    ->label('Date Of Birth'),
                    Select::make('blood')
                    ->options(BloodType::class)
                    ->native(false)
                    ->label('Blood Type'),
                    TextInput::make('desc')
                    ->label('Condition Or Note'),
                    FileUpload::make('img')
                    ->directory('/patient')
                    ->image()
                    ->imageEditor()
                    ->label('Image')
                    ->columnSpan(2),
>>>>>>> Stashed changes
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< Updated upstream
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('dob')
                ->date('d M Y'),
                TextColumn::make('blood_type'),
                TextColumn::make('description'),
=======
                ImageColumn::make('img')
                ->label('Image')
                ->circular(),
                TextColumn::make('name')
                ->label('Name'),
                TextColumn::make('dob')
                ->label('Date Of Birth')
                ->date('d M Y'),
                TextColumn::make('blood')
                ->label('Blood Type'),
                TextColumn::make('desc')
                ->label('Notes'),
>>>>>>> Stashed changes
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(false),
                Tables\Actions\DeleteAction::make()
                ->label(false),
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
            'index' => Pages\ListPatientViews::route('/'),
            'create' => Pages\CreatePatientView::route('/create'),
            'edit' => Pages\EditPatientView::route('/{record}/edit'),
        ];
    }
}
