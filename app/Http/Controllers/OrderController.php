<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function list(Request $request)
	{
		$order = Order::find($request->order_id);

		// $order->user;
		foreach ($order->items as $item) {
			$item->product;
		}
		return $order->items;
	}

	// todos los productos de un usuario
	public function allProduct(Request $request)
	{
		$orders = Order::where('user_id', $request->user_id)->get();


		foreach ($orders as $order) {
			foreach ($order->items as $item) {
				$item->product;
			}

		}

		return $orders;
	}

	// todos los usuarios que ha comprado un producto
	public function allProductUser(Request $request)
	{
		$orders = Order::all();


		foreach ($orders as $order) {
			$order->user->name;
			foreach ($order->items as $item) {
				$item->product;
			}

		}

		return $orders;
	}
}
