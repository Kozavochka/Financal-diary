<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Assets\Stock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminStockController extends Controller
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


    public function create(StockRequest $request)
    {

    }


    public function store(StockRequest $request)
    {
        $data = $request->validated();

        $stock = Stock::query()
            ->create($data);
        if(isset($data['industry_id']) ){
            $stock->industry()->attach($data['industry_id']);
        }
        return new StockResource($stock);//Сделать другой resource?
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
