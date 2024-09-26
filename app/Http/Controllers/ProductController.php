<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubType;
use App\Models\Type;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['type_product', 'sub_type_product'])->get();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::get();
        $subTypes = SubType::get();

        return view('product.create', compact('types', 'subTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable',
            'sub_type' => 'nullable',
            'role' => 'nullable',
            'image' => 'nullable|max:20000|mimes:jpg,jpeg,png'
        ]);
        $data = $request->except('_token');
        $uploadedFileUrl = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            try {
                $filename = $file->getBasename('.' . $file->getExtension());
                $publicId = date('Y-m-d_His') . '_' . $filename;
                $uploadedFileUrl = cloudinary()->upload(
                    $file->getRealPath(),
                    [
                        'public_id' => $publicId,
                        'folder' => 'product_image'
                    ]
                )->getSecurePath();
            } catch (\Exception $e) {
                $uploadedFileUrl = '';
            }
        }

        Product::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'sub_type' => $data['sub_type'],
            'stock' => $data['stock'],
            'image' => $uploadedFileUrl
        ]);

        return response()->redirectToRoute('product_list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $productId)
    {
        $product = Product::where('id', $productId)->first();
        $types = Type::get();
        $subTypes = SubType::get();

        return view('product.edit', compact('types', 'subTypes', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable',
            'sub_type' => 'nullable',
            'role' => 'nullable',
            'image' => 'nullable|max:20000|mimes:jpg,jpeg,png'
        ]);
        $data = $request->except('_token');
        $product = Product::where('id', $productId)->first();
        $uploadedFileUrl = $product->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            try {
                $filename = $file->getBasename('.' . $file->getExtension());
                $publicId = date('Y-m-d_His') . '_' . $filename;
                $uploadedFileUrl = cloudinary()->upload(
                    $file->getRealPath(),
                    [
                        'public_id' => $publicId,
                        'folder' => 'product_image'
                    ]
                )->getSecurePath();
            } catch (\Exception $e) {
                $uploadedFileUrl = '';
            }
        }

        Product::where('id', $productId)->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'sub_type' => $data['sub_type'],
            'stock' => $data['stock'],
            'image' => $uploadedFileUrl
        ]);

        return response()->redirectToRoute('product_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product, $productId)
    {
        Product::where('id', $productId)->delete();

        return response()->redirectToRoute('product_list');
    }
}
