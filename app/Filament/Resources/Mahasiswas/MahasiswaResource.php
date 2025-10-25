<?php

namespace App\Filament\Resources\Mahasiswas;

use App\Filament\Resources\Mahasiswas\Pages\ManageMahasiswas;
use App\Models\Mahasiswa;
use BackedEnum;
use Dom\Text;
use PhpParser\Node\Stmt\Label;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor\TextColor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string | UnitEnum | null $navigationGroup = 'Akademik';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function getPluralLabel(): string
    {
        return 'Mahasiswa';
    }

    public static function getLabel(): string
    {
        return 'Mahasiswa';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'nim')
                    ->Label('Pilih NIM')
                    ->unique()
                    ->required()
                    ->searchable(),
                Select::make('prodi_id')
                    ->relationship('prodi', 'nama_prodi')
                    ->Label('Nama Prodi')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('jumlah_sks')
                    ->required()
                    ->numeric(),
                Select::make('jenis_kelamin')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                    ->required(),
                Select::make('status')
                    ->options(['aktif' => 'Aktif', 'cuti' => 'Cuti', 'lulus' => 'Lulus', 'drop out' => 'Drop out'])
                    ->default('aktif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nama')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                TextColumn::make('user.nim')
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('prodi.nama_prodi')
                    ->label('Nama Prodi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge(),
                TextColumn::make('jumlah_sks')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'aktif' => 'AKTIF',
                        'cuti' => 'CUTI',
                        'lulus' => 'LULUS',
                        'drop out' => 'DROP OUT',
                        default => $state,
                    }),
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
            'index' => ManageMahasiswas::route('/'),
        ];
    }
}
