<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SdkLogResource\Pages;
use App\Filament\Resources\SdkLogResource\RelationManagers;
use App\Models\SdkLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SdkLogResource extends Resource
{
    protected static?string $navigationGroup = "日志管理";
    protected static ?string $label = "SDK日志";
    protected static ?string $model = SdkLog::class;

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
            Tables\Columns\TextColumn::make('status')->label('状态'),
            Tables\Columns\TextColumn::make('created_at')->label('创建时间'),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            //
        ])
        ->actions([
            // Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            // Tables\Actions\BulkActionGroup::make([
            //     //Tables\Actions\DeleteBulkAction::make(),
            // ]),
        ])->modifyQueryUsing(function(Builder $query){
            if(auth()->user()->role == 'admin'){
                return $query;
            }
            $packages = auth()->user()->packages->pluck('name')->toArray();
            return $query->whereIn('package_name', $packages);
        });;
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
            'index' => Pages\ListSdkLogs::route('/'),
            'create' => Pages\CreateSdkLog::route('/create'),
            'edit' => Pages\EditSdkLog::route('/{record}/edit'),
        ];
    }
}
