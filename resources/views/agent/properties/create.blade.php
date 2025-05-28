@extends('layouts.agent')

@section('title')
    Add New Activity
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add New Activity
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('agent.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('agent.property.index') }}">Activities</a></li>
            <li class="active">Add New Activity</li>
        </ol>
    </section>

    <section class="content">
            <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Activity Information</h3>
                    </div>
                    <form action="{{ route('agent.property.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter activity title" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" required>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="activity_type">Activity Type</label>
                                        <select name="activity_type" class="form-control" id="activity_type" required>
                                            <option value="">Select Activity Type</option>
                                            <option value="adventure">Adventure</option>
                                            <option value="cultural">Cultural</option>
                                            <option value="sightseeing">Sightseeing</option>
                                            <option value="food">Food</option>
                                            <option value="relaxation">Relaxation</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                            <option value="easy">Easy</option>
                                            <option value="moderate">Moderate</option>
                                            <option value="challenging">Challenging</option>
                                            <option value="difficult">Difficult</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Duration (hours)</label>
                                        <input type="number" name="duration" class="form-control" id="duration" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <input type="time" name="start_time" class="form-control" id="start_time" required>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_time">End Time</label>
                                        <input type="time" name="end_time" class="form-control" id="end_time" required>
                            </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="min_participants">Minimum Participants</label>
                                        <input type="number" name="min_participants" class="form-control" id="min_participants" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_participants">Maximum Participants</label>
                                        <input type="number" name="max_participants" class="form-control" id="max_participants" min="1">
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_point">Meeting Point</label>
                                        <input type="text" name="meeting_point" class="form-control" id="meeting_point" placeholder="Enter meeting point" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="included_items">Included Items (one per line)</label>
                                <textarea name="included_items[]" class="form-control" id="included_items" rows="3"></textarea>
                                </div>

                            <div class="form-group">
                                <label for="excluded_items">Excluded Items (one per line)</label>
                                <textarea name="excluded_items[]" class="form-control" id="excluded_items" rows="3"></textarea>
                                </div>

                            <div class="form-group">
                                <label for="cancellation_policy">Cancellation Policy</label>
                                <textarea name="cancellation_policy" class="form-control" id="cancellation_policy" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Activity Image</label>
                                <input type="file" name="image" class="form-control" id="image" required>
                                </div>

                            <div class="form-group">
                                <label for="video">Video URL (Optional)</label>
                                <input type="url" name="video" class="form-control" id="video" placeholder="Enter video URL">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_latitude">Latitude</label>
                                        <input type="text" name="location_latitude" class="form-control" id="location_latitude" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_longitude">Longitude</label>
                                        <input type="text" name="location_longitude" class="form-control" id="location_longitude" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nearby">Nearby Attractions</label>
                                <textarea name="nearby" class="form-control" id="nearby" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="features">Features</label>
                                <select name="features[]" class="form-control select2" multiple="multiple" data-placeholder="Select Features" style="width: 100%;" id="features">
                                    @foreach($features as $feature)
                                        <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;" id="tags">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="featured" value="1">
                                        Featured Activity
                                    </label>
                                </div>
                                </div>
                            </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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