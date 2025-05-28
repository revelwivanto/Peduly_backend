<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Property;
use App\Models\Feature;
use App\PropertyImageGallery;
use Carbon\Carbon;
use Toastr;
use Auth;
use File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->latest()->paginate(10);
        return view('agent.properties.index', compact('properties'));
    }

    public function create()
    {   
        $categories = Category::all();
        $features = Feature::all();
        $tags = Tag::all();
        return view('agent.properties.create', compact('categories', 'features', 'tags'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|url',
            'location_latitude' => 'required|numeric',
            'location_longitude' => 'required|numeric',
            'city' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'features' => 'required|array',
            'features.*' => 'exists:features,id',
            'activity_type' => 'required|in:adventure,cultural,sightseeing,food,relaxation,other',
            'difficulty_level' => 'required|in:easy,moderate,challenging,difficult',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
            'max_participants' => 'required|integer|min:1',
            'min_participants' => 'required|integer|min:1|max:max_participants',
            'meeting_point' => 'required|string|max:255',
            'included_items' => 'required|array',
            'included_items.*' => 'string',
            'excluded_items' => 'required|array',
            'excluded_items.*' => 'string',
            'cancellation_policy' => 'required|string',
        ]);

        $slug = Str::slug($request->title);
        $city_slug = Str::slug($request->city);

        if ($request->hasFile('image')) {
        $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/properties'), $imageName);
        }

        $property = Property::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName ?? null,
            'video' => $request->video,
            'location_latitude' => $request->location_latitude,
            'location_longitude' => $request->location_longitude,
            'city' => $request->city,
            'city_slug' => $city_slug,
            'featured' => $request->has('featured'),
            'status' => true,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'activity_type' => $request->activity_type,
            'difficulty_level' => $request->difficulty_level,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
            'max_participants' => $request->max_participants,
            'min_participants' => $request->min_participants,
            'meeting_point' => $request->meeting_point,
            'included_items' => $request->included_items,
            'excluded_items' => $request->excluded_items,
            'cancellation_policy' => $request->cancellation_policy,
        ]);

        $property->features()->attach($request->features);

        return redirect()->route('agent.properties.index')->with('success', 'Activity created successfully.');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $features = Feature::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('agent.properties.edit', compact('property', 'features', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required|numeric',
            'activity_type' => 'required|in:adventure,cultural,sightseeing,food,relaxation,other',
            'difficulty_level' => 'required|in:easy,moderate,challenging,difficult',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'required|integer|min:1',
            'max_participants' => 'nullable|integer|min:1',
            'min_participants' => 'required|integer|min:1',
            'city' => 'required',
            'meeting_point' => 'required',
            'description' => 'required',
            'included_items' => 'nullable|array',
            'excluded_items' => 'nullable|array',
            'cancellation_policy' => 'nullable|string',
            'location_latitude' => 'required',
            'location_longitude' => 'required'
        ]);

        $property = Property::findOrFail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/property')){
                mkdir('uploads/property', 0777, true);
            }
            if(file_exists('uploads/property/'.$property->image)){
                unlink('uploads/property/'.$property->image);
            }
            $image->move('uploads/property', $imagename);
        }else{
            $imagename = $property->image;
        }

        $property->title = $request->title;
        $property->slug = $slug;
        $property->price = $request->price;
        $property->featured = $request->featured ? true : false;
        $property->activity_type = $request->activity_type;
        $property->difficulty_level = $request->difficulty_level;
        $property->image = $imagename;
        $property->start_time = $request->start_time;
        $property->end_time = $request->end_time;
        $property->duration = $request->duration;
        $property->max_participants = $request->max_participants;
        $property->min_participants = $request->min_participants;
        $property->city = $request->city;
        $property->city_slug = Str::slug($request->city);
        $property->meeting_point = $request->meeting_point;
        $property->description = $request->description;
        $property->included_items = $request->included_items;
        $property->excluded_items = $request->excluded_items;
        $property->cancellation_policy = $request->cancellation_policy;
        $property->video = $request->video;
        $property->location_latitude = $request->location_latitude;
        $property->location_longitude = $request->location_longitude;
        $property->nearby = $request->nearby;
        $property->save();

        if($request->features){
        $property->features()->sync($request->features);
        }

        Toastr::success('Activity Successfully Updated', 'Success');
        return redirect()->route('agent.property.index');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        if(file_exists('uploads/property/'.$property->image)){
            unlink('uploads/property/'.$property->image);
            }
        $property->features()->detach();
        $property->delete();
        Toastr::success('Activity Successfully Deleted', 'Success');
        return redirect()->back();
    }

    // DELETE GALERY IMAGE ON EDIT
    public function galleryImageDelete(Request $request){

        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if(Storage::disk('public')->exists('property/gallery/'.$request->image)){
            Storage::disk('public')->delete('property/gallery/'.$request->image);
        }

        if($request->ajax()){

            return response()->json(['msg' => true]);
        }
    }
}
