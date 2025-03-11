<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\PortfolioItemDataTable;
use Illuminate\Http\Request;
use App\Models\PortfolioItem;
use App\Models\Category;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PortfolioItemDataTable $dataTable)
    {
        return $dataTable->render('admin.portfolio-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolio-item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:200'],
            'image' => ['required', 'max:5000'],
            'description' => ['required'],
            'category_id' => ['required', 'numeric'],
            'client' => ['max:200'],
            'website' => ['url'],
        ]);

        $imagePath = handleUpload('image');

        $portfolioItem = new PortfolioItem();
        $portfolioItem->title = $request->title;
        $portfolioItem->category_id = $request->category_id;
        $portfolioItem->description = $request->description;
        $portfolioItem->client = $request->client;
        $portfolioItem->website = $request->website;
        $portfolioItem->image = $imagePath;
        $portfolioItem->save();

        toastr()->success('Portfolio Item created');
        return redirect()->route('admin.portfolio-item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.portfolio-item.edit', compact('portfolioItem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:200'],
            'image' => ['max:5000'],
            'description' => ['required'],
            'category_id' => ['required', 'numeric'],
            'client' => ['max:200'],
            'website' => ['url'],
        ]);

        $portfolioItem = PortfolioItem::findOrFail($id);
        $imagePath = handleUpload('image', $portfolioItem);

        $portfolioItem->title = $request->title;
        $portfolioItem->category_id = $request->category_id;
        $portfolioItem->description = $request->description;
        $portfolioItem->client = $request->client;
        $portfolioItem->website = $request->website;
        $portfolioItem->image = (!empty($imagePath) ? $imagePath : $portfolioItem->image);
        $portfolioItem->save();

        toastr()->success('Portfolio Item updated');
        return redirect()->route('admin.portfolio-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        deleteFileIfExists($portfolioItem->image);
        $portfolioItem->delete();
    }
}
