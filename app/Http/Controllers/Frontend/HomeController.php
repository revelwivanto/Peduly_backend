<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $featuredProperties = Property::where('featured', true)
            ->latest()
            ->take(6)
            ->get();

        $latestProperties = Property::latest()
            ->take(8)
            ->get();

        // Get categories without the properties count for now
        $categories = Category::take(6)->get();

        $settings = Setting::first();

        // Get list of images from the public/images directory
        $imageFiles = File::files(public_path('images'));
        $sliderImages = [];
        foreach ($imageFiles as $file) {
            // Get the path relative to the public directory
            $sliderImages[] = 'images/' . $file->getFilename();
        }

        return view('home', compact(
            'featuredProperties',
            'latestProperties',
            'categories',
            'settings',
            'sliderImages'
        ));
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        $settings = Setting::first();
        return view('pages.about', compact('settings'));
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        $settings = Setting::first();
        return view('pages.contact', compact('settings'));
    }
} 