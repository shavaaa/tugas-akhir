<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderReviewResource\Pages;
use App\Models\OrderReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;

class OrderReviewResource extends Resource
{
    protected static ?string $model = OrderReview::class;
    protected static ?string $label = 'Ulasan Pelanggan';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $activeNavigationIcon = 'heroicon-s-star';
    protected static ?string $navigationLabel = 'Ulasan';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
                Rating::make('rating')
                    ->required()
                    ->stars(5)
                    ->color('warning'),
                Forms\Components\Textarea::make('review')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.id')
                    ->label('Order')
                    ->badge()
                    ->visible(fn() => auth()->user()->hasRole('Admin'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('order.user.name')
                    ->label('Pelanggan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order.service.name')
                    ->label('Layanan')
                    ->sortable(),
                RatingColumn::make('rating')
                    ->label('Rating')
                    ->color('warning'),
                Tables\Columns\TextColumn::make('review')
                    ->label('Ulasan')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Review pada')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListOrderReviews::route('/'),
            'create' => Pages\CreateOrderReview::route('/create'),
            'edit' => Pages\EditOrderReview::route('/{record}/edit'),
        ];
    }
}


