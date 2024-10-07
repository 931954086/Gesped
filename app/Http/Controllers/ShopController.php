<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProductImageHandler;
use App\Helpers\ShoppingCartManager as HelpersShoppingCartManager;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $totalItemsInCart = HelpersShoppingCartManager::countCartItems();
        $products = Product::all();
        return view('shop.index',  compact('products', 'totalItemsInCart'));
    }
}
