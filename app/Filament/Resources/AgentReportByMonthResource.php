<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentReportByMonthResource\Pages;
use App\Filament\Resources\AgentReportByMonthResource\RelationManagers;
use App\Models\AgentReportByMonth;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Support\Carbon;
class AgentReportByMonthResource extends Resource
{
    protected static ?string $navigationGroup = '数据报表';
    protected static ?string $label = '月数据';
    protected static ?string $model = AgentReportByMonth::class;
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
                    return (new Carbon($state))->format('Y/m');
                }),
                Tables\Columns\TextColumn::make('show')->label('展现'),
                Tables\Columns\TextColumn::make('money')->label('收益'),
            ])
            ->defaultSort('started_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->modifyQueryUsing(function(Builder $query){
                if(auth()->user()->role == 'admin'){
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
            'index' => Pages\ListAgentReportByMonths::route('/'),
            'create' => Pages\CreateAgentReportByMonth::route('/create'),
            'edit' => Pages\EditAgentReportByMonth::route('/{record}/edit'),
        ];
    }
}
