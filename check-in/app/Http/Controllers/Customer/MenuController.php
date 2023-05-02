<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Restaurant $restaurant, Reservation $reservation)
    {
        $menus = $restaurant->menus()->get();

        $categories = Category::where('restaurant_id', $restaurant->id)->paginate(3);

        return view('customer.menus.index', compact('menus','categories','reservation'));
    }

    public function menuDetail(Menu $menu, Reservation $reservation) {

        $reservation_id = intval($reservation->id);

        $categories = Category::join('category_menu', 'categories.id', '=', 'category_menu.category_id')
                      ->where('category_menu.menu_id', $menu->id)
                      ->where('categories.restaurant_id', $menu->restaurant_id)
                      ->first();

        return view('customer.menus.menu-detail',compact('menu','categories','reservation','reservation_id'));
    }
}
