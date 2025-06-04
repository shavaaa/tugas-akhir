<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceScheduleResource\Pages;
use App\Filament\Resources\ServiceScheduleResource\RelationManagers;
use App\Models\ServiceSchedule;
use Doctrine\DBAL\Schema\Column;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class ServiceScheduleResource extends Resource
{
    protected static ?string $model = ServiceSchedule::class;
    protected static ?string $label = 'Jadwal Layanan';
    protected static ?string $pluralLabel = 'Jadwal Layanan';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $activeNavigationIcon = 'heroicon-s-calendar';
    protected static ?string $navigationLabel = 'Jadwal';
    protected static ?int $navigationSort = 6;
    protected static ?string $recordTitleAttribute = 'tanggal';

    public static function syncWaktuSelesai($get, $set): void
    {
        $waktuMulai = $get('waktu_mulai');
        $durasi = $get('durasi');

        if ($waktuMulai && $durasi) {
            try {
                // Pakai Carbon::parse biar fleksibel formatnya
                $mulai = Carbon::parse($waktuMulai);
                $selesai = $mulai->copy()->addMinutes(intval($durasi));

                // Set waktu_selesai dalam format H:i (tanpa detik)
                $set('waktu_selesai', $selesai->format('H:i'));
            } catch (\Exception $e) {
                // Kalau parsing gagal, kosongin
                $set('waktu_selesai', null);
            }
        } else {
            // Kalau salah satu belum diisi
            $set('waktu_selesai', null);
        }
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jadwal')
                    ->description('Atur waktu dan tanggal untuk jadwal layanan')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->native(false)
                            ->minDate(now())
                            ->displayFormat('d/m/Y')
                            ->helperText('Pilih tanggal untuk jadwal layanan')
                            ->rules(['after_or_equal:today'])
                            ->validationMessages([
                                'after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
                            ]),
                            
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'tersedia' => 'Tersedia',
                                'terisi' => 'Terisi',
                                'expired' => 'Expired',
                            ])
                            ->default('tersedia')
                            ->required()
                            ->helperText('Status ketersediaan jadwal'),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TimePicker::make('waktu_mulai')
                                    ->label('Jam Mulai')
                                    ->required()
                                    ->reactive()
                                    ->timezone('Asia/Jakarta')
                                    ->seconds(false)
                                    ->datalist([
                                        '08:00',
                                        '09:00',
                                        '10:00',
                                        '11:00',
                                        '13:00',
                                        '14:00',
                                        '15:00',
                                    ])
                                    ->afterStateUpdated(fn($state, $set, $get) => self::syncWaktuSelesai($get, $set)),

                                Forms\Components\Select::make('durasi')
                                    ->label('Durasi')
                                    ->required()
                                    ->reactive()
                                    ->native(false)
                                    ->options([
                                        30 => '30 Menit',
                                        45 => '45 Menit',
                                        60 => '1 Jam',
                                        90 => '1 Jam 30 Menit',
                                        120 => '2 Jam',
                                    ])
                                    ->afterStateUpdated(fn($state, $set, $get) => self::syncWaktuSelesai($get, $set)),

                                Forms\Components\TextInput::make('waktu_selesai')
                                    ->label('Jam Selesai')
                                    ->required()
                                    ->disabled()
                                    ->live()
                                    ->helperText('Otomatis dihitung dari jam mulai + durasi'),
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-m-calendar-days'),

                Tables\Columns\TextColumn::make('waktu_mulai')
                    ->label('Jam Mulai')
                    ->time('H:i')
                    ->sortable()
                    ->icon('heroicon-m-clock'),

                Tables\Columns\TextColumn::make('waktu_selesai')
                    ->label('Jam Selesai')
                    ->time('H:i')
                    ->sortable()
                    ->icon('heroicon-m-clock'),

                Tables\Columns\TextColumn::make('durasi')
                    ->label('Durasi')
                    ->getStateUsing(function ($record) {
                        $start = Carbon::createFromFormat('H:i:s', $record->waktu_mulai);
                        $end = Carbon::createFromFormat('H:i:s', $record->waktu_selesai);
                        $diff = $end->diffInMinutes($start);

                        if ($diff >= 60) {
                            $hours = floor($diff / 60);
                            $minutes = $diff % 60;
                            return $hours . 'j ' . ($minutes > 0 ? $minutes . 'm' : '');
                        }
                        return $diff . ' menit';
                    })
                    ->badge()
                    ->color('info'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'tersedia',
                        'danger' => 'terisi',
                        'warning' => 'dibatalkan',
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => 'tersedia',
                        'heroicon-o-x-circle' => 'terisi',
                        'heroicon-o-exclamation-triangle' => 'dibatalkan',
                    ]),

                Tables\Columns\TextColumn::make('orders.user.name')
                    ->label('Dipesan Oleh')
                    ->visible(fn($record) => $record && $record->status === 'terisi')
                    ->default('-')
                    ->icon('heroicon-m-user')
                    ->tooltip('Pengguna yang memesan jadwal ini'),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan')
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->catatan;
                    })
                    ->placeholder('Tidak ada catatan')
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->defaultSort('tanggal', 'asc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'terisi' => 'Terisi',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->multiple(),

                Filter::make('tanggal_range')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal')
                            ->native(false),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['dari_tanggal'] ?? null) {
                            $indicators['dari_tanggal'] = 'Dari: ' . Carbon::parse($data['dari_tanggal'])->format('d M Y');
                        }
                        if ($data['sampai_tanggal'] ?? null) {
                            $indicators['sampai_tanggal'] = 'Sampai: ' . Carbon::parse($data['sampai_tanggal'])->format('d M Y');
                        }
                        return $indicators;
                    }),

                Filter::make('hari_ini')
                    ->label('Hari Ini')
                    ->query(fn(Builder $query): Builder => $query->whereDate('tanggal', now()))
                    ->toggle(),

                Filter::make('minggu_ini')
                    ->label('Minggu Ini')
                    ->query(fn(Builder $query): Builder => $query->whereBetween('tanggal', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->tooltip('Lihat Detail'),

                Tables\Actions\EditAction::make()
                    ->tooltip('Edit Jadwal'),

                Tables\Actions\DeleteAction::make()
                    ->tooltip('Hapus Jadwal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Jadwal Pertama')
                    ->icon('heroicon-m-plus'),
            ])
            ->emptyStateHeading('Belum ada jadwal')
            ->emptyStateDescription('Mulai dengan membuat jadwal layanan pertama Anda.')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceSchedules::route('/'),
            'create' => Pages\CreateServiceSchedule::route('/create'),
            'view' => Pages\ViewServiceSchedule::route('/{record}'),
            'edit' => Pages\EditServiceSchedule::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'tersedia')
            ->whereDate('tanggal', '>=', now())
            ->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jadwal tersedia';
    }
}