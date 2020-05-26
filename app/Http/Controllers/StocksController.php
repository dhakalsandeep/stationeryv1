<?php

namespace App\Http\Controllers;

use App\ItemsManagement;
use App\ItemsRoomRack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stocks = ItemsManagement::where('company_infos_id',auth()->user()->company_infos_id)->get();
        return view('stocks.index',compact('stocks'));
    }

    public function edit(ItemsManagement $stock)
    {
        //dd($stock->items_room_rack());
//        $details = ItemsRoomRack::where('items_managements_id',$stock->id);
        $details = $stock->items_room_rack;

        //dd($stock->items_room_rack);
        return view('stocks.edit',compact('stock','details'));
    }

    public function update(Request $request,$id)
    {
//        $data = request()->validate([
//            'name' => 'required',
//            'country' => ['required'],
//            'address' => ['required'],
//            'url' => []
//        ]);

        $stock = \App\ItemsManagement::findorfail($id);
        //dd($stock->items_room_rack());

        $items_room_rack = DB::table('items_room_racks')->where('items_managements_id',$id)->delete();

        $room_nos = $request->get('room_no');
        $rack_nos = $request->get('rack_no');
        $qtys = $request->get('rack_qty');

        if (is_array($room_nos) || is_object($room_nos)){
            foreach ($room_nos as $key => $room_no)
            {
                $items_room_rack_detail = [];

                $items_room_rack_detail['room_no'] = $room_no;
                $items_room_rack_detail['rack_no'] = $rack_nos[$key];
                $items_room_rack_detail['qty'] = $qtys[$key];

                $items_room_rack = new ItemsRoomRack();
                $items_room_rack->items_managements_id = $id;
                $items_room_rack->room_no = $items_room_rack_detail['room_no'];
                $items_room_rack->rack_no = $items_room_rack_detail['rack_no'];
                $items_room_rack->qty = $items_room_rack_detail['qty'];
                $items_room_rack->users_id = auth()->user()->id;
                $items_room_rack->company_infos_id = auth()->user()->company_infos_id;
                $items_room_rack->save();
            }
        } else {
            $items_room_rack_detail = [];

            $items_room_rack_detail['room_no'] = $room_nos;
            $items_room_rack_detail['rack_no'] = $rack_nos;
            $items_room_rack_detail['qty'] = $qtys;

            $items_room_rack = new ItemsRoomRack();
            $items_room_rack->items_managements_id = $id;
            $items_room_rack->room_no = $items_room_rack_detail['room_no'];
            $items_room_rack->rack_no = $items_room_rack_detail['rack_no'];
            $items_room_rack->qty = $items_room_rack_detail['qty'];
            $items_room_rack->users_id = auth()->user()->id;
            $items_room_rack->company_infos_id = auth()->user()->company_infos_id;
            $items_room_rack->save();
            }

        return redirect(route('stock.edit',$id));

    }
}
