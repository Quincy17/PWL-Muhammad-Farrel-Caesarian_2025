<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showCategory($category)
    {
        // Daftar kategori yang tersedia
        $allowedCategories = ['food-beverage', 'beauty-health', 'home-care', 'baby-kid'];

        // Cek apakah kategori valid
        if (!in_array($category, $allowedCategories)) {
            abort(404, 'Kategori tidak ditemukan');
        }

        return view('products', compact('category'));
    }
}
