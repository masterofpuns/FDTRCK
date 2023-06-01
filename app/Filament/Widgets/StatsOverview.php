<?php

namespace App\Filament\Widgets;

use App\Models\Fdtrck;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    /** @return array<int, \Filament\Widgets\StatsOverviewWidget\Card> */
    protected function getCards(): array
    {
        $averageScore = Fdtrck::query()->pluck('review_score')->filter()->average();

        if (! is_float($averageScore)) {
            $averageScore = 0.0;
        }

        return [
            Card::make('Trucks', Fdtrck::query()->count())->icon('heroicon-o-truck'),
            Card::make('Gemiddelde score', number_format($averageScore, 2, '.', '').' / 5.00')->icon('heroicon-o-star'),
            Card::make('Aantal recensies', Fdtrck::query()->pluck('review_count')->sum())->icon('heroicon-o-annotation'),
        ];
    }
}
