<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckLogResource\Pages;
use App\Filament\Resources\CheckLogResource\RelationManagers;
use App\Models\CheckLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckLogResource extends Resource
{
    protected static?string $navigationGroup = "日志管理";
    protected static ?string $label = "检测日志";
    protected static ?string $model = CheckLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model')->label('机型'),
                Tables\Columns\TextColumn::make('os_version')->label('操作系统版本'),
                Tables\Columns\TextColumn::make('uuid')->label('用户id'),
                Tables\Columns\TextColumn::make('channel.code')->label('渠道代码'),
                Tables\Columns\TextColumn::make('package_name')->label('包名'),
                Tables\Columns\TextColumn::make('ad_id')->label('广告id'),
                Tables\Columns\TextColumn::make('channel_status')->label('渠道状态'),
                Tables\Columns\TextColumn::make('ad_status')->label('广告状态'),
                Tables\Columns\TextColumn::make('model_status')->label('机型状态'),
                Tables\Columns\TextColumn::make('permission_status')->label('权限状态'),
                Tables\Columns\TextColumn::make('permissions')->limit(40)->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                    $state = $column->getState();
            
                    if (strlen($state) <= $column->getCharacterLimit()) {
                        return null;
                    }
            
                    // Only render the tooltip if the column content exceeds the length limit.
                    return $state;
                })->label('权限'),
                Tables\Columns\TextColumn::make('created_at')->label('创建时间'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                //  Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListCheckLogs::route('/'),
            'create' => Pages\CreateCheckLog::route('/create'),
            'edit' => Pages\EditCheckLog::route('/{record}/edit'),
        ];
    }
}
