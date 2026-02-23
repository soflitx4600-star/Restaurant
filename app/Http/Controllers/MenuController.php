<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; // Importamos el modelo de Categorías

class MenuController extends Controller
{
    public function index()
    {
        // Buscamos todas las categorías (Subjects) y traemos sus productos
        // que estén activos (is_active = true)
        $categories = Subject::with(['products' => function ($query) {
            $query->where('is_active', true);
        }])->get();


        
        return view('menu', compact('categories'));

        }
}