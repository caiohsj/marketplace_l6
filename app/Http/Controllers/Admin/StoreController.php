<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create','store']);
    }

    public function index()
    {
        $user = auth()->user();
        $store = $user->store;
        $stores = [$store];

        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }
        $user->store()->create($data);
        flash('Loja criada!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, Store $store)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            if ($store->logo) {
                if (Storage::disk('public')->exists($store->logo)) {
                    Storage::disk('public')->delete($store->logo);
                }
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }
        $store->update($data);
        flash('Loja atualizada!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        flash('Loja removida!')->success();
        return redirect()->route('admin.stores.index');
    }
}
