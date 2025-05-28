@extends('layouts.agent')

@section('title')
    Edit Activity
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Activity
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('agent.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('agent.property.index') }}">Activities</a></li>
            <li class="active">Edit Activity</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Activity Information</h3>
                    </div>
                    <form action="{{ route('agent.property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $property->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" id="price" value="{{ $property->price }}" required>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="activity_type">Activity Type</label>
                                        <select name="activity_type" class="form-control" id="activity_type" required>
                                            <option value="">Select Activity Type</option>
                                            <option value="adventure" {{ $property->activity_type == 'adventure' ? 'selected' : '' }}>Adventure</option>
                                            <option value="cultural" {{ $property->activity_type == 'cultural' ? 'selected' : '' }}>Cultural</option>
                                            <option value="sightseeing" {{ $property->activity_type == 'sightseeing' ? 'selected' : '' }}>Sightseeing</option>
                                            <option value="food" {{ $property->activity_type == 'food' ? 'selected' : '' }}>Food</option>
                                            <option value="relaxation" {{ $property->activity_type == 'relaxation' ? 'selected' : '' }}>Relaxation</option>
                                            <option value="other" {{ $property->activity_type == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $property->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="difficulty_level">Difficulty Level</label>
                                        <select name="difficulty_level" class="form-control" id="difficulty_level" required>
                                            <option value="">Select Difficulty Level</option>
                                            <option value="easy" {{ $property->difficulty_level == 'easy' ? 'selected' : '' }}>Easy</option>
                                            <option value="moderate" {{ $property->difficulty_level == 'moderate' ? 'selected' : '' }}>Moderate</option>
                                            <option value="challenging" {{ $property->difficulty_level == 'challenging' ? 'selected' : '' }}>Challenging</option>
                                            <option value="difficult" {{ $property->difficulty_level == 'difficult' ? 'selected' : '' }}>Difficult</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duration (hours)</label>
                                        <input type="number" name="duration" class="form-control" id="duration" value="{{ $property->duration }}" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <input type="time" name="start_time" class="form-control" id="start_time" value="{{ $property->start_time->format('H:i') }}" required>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_time">End Time</label>
                                        <input type="time" name="end_time" class="form-control" id="end_time" value="{{ $property->end_time->format('H:i') }}" required>
                            </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="min_participants">Minimum Participants</label>
                                        <input type="number" name="min_participants" class="form-control" id="min_participants" value="{{ $property->min_participants }}" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_participants">Maximum Participants</label>
                                        <input type="number" name="max_participants" class="form-control" id="max_participants" value="{{ $property->max_participants }}" min="1">
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" class="form-control" id="city" value="{{ $property->city }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_point">Meeting Point</label>
                                        <input type="text" name="meeting_point" class="form-control" id="meeting_point" value="{{ $property->meeting_point }}" required>
                                    </div>
                                </div>
                                </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="4" required>{{ $property->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="included_items">Included Items (one per line)</label>
                                <textarea name="included_items[]" class="form-control" id="included_items" rows="3">{{ implode("\n", $property->included_items ?? []) }}</textarea>
                                </div>

                            <div class="form-group">
                                <label for="excluded_items">Excluded Items (one per line)</label>
                                <textarea name="excluded_items[]" class="form-control" id="excluded_items" rows="3">{{ implode("\n", $property->excluded_items ?? []) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="cancellation_policy">Cancellation Policy</label>
                                <textarea name="cancellation_policy" class="form-control" id="cancellation_policy" rows="3">{{ $property->cancellation_policy }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Activity Image</label>
                                @if($property->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('uploads/property/'.$property->image) }}" alt="Current Image" style="max-width: 200px;">
                                    </div>
                                    @endif
                                <input type="file" name="image" class="form-control" id="image">
                                <small class="text-muted">Leave empty to keep current image</small>
                                </div>

                            <div class="form-group">
                                <label for="video">Video URL (Optional)</label>
                                <input type="url" name="video" class="form-control" id="video" value="{{ $property->video }}" placeholder="Enter video URL">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_latitude">Latitude</label>
                                        <input type="text" name="location_latitude" class="form-control" id="location_latitude" value="{{ $property->location_latitude }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_longitude">Longitude</label>
                                        <input type="text" name="location_longitude" class="form-control" id="location_longitude" value="{{ $property->location_longitude }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nearby">Nearby Attractions</label>
                                <textarea name="nearby" class="form-control" id="nearby" rows="3">{{ $property->nearby }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="features">Features</label>
                                <select name="features[]" class="form-control select2" multiple="multiple" data-placeholder="Select Features" style="width: 100%;" id="features">
                                    @foreach($features as $feature)
                                        <option value="{{ $feature->id }}" {{ $property->features->contains($feature->id) ? 'selected' : '' }}>{{ $feature->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;" id="tags">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ $property->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="featured" value="1" {{ $property->featured ? 'checked' : '' }}>
                                        Featured Activity
                                    </label>
                                </div>
                                </div>
                            </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any necessary JavaScript here
        $('.select2').select2();
    });
</script>
@endpush