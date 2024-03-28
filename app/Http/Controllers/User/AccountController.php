<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user()->customer;
        return view('user.account', compact('user'));
    }

    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        try {
            $attr = $request->validated();

            if ($request->file('image') && $request->file('image')->isValid()) {

                $filename = $request->file('image')->hashName();
                $request->file('image')->storeAs('upload/avatar', $filename, 'public');

                $attr['image'] = $filename;
            }

            $customer->update($attr);

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
