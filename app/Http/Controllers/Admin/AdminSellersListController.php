<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Seller;
use App\Models\UserCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSellersListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = DB::table('sellers')->paginate(10);
        return view('admin.sellers', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = Seller::query()->findOrFail($id);
        $categories = Categories::all();

        if ($seller) return view('admin.seller-edit', compact('seller','categories'));

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Seller::query()->find($id);
        $data = $request->all();

        $result = $seller->fill($data)->save();

        if ($result) return redirect()->route('sellers.edit', $seller->id)->with(['success' => 'Сохранено']);

        return back()->withErrors(['msg' => 'Ошибка сохранения']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Seller::query()->findOrFail($id);

        if ($result){
            $result->delete($result->id);
            return redirect()->route('clients.index')->with(['success' => 'Deleted']);
        }
        return back()->withErrors(['msg' => 'Error delete']);
    }
}
