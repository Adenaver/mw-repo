<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminEditCustomer;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminClientsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('users')->paginate(10);
        return view('admin.clients', compact('clients'));
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
        $client = DB::table('users')->find($id);
        if ($client) return view('admin.clients-edit', compact('client'));
        abort(404);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminEditCustomer $request, $id)
    {
        $clientInfo = User::query()->find($id);
        $data = $request->all();

        $result = $clientInfo->fill($data)->save();

        if ($result) return redirect()->route('clients.edit', $clientInfo->id)->with(['success' => 'Сохранено']);
        else return back()->withErrors(['msg' => 'Ошибка сохранения']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id != $id) {
            $result = User::query()->findOrFail($id);

            if ($result) {
                $result->delete($result->id);
                return redirect()->route('clients.index')->with(['success' => 'Deleted']);
            } else return back()->withErrors(['msg' => 'Error delete']);
        }
        else{
            return back()->withErrors(['msg' => 'You can’t delete yourself']);
        }
    }
}
