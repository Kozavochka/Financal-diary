<?php

namespace App\Http\Controllers\Admin;
;
use App\Http\Controllers\Controller;
use App\Http\Requests\CryptoRequest;
use App\Models\Crypto;

class AdminCryptoController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $crypto = Crypto::query()->paginate($perPage, '*', 'page', $page);


        return view('admin.crypto.index', compact('crypto'));
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
        $crypto->refresh();

        return redirect(route('admin.crypto.index'));
    }


    public function destroy(Crypto $crypto)
    {
        $crypto->delete();

        return redirect(route('admin.crypto.index'));
    }
}
