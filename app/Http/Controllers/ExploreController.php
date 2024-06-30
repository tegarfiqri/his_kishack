<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = new Story;
        $totalDataCount = $query->count();
        if ($request->has('search') && $request->get('search') != '') {
            $query = $query->where('name', 'like', "%{$request->get('search')}%");
        }

        if ($request->has('onlyCategory') && $request->get('onlyCategory') != '') {
            $query = $query->where('category_id', $request->get('onlyCategory'));
        }

        $data = $query->with('category')->get();
        $categories = Category::all();
        return Inertia::render('Explore/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $story = Story::with('category')->find($id);
        return Inertia::render('Explore/Show', [
            'story' => $story
        ]);
    }
}
