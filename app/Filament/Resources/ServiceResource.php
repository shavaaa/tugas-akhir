<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;

use App\Models\{Service, Beautician, ServiceSchedule};

use Filament\Tables\Actions\Action;
use Filament\Forms\Components\{Select, DatePicker, TimePicker, TextInput, FileUpload, Textarea};
use Illuminate\Database\Eloquent\{Builder, SoftDeletingScope};
use App\Filament\Resources\ServiceResource\{Pages, RelationManagers};
use Filament\Notifications\Notification;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $label = 'Layanan Kecantikan';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationIcon = 'heroicon-o-scissors';
    protected static ?string $activeNavigationIcon = 'heroicon-s-scissors';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Textarea::make('description')
                    ->required()
                    ->rows(3),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('services')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->size(80),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Action::make('booking')
                    ->label('Booking Layanan')
                    ->visible(fn() => auth()->user()->hasRole('Pengguna'))
                    ->form([
                        Forms\Components\Select::make('service_id')
                            ->label('Pilih Layanan')
                            ->native(false)
                            ->options(Service::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('schedule_id')
                            ->label('Pilih Jadwal')
                            ->native(false)
                            ->options(function () {
                                return ServiceSchedule::available()
                                    ->get()
                                    ->mapWithKeys(function ($schedule) {
                                        $label = date('d M Y', strtotime($schedule->tanggal)) .
                                            ' (' . date('H:i', strtotime($schedule->waktu_mulai)) .
                                            ' - ' . date('H:i', strtotime($schedule->waktu_selesai)) . ')';
                                        return [$schedule->id => $label];
                                    });
                            })

                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('beautician_id')
                            ->label('Terapis')
                            ->native(false)
                            ->options(Beautician::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        // Get the schedule
                        $schedule = ServiceSchedule::findOrFail($data['schedule_id']);

                        // Check if schedule is already booked
                        if ($schedule->isBooked()) {
                            Notification::make()
                                ->title('Jadwal sudah terisi')
                                ->body('Maaf, jadwal ini sudah dibooking oleh pelanggan lain.')
                                ->danger()
                                ->send();

                            return;
                        }

                        // Create the order
                        $order = \App\Models\Order::create([
                            'user_id' => auth()->id(),
                            'service_id' => $data['service_id'],
                            'beautician_id' => $data['beautician_id'],
                            'schedule_id' => $data['schedule_id'],
                            'status' => 'pending',
                        ]);

                        // Update schedule status
                        $schedule->update(['status' => 'terisi']);

                        Notification::make()
                            ->title('Booking berhasil')
                            ->body('Booking layanan berhasil disimpan!')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}



