<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\User;
use App\PropertyImageGallery; // Assuming this model exists for galleries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $cities = Property::select('city','city_slug')->distinct('city_slug')->get();
        
        $query = Property::query();
        
        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('city_slug', $request->city);
        }
        
        // Filter by activity type
        if ($request->has('type') && $request->type) {
            $query->where('activity_type', $request->type);
        }
        
        // Filter by target
        if ($request->has('target') && $request->target) {
            $query->where('target', $request->target);
        }
        
        // Filter by max price
        if ($request->has('maxprice') && $request->maxprice) {
            $query->where('price', '<=', $request->maxprice);
        }

        // Filter by created date
        if ($request->has('created_date') && $request->created_date) {
            $query->whereDate('created_at', $request->created_date);
        }
        
        $properties = $query->latest()->paginate(12);
        
        return view('frontend.properties.index', compact('properties', 'cities'));
    }
} 