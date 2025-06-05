<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mokhosh\FilamentRating\Components\Rating;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    public static function getNavigationLabel(): string
    {
        return auth()->check() && auth()->user()->hasRole('Admin')
            ? 'Pemesanan'
            : 'Pesanan Saya';
    }

    public static function getLabel(): string
    {
        return auth()->check() && auth()->user()->hasRole('Admin')
            ? 'Pemesanan'
            : 'Pesanan Saya';
    }

    public static function getPluralLabel(): string
    {
        return auth()->check() && auth()->user()->hasRole('Admin')
            ? 'Daftar Pemesanan'
            : 'Pesanan Saya';
    }

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard-document-list';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Pemesan')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('service_id')
                    ->label('Layanan')
                    ->relationship('service', 'name')
                    ->required(),
                Forms\Components\Select::make('beautician_id')
                    ->label('Terapis')
                    ->relationship('beautician', 'name')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status Pesanan')
                    ->native(false)
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Diterima',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Nama Layanan')
                    ->sortable(),
                
                    Tables\Columns\TextColumn::make('schedule.tanggal')
                    ->label('Tanggal Booking')
                    ->sortable(),
                Tables\Columns\TextColumn::make('beautician.name')
                    ->label('Nama Terapis')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pesanan')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => 'Menunggu',
                            'approved' => 'Diterima',
                            'rejected' => 'Ditolak',
                            'completed' => 'Selesai',
                            default => $state,
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'completed' => 'primary',
                            default => 'secondary',
                        };
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('review')
                    ->label('Beri Ulasan')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->visible(
                        fn($record) =>
                        auth()->user()->hasRole('Pengguna') &&
                        $record->status === 'completed' &&
                        !$record->hasReview()
                    )
                    ->form([
                        Rating::make('rating')
                            ->label('Rating')
                            ->required(),
                        Forms\Components\Textarea::make('review')
                            ->label('Ulasan')
                            ->placeholder('Bagikan pengalaman Anda tentang layanan ini')
                            ->required(),
                    ])
                    ->action(function (array $data, $record): void {
                        \App\Models\OrderReview::create([
                            'order_id' => $record->id,
                            'rating' => $data['rating'],
                            'review' => $data['review'],
                        ]);
                    })
                    ->successNotificationTitle('Terima kasih atas ulasan Anda!'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // If user is not an admin, only show their own orders
        if (auth()->check() && !auth()->user()->hasRole('Admin')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}


