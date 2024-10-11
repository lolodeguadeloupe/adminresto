<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_restaurateur) {
            $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        } else if(auth()->user()->is_admin) {
            $restaurants = Restaurant::all();
        }
        else {
            abort(403);
        }
        return Inertia::render('Restaurant/Index',['restaurants' => $restaurants] );
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('menuCategories','menuItems','orders','openingHours');
        return Inertia::render('Restaurant/Show',compact('restaurant'));
    }

    public function createOrder(Request $request)
    {
        return Inertia::render('Restaurant/CreateOrder');
    }

    public function listMenusByCategory()
    {
        $categories = MenuCategory::with('menuItems')->get();
        $menuList = $categories->map(function ($category) {
            return [
                'name' => $category->name,
                'items' => $category->menuItems->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'description' => $item->description,
                        'price' => $item->price,
                        'available' => $item->available,
                    ];
                }),
            ];
        });
        return Inertia::render('MenuList', ['menuList' => $menuList]);
    }
}