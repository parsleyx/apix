<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentReportByDayResource\Pages;
use App\Filament\Resources\AgentReportByDayResource\RelationManagers;
use App\Models\AgentReportByDay;
use App\Models\Package;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class AgentReportByDayResource extends Resource
{
    protected static ?string $navigationGroup = '数据报表';
    protected static ?string $label = '日数据';
    protected static ?string $model = AgentReportByDay::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('package_id')
                            ->label('包')
                            ->relationship(name: 'package', titleAttribute: 'name')
                            ->required()
                            ->columnSpan(10)
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('show')
                            ->label('展现')
                            ->integer()
                            ->required()
                            ->columnSpan(10),
                        Forms\Components\TextInput::make('money')
                            ->label('收益')
                            ->numeric()
                            ->required()
                            ->columnSpan(10),
                        Forms\Components\DatePicker::make('started_at')
                            ->label('日期')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->maxDate(now())
                            ->columnSpan(10),
                    ])
                    ->columns(12)
                    ->columnSpan(8)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.name')->label('包名'),
                Tables\Columns\TextColumn::make('started_at')->label('日期')->formatStateUsing(function ($state) {
                    return (new Carbon($state))->format('Y/m/d');
                }),
                Tables\Columns\TextColumn::make('show')->label('展现'),
                Tables\Columns\TextColumn::make('money')->label('收益'),
            ])
            ->defaultSort('started_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->role == 'admin') {
                    return $query;
                }
                $packageIds = auth()->user()->packages->pluck('id')->toArray();
                return $query->whereIn('package_id', $packageIds);
            });
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
            'index' => Pages\ListAgentReportByDays::route('/'),
            'create' => Pages\CreateAgentReportByDay::route('/create'),
            'edit' => Pages\EditAgentReportByDay::route('/{record}/edit'),
        ];
    }
}
