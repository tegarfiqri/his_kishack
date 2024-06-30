<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = new Story;
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
        return Inertia::render('Articles/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'page' => $page
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Articles/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('articles_image'), $image_name);
        }

        $store = Story::create([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'image_name' => $image_name ?? null,
            'image_path' => $image_name ? 'articles_image/' . $image_name : null,
        ]);

        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $story = Story::find($id);
        return Inertia::render('Articles/Edit', [
            'data' => $story,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $categories = Category::all();
        $story = Story::find($id);
        return Inertia::render('Articles/Show', [
            'data' => $story,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $story = Story::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
        ]);
        $updateData = [
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ];
        $image = $request->file('image');
        $image_name = '';
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('articles_image'), $image_name);
            $updateData['image_name'] = $image->getClientOriginalName();
            $updateData['image_path'] = 'articles_image/' . $image->getClientOriginalName();
        }


        $story->update($updateData);
        return redirect()->route('articles.index');
    }

    public function destroy($id): void
    {
        $story = Story::find($id);
        $story->delete();
    }
}
