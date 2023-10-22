<?php

namespace App\Http\Controllers\API\Guest;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StockController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 15);

        $stocks =QueryBuilder::for(Stock::class)
            ->with('industry')
            ->allowedFilters([
                AllowedFilter::callback('asc_price', function (Builder $query){
                    $query->orderByRaw('price*lots');
                }),
                AllowedFilter::exact('industry_id'),
            ])
            ->paginate($perPage, '*', 'page', $page);

        return StockResource::collection($stocks);
    }

    public function show(Stock $stock)
    {
        return new StockResource($stock);
    }
}
