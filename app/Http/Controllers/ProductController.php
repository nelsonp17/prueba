<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
	public function index(): \Illuminate\Database\Eloquent\Collection
	{
		return Product::all();
	}

	public function create(Request $request): \Illuminate\Http\JsonResponse
	{
		//print_r($request->all());
		$product = new Product();
		$product->name = $request->name;
		$product->price = $request->price;

		if($product->save()){
			return response()->json(['response' => 'producto registrado'], 201);
		}
		return response()->json(['error' => 'producto no registrado'], 201);
	}

	public function show(Request $request): Product
	{
		return Product::find($request->id);
	}

	public function update(Request $request): \Illuminate\Http\JsonResponse
	{
		$product = Product::find($request->id);
		$product->name = $request->name;
		$product->price = $request->price;
		if($product->update()){
			return response()->json(['response' => 'producto actualizado'], 201);
		}
		return response()->json(['response' => 'producto no actualizado'], 200);
	}

	public function destroy(Request $request): \Illuminate\Http\JsonResponse
	{
		$product = Product::find($request->id);
		$product->delete();
		return response()->json(null, 204);
	}

	public function users(Product $product)
	{
		return $product->users;
	}
}
