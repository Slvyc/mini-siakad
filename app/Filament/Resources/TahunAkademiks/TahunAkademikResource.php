<?php

namespace App\Filament\Resources\TahunAkademiks;

use App\Filament\Resources\TahunAkademiks\Pages\ManageTahunAkademiks;
use App\Models\TahunAkademik;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TahunAkademikResource extends Resource
{
    protected static ?string $model = TahunAkademik::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static string | UnitEnum | null $navigationGroup = 'Akademik';

    public static function getPluralLabel(): string
    {
        return 'Tahun Akademik';
    }

    public static function getLabel(): string
    {
        return 'Tahun Akademik';
    }

    protected static ?string $recordTitleAttribute = 'tahun';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tahun')
                    ->required()
                    ->unique(),
                Select::make('semester')
                    ->options(['ganjil' => 'Ganjil', 'genap' => 'Genap'])
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->required(),
                DatePicker::make('tanggal_selesai')
                    ->required(),
                Toggle::make('aktif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tahun')
            ->columns([
                TextColumn::make('tahun')
                    ->searchable(),
                TextColumn::make('semester')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'ganjil' => 'GANJIL',
                        'genap' => 'GENAP',
                        default => $state,
                    }),
                TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable(),
                IconColumn::make('aktif')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTahunAkademiks::route('/'),
        ];
    }
}
