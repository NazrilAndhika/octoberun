<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventSettingResource\Pages;
use App\Filament\Resources\EventSettingResource\RelationManagers;
use App\Models\EventSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventSettingResource extends Resource
{
    protected static ?string $model = EventSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // KELOMPOK 1: HERO SECTION
                Forms\Components\Section::make('Hero Section')
                    ->description('Pengaturan teks dan gambar untuk bagian paling atas website.')
                    ->schema([
                        Forms\Components\TextInput::make('event_name')
                            ->label('Nama Event (Teks Kecil Orange)')
                            ->required()
                            ->default('OCTOBERUN 2026'),
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul Utama Hero')
                            ->required()
                            ->default('RUN BEYOND LIMITS'),
                        Forms\Components\FileUpload::make('hero_image')
                            ->label('Foto Background Hero')
                            ->image()
                            ->directory('settings') // Akan tersimpan di folder storage/app/public/settings
                            ->columnSpanFull(),
                    ])->columns(2),

                // KELOMPOK 2: STATISTIK BANNER
                Forms\Components\Section::make('Statistik Banner Biru')
                    ->schema([
                        Forms\Components\TextInput::make('target_runners')
                            ->label('Target Peserta')
                            ->required()
                            ->default('3.000+'),
                        Forms\Components\TextInput::make('event_date')
                            ->label('Tanggal Event')
                            ->required()
                            ->default('18 OKTOBER 2026'),
                    ])->columns(2),

                // KELOMPOK 3: TENTANG KAMI
                Forms\Components\Section::make('Tentang Kami')
                    ->schema([
                        Forms\Components\TextInput::make('about_title')
                            ->label('Judul Tentang Kami')
                            ->required()
                            ->default('LEBIH DARI SEKEDAR LARI, INI TENTANG PERUBAHAN.')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('about_text')
                            ->label('Isi Teks Tentang Kami')
                            ->rows(5)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('about_image')
                            ->label('Gambar/Grafis Tentang Kami')
                            ->image()
                            ->directory('settings')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('hero_image')
                    ->label('Foto Hero'),
                Tables\Columns\TextColumn::make('event_name')
                    ->label('Nama Event')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diedit')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListEventSettings::route('/'),
            'create' => Pages\CreateEventSetting::route('/create'),
            'edit' => Pages\EditEventSetting::route('/{record}/edit'),
        ];
    }
}
