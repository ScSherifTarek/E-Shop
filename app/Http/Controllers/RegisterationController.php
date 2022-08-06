<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'type' => ['required', Rule::in(User::TYPES)],
            'store_name' => 'required_if:type,'.User::TYPE_MERCHANT,
        ]);

        return User::create($data);
    }
}
