<?php

namespace App\Filament\Resources\Krs;

use App\Filament\Resources\Krs\Pages\ManageKrs;
use App\Models\Krs;
use App\Models\Mahasiswa;
use BackedEnum;
use Dom\Text;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KrsResource extends Resource
{
    protected static ?string $model = Krs::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string | UnitEnum | null $navigationGroup = 'Akademik';

    public static function getPluralLabel(): string
    {
        return 'Kartu Rencana Studi';
    }

    public static function getLabel(): string
    {
        return 'Kartu Rencana Studi';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('mahasiswa_id')
                    ->label('Pilih Mahasiswa (NIM)')
                    ->options(fn() => Mahasiswa::with('user')
                        ->get()
                        ->mapWithKeys(fn($m) => [
                            $m->id => ($m->user?->nim ?? 'N/A') . ' - ' . ($m->nama ?? 'N/A'),
                        ])->toArray())
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('tahun_akademik_id')
                    ->relationship('tahunAkademik', 'tahun')
                    ->label('Tahun Akademik')
                    ->required(),
                Select::make('status')
                    ->options(['belum_isi' => 'Belum isi', 'sudah_isi' => 'Sudah isi', 'disetujui' => 'Disetujui'])
                    ->default('belum_isi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mahasiswa.user.nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mahasiswa.nama')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tahunAkademik.tahun')
                    ->label('Tahun Akademik')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'belum_isi' => 'Belum diisi',
                        'sudah_isi' => 'Sudah diisi',
                        'disetujui' => 'Disetujui',
                        default => $state,
                    })
                    ->colors([
                        'warning' => 'belum_isi',
                        'primary' => 'sudah_isi',
                        'success' => 'disetujui',
                    ])
                    ->badge()
                    ->sortable(),
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
            'index' => ManageKrs::route('/'),
        ];
    }
}
