<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CatygoryService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
      protected CatygoryService $catygoryService
    ) {
    }

    public function index()
    {
        $users = $this->catygoryService->all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = $this->catygoryService->create($data);

        return redirect()->route('users.show', $user->id);
    }

    public function show($id)
    {
        $user = $this->catygoryService->find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->catygoryService->find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'sometimes|confirmed'
        ]);

        $user = $this->catygoryService->update($data, $id);

        return redirect()->route('users.show', $user->id);
    }

    public function destroy($id)
    {
        $this->catygoryService->delete($id);

        return redirect()->route('users.index');
    }
}