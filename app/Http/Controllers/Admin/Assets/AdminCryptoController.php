<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\CryptoRequest;
use App\Models\Assets\Crypto;
use App\Services\Filters\Crypto\CryptoSearchFilter;
use App\Services\Integrations\ByBit\ByBitIntegrationServiceContract;
use App\Services\Sorts\TotalPriceSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class AdminCryptoController extends Controller
{

    protected $bybitIntegrationService;
    public function __construct(ByBitIntegrationServiceContract $bitIntegrationService) {
        $this->bybitIntegrationService = $bitIntegrationService;
    }


    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $cryptos = QueryBuilder::for(Crypto::class)
            ->allowedSorts([
                'name',
                'ticker',
                'lots',
                AllowedSort::custom('price', new TotalPriceSort()),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new CryptoSearchFilter()),
            ])
            ->paginate($perPage, '*', 'page', $page);


        return view('admin.crypto.index', compact('cryptos'));
    }


    public function create()
    {
        return view('admin.crypto.create');
    }


    public function store(CryptoRequest $request)
    {
        $data = $request->validated();

        Crypto::query()
            ->create($data);

        return redirect(route('admin.crypto.index'));
    }


    public function show(Crypto $crypto)
    {
        //
    }

    public function edit(Crypto $crypto)
    {
        return view('admin.crypto.edit', compact('crypto'));
    }


    public function update(CryptoRequest $request, Crypto $crypto)
    {
        $data = $request->validated();

        $crypto->update($data);

        return redirect(route('admin.crypto.index'));
    }


    public function destroy(Crypto $crypto)
    {
        $crypto->delete();

        return redirect(route('admin.crypto.index'));
    }

    public function syncByBit()
    {
        dd($this->bybitIntegrationService->syncCoins());

        return redirect()->back();
    }
}
