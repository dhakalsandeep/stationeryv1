<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suppliers = Supplier::where('company_infos_id',auth()->user()->company_infos_id)->get();
        return view('suppliers.index',compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit',compact('supplier'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'address' => ['required']
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phoneno = $request->phoneno ?? '';
        $supplier->email = $request->email ?? '';
        $supplier->users_id = auth()->user()->id;
        $supplier->company_infos_id = auth()->user()->company_infos_id;
        $supplier->save();
        return redirect(route('supplier.index'));

    }

    public function update(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'address' => ['required']
        ]);


        $supplier = \App\Supplier::find($id);

        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phoneno = $request->phoneno ?? '';
        $supplier->email = $request->email ?? '';
        $supplier->users_id = auth()->user()->id;
        $supplier->save();

        return redirect(route('supplier.index'));

    }
}
