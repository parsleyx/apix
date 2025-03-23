<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChannelResource\Pages;
use App\Models\Channel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Validation\Rule;
class ChannelResource extends Resource
{
    protected static ?string $label = "渠道管理";
    protected static ?string $model = Channel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('名称')->columnSpan(5),
                Forms\Components\TextInput::make('code')
                ->required()
                ->rules(['required',  fn ($record) => Rule::unique('channels', 'code')->ignore($record)])
                ->label('代码')->columnSpan(5),
                Forms\Components\Radio::make('power')->options([
                    'on' => '开',
                    'off' => '关',
                ])
                ->default('on')
                ->label('状态')
                ->inline()
                ->inlineLabel(false)
                ->columnSpan(span: 7),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('名称'),
                Tables\Columns\TextColumn::make('code')->label('代码'),
                Tables\Columns\TextColumn::make('power')->label('状态')->formatStateUsing(function ($state) {
                    return $state == 'on' ? '开' : '关';
                }),
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
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListChannels::route('/'),
            'create' => Pages\CreateChannel::route('/create'),
            'edit' => Pages\EditChannel::route('/{record}/edit'),
        ];
    }
}
