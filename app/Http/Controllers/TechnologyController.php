<?php

namespace App\Http\Controllers;

use App\Models\Tech;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Tech::all();

        return Inertia::render('Technology', [
            'technologies' => $technologies,
        ]);
    }


   
}
