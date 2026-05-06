<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function home($locale)
    {
        $featuredProducts = $this->dataService->getFeaturedProducts(4);
        $featuredProjects = $this->dataService->getFeaturedProjects(3);
        $collections = $this->dataService->getFeaturedCollections(4);

        return view('pages.home', compact('featuredProducts', 'featuredProjects', 'collections'));
    }

    public function products($locale, Request $request)
    {
        $products = collect($this->dataService->getProducts());
        $categories = $this->dataService->getCategories();

        // Filtering
        if ($request->has('category') && $request->category) {
            $products = $products->where('category', $request->category);
        }

        if ($request->has('material') && is_array($request->material)) {
            $products = $products->whereIn('material', $request->material);
        }

        if ($request->has('look') && is_array($request->look)) {
            $products = $products->whereIn('look', $request->look);
        }

        // Sorting
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'new':
                // Assuming newer items are at the end or have an ID/date (using index for now as proxy if no date)
                $products = $products->reverse();
                break;
            case 'alphabetical':
                $products = $products->sortBy('name');
                break;
            case 'popular':
            default:
                $products = $products->where('featured', true)->concat($products->where('featured', false));
                break;
        }

        return view('pages.products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function productShow($locale, $id)
    {
        $product = $this->dataService->getProductById($id);
        if (!$product)
            abort(404);

        return view('pages.products.show', compact('product'));
    }

    public function projects($locale)
    {
        $projects = $this->dataService->getProjects();
        return view('pages.projects.index', compact('projects'));
    }

    public function projectShow($locale, $id)
    {
        $project = $this->dataService->getProjectById($id);
        if (!$project)
            abort(404);

        return view('pages.projects.show', compact('project'));
    }

    public function professionals($locale)
    {
        return view('pages.professionals');
    }

    public function about($locale)
    {
        return view('pages.about');
    }

    public function contact($locale)
    {
        return view('pages.contact');
    }

    public function legal($locale)
    {
        return view('pages.legal');
    }

    public function privacy($locale)
    {
        return view('pages.privacy');
    }
}
