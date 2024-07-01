<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = new Category;
        $totalDataCount = $query->count();
        if ($request->has('search') && $request->get('search') != '') {
            $query = $query->where('name', 'like', "%{$request->get('search')}%");
        }
        if ($request->has('sortBy') && $request->get('sortBy') != '') {
            $query = $query->orderBy($request->get('sortBy'), $request->get('sortDesc') === 'true' ? 'desc' : 'asc');
        }
        if ($request->has('page') && $request->get('page') != '') {
            $query = $query->skip(($request->get('page') - 1) * 10)->take(10);
        }

        $data = $query->get();
        $page = (int) ceil($totalDataCount / 10);
        return Inertia::render('Categories/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'page' => $page
        ]);
    }

    public function create()
    {
        if (!app('userCan')('Create Master Category')) {
            return redirect()->route('unauthorized');
        }
        return Inertia::render('Categories/Create', []);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        if (!app('userCan')('Read Master Category')) {
            return redirect()->route('unauthorized');
        }
        return Inertia::render('Categories/Show', [
            'data' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        if (!app('userCan')('Update Master Category')) {
            return redirect()->route('unauthorized');
        }
        return Inertia::render('Categories/Edit', [
            'data' => $category,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updateData = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        $category->update($updateData);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category): void
    {
        $category->delete();
    }
}
