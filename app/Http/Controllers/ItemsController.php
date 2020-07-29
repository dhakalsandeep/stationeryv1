<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemsType;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$items = Item::where('users_id',auth()->user()->id)->latest()->paginate(20);
//        $items = Item::where('company_infos_id',auth()->user()->company_infos_id)->get();
        $items = DB::table('items as i')
            ->join('publishers as p','i.publishers_id','=','p.id')
            ->join('items_types as it','i.items_types_id','=','it.id')
            ->selectRaw('i.id, i.code, i.name,it.type, i.ro_level, p.name as publisher_name,i.author')
            ->get();
//        dd($items);
        return view('items.index',compact('items'));
    }

    public function edit(Item $item)
    {
        $itemsTypes = ItemsType::all();
        $publishers = Publisher::all();
        return view('items.edit',compact('item','itemsTypes','publishers'));
    }

    public function create()
    {
        $itemsTypes = ItemsType::all();
        $publishers = Publisher::all();

        return view('items.create',compact('itemsTypes','publishers'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $data = request()->validate([
            'code' => 'required',
            'name' => ['required'],
            'items_types_id' => ['required'],
            'isbn' => [],
            'author' => [],
            'publishers_id' => []
            //'image' => 'required|image'
        ]);

        if ($request->items_types_id == 1) {
            $data = request()->validate([
                'code' => 'required',
                'name' => ['required'],
                'items_types_id' => ['required'],
                'isbn' => [],
                'author' => ['required'],
                'publishers_id' => ['required']
            ]);
        }

        $item = new Item();
        $item->code = strtoupper($request->code);
        $item->name = ucwords($request->name);
        $item->items_types_id = $request->items_types_id;
        $item->ro_level = $request->ro_level;
        $item->isbn = $request->isbn ?? '';
        $item->print_date = $request->print_date ?? '';
        $item->revised_date = $request->print_date ?? '';
        $item->author = ucwords($request->author) ?? '';
        $item->publishers_id = $request->publishers_id ?? '';
        $item->users_id = auth()->user()->id;
        $item->company_infos_id = auth()->user()->company_infos_id;
        $item->save();
        return redirect(route('item.index'));

    }

    public function update(Request $request,$id)
    {
        $data = request()->validate([
            'code' => 'required',
            'name' => ['required'],
            'items_types_id' => ['required'],
            'isbn' => [],
            'author' => [],
            'publishers_id' => []
            //'image' => 'required|image'
        ]);


        if ($request->items_types_id == 1) {
            $data = request()->validate([
                'code' => 'required',
                'name' => ['required'],
                'items_types_id' => ['required'],
                'isbn' => [],
                'author' => ['required'],
                'publishers_id' => ['required']
            ]);
        }

        $item = \App\Item::find($id);

        $item->code = $request->code;
        $item->name = $request->name;
        $item->items_types_id = $request->items_types_id;
        $item->ro_level = $request->ro_level;
        $item->isbn = $request->isbn ?? '';
        $item->author = $request->author ?? '';
        $item->publishers_id = $request->publishers_id ?? '';
        $item->modify_by_id = auth()->user()->id;
        $item->save();
        return redirect(route('item.index'));

    }

}
