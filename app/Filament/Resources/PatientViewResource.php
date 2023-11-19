<?php

namespace App\Filament\Resources;

use App\Enums\BloodType;
use App\Filament\Resources\PatientViewResource\Pages;
use App\Filament\Resources\PatientViewResource\RelationManagers;
use App\Models\PatientView;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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
                    ->required()
                    ->label('Name')
                    ->columns(1),
                    DatePicker::make('dob')
                    ->required()
                    ->label('Date Of Birth')
                    ->native(false),
                    Select::make('blood')
                    ->required()
                    ->label('Blood Tyoe')
                    ->native(false)
                    ->options(BloodType::class),
                    TextInput::make('desc')
                    ->label('Notes')
                    ->required(),
                    FileUpload::make('img')
                    ->image()
                    ->imageEditor()
                    ->label('Image')
                    ->directory('/patiet')
                    ->columnSpan(2),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('dob')
                ->date('d M Y'),
                TextColumn::make('blood_type'),
                TextColumn::make('description'),
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
