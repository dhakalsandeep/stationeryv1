<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PublishersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $publishers = Publisher::where('company_infos_id',auth()->user()->company_infos_id)->get();
        return view('publishers.index',compact('publishers'));
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function edit(Publisher $publisher)
    {
        return view('publishers.edit',compact('publisher'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'country' => ['required'],
            'address' => ['required']
            //'image' => 'required|image'
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->country = $request->country;
        $publisher->address = $request->address;
        $publisher->url = $request->url ?? '';
        $publisher->user_id = auth()->user()->id;
        $publisher->company_infos_id = auth()->user()->company_infos_id;
        $publisher->save();
        return redirect(route('publisher.index'));

    }

    public function update(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'country' => ['required'],
            'address' => ['required'],
            'url' => []
        ]);

        $publisher = \App\Publisher::find($id);

        $publisher->name = $request->name;
        $publisher->country = $request->country;
        $publisher->address = $request->address;
        $publisher->url = $request->url ?? '';
        $publisher->modify_by_id = auth()->user()->id;
        $publisher->company_infos_id = auth()->user()->company_infos_id;;
        $publisher->save();
        return redirect(route('publisher.index'));

    }

    public function destroy(Publisher $publisher)
    {
        abort_unless(\Gate::allows('publisher_delete'), 403);

        $publisher->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
