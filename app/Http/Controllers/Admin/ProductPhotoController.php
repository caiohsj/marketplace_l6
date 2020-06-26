<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPhoto;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto($photoId)
    {
        $removedPhoto = ProductPhoto::where('id', $photoId);
        $productId = $removedPhoto->first()->product_id;
        $photoName = $removedPhoto->first()->image;
        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }
        $removedPhoto->delete();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
