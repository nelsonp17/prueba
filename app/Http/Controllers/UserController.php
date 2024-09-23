<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index(): \Illuminate\Database\Eloquent\Collection
	{
		return User::all();
	}

	public function create(Request $request)
	{
		//print_r($request->all());
		$user = new User();
		$user->password = $request->password;
		$user->email = $request->email;
		$user->name = $request->name;

		if($user->save()){
			return response()->json(['response' => 'usuario registrado'], 201);
		}
		return response()->json(['error' => 'usuario no registrado'], 201);

	}

//	public function show(User $user): User
//	{
//		return $user;
//	}
//
//	public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
//	{
//		$user->update($request->all());
//		return response()->json($user, 200);
//	}
//
//	public function destroy(User $user): \Illuminate\Http\JsonResponse
//	{
//		$user->delete();
//		return response()->json(null, 204);
//	}

	public function order(Request $request)
	{
		$order = User::find($request->id);
		return response()->json($order->order, 201);
	}
}
