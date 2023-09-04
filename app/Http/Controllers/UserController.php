<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $timestamp = now()->timestamp;
        $originalFileName = $request->file('avatar')->getClientOriginalName();
        $filename = $timestamp . '_' . $originalFileName;
        $avatarPath = $request->file('avatar')->storeAs('avatars', $filename, 'public');
        $avatarUrl = asset('storage/' . $avatarPath);
        User::create(array_merge($request->all(), ['avatar' => $avatarUrl]));
        return response()->json(['message' => 'User created successfully'], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
            return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
 
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        $avatarPath = str_replace(asset('storage/'), '', $user->avatar);
        \Storage::disk('public')->delete($avatarPath);
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
