<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function get_count($title)
    {
        $count = Category::where('title', $title)->count;
        return $count;
    }

    public function index()
    {
        $categories = Category::all();
        if($categories->isEmpty())
            return response()->json(['message' => 'No categories found'], 404);
        else
            return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateClicks($id)
    {
        $category = Category::where('id', $id)->first();
        $category->click_count = $category->click_count + 1;
        $category->update();
        return response()->json([
            'message' => 'Category clicks updated successfully',
            'category' => $category->click_count
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function calculateClicks($period)
    {
        $validPeriods = ['last_24_hours', 'last_week', 'last_month', 'last_year'];

        if (!in_array($period, $validPeriods)) {
            return response()->json(['message' => 'Invalid period'], 400);
        }

        $clicks = Category::select(
            'name',
            DB::raw('SUM(click_count) AS total_clicks'),
            DB::raw('COUNT(DISTINCT user_id) AS unique_clicks')
        )
        ->whereBetween('created_at', $this->getPeriodRange($period))
        ->groupBy('name')
        ->get();

        return response()->json(['clicks' => $clicks]);
    }

    /**
     * Get the date range for the specified period.
     *
     * @param string $period
     * @return array
     */
    private function getPeriodRange($period)
    {
        $now = now();

        switch ($period) {
            case 'last_24_hours':
                return [$now->copy()->subDay(), $now];
            case 'last_week':
                return [$now->copy()->subWeek(), $now];
            case 'last_month':
                return [$now->copy()->subMonth(), $now];
            case 'last_year':
                return [$now->copy()->subYear(), $now];
        }

        return [];
    }
}
