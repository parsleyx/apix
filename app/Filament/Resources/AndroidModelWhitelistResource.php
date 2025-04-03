<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AndroidModelWhitelistResource\Pages;
use App\Filament\Resources\AndroidModelWhitelistResource\RelationManagers;
use App\Models\AndroidModelWhitelist;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class AndroidModelWhitelistResource extends Resource
{
    protected static ?string $label = '机型白名单';
    protected static ?string $model = AndroidModelWhitelist::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('name')->required()->label('名称')->columnSpan(5),
                    Forms\Components\TextInput::make('model')
                        ->required()
                        ->rules(['required', fn($record) => Rule::unique('android_model_whitelists', 'model')->ignore($record)])
                        ->label('机型')
                        ->columnSpan(5),
                    Forms\Components\Radio::make('status')
                        ->label('状态')
                        ->default('enabled')
                        ->options([
                            'enabled' => '启用',
                            'disabled' => '禁用',
                        ])
                        ->inline()
                        ->inlineLabel(false)
                        ->columnSpan(12),
                ])->columns(12)->columnSpan(8)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('名称'),
                Tables\Columns\TextColumn::make('model')->label('机型'),
                Tables\Columns\TextColumn::make('status')->label('状态')->formatStateUsing(function (string $state) {
                    return $state == 'enabled' ? '启用' : '禁用';
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
            'index' => Pages\ListAndroidModelWhitelists::route('/'),
            'create' => Pages\CreateAndroidModelWhitelist::route('/create'),
            'edit' => Pages\EditAndroidModelWhitelist::route('/{record}/edit'),
        ];
    }
}
