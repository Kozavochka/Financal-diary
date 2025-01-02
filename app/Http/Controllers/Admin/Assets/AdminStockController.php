<?php

namespace App\Http\Controllers\Admin\Assets;


use App\Exports\StocksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Assets\Stock;
use App\Models\Industry;
use App\Services\Export\Pdf\Stock\StockPdfExportService;
use App\Services\Filters\Stock\StockNameContainsFilter;
use App\Services\Sorts\TotalPriceSort;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;


class AdminStockController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $stocks = QueryBuilder::for(Stock::class)
            ->with('industry')
            ->allowedSorts([
                'name',
                'ticker',
                AllowedSort::custom('price', new TotalPriceSort()),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new StockNameContainsFilter()),
                'industry_id'
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.stocks.stocks', compact('stocks'));

    }


    public function create()
    {
        $industries = Industry::query()
            ->distinct()
            ->get();

        return view('admin.stocks.create', compact('industries'));
    }


    public function store(StockRequest $request)
    {
        $data = $request->validated();

        Stock::query()
            ->create($data);

        return redirect(route('admin.stocks.index'));
    }


    public function edit(Stock $stock)
    {
        $stock->loadMissing(['industry']);

        $industries = Industry::query()
            ->whereNot('id', $stock->industry_id)
            ->get();

        return view('admin.stocks.edit', compact('stock', 'industries'));
    }


    public function update(StockRequest $request, Stock $stock)
    {
        $data = $request->validated();

        $stock->update($data);

        return redirect(route('admin.stocks.index'));
    }


    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect(route('admin.stocks.index'));
    }

    public function show(Stock $stock)
    {

    }
    public function excel_export()
    {
        return Excel::download(new StocksExport, 'stocks.xlsx');
    }

    public function pdf_export()
    {
        /** @var StockPdfExportService $pdfService */
        $pdfService = resolve(StockPdfExportService::class);
        $pdfService->export();

        return redirect(route('admin.stocks.index'));
    }
}
