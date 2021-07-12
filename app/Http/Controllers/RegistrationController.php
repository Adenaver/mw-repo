<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationCustomerRequest;
use App\Http\Requests\RegistrationSellerRequest;
use App\Models\Categories;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserCategories;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        //dd($categories);
        return view('auth.register', compact('categories'));
    }
    public function registerSeller(RegistrationSellerRequest $request)
    {
        if ($request->input('password') == $request->input('password_repeat'))
        {
            $result = Seller::create(
                ['companyName' => $request->input('companyName'),
                    'website' => $request->input('website'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password'))]);
            if ($result)
            {
                $categories = $request->input('category');
                foreach (array_keys($categories) as $category)
                {
                    UserCategories::create(
                        ['user_id' => $result->id,
                            'category_id' => Categories::query()->where('category_name', $category)->first()->id
                        ]);

                }
                return redirect()->route('home')->with(['success' => 'Сохраненно']);
            }
            return back()->withErrors(['msg' => 'Ошибка сохранения']);
            //dd($result->id); возвращает id созданной записи
        }
        //dd($request);
    }
    public function registerCustomer(RegistrationCustomerRequest $request)
    {
        $defaultRole = Role::query()->where('slug','user')->first();
        if ($request->input('password') == $request->input('password_repeat'))
        {
            $result = User::create(
                ['name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                    'customer_type' => $request->input('customer_type'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password'))]);
            $result->roles()->attach($defaultRole);
            if ($result) return redirect()->route('home')->with(['success' => 'Сохранено']);
        }
        return back()->withErrors(['msg' => 'Ошибка сохранения']);
    }
}
