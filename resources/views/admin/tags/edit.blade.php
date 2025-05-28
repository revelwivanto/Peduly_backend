@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $tag->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        <div class="form-group">
                            <label for="post_id">Post</label>
                            <select class="form-control @error('post_id') is-invalid @enderror" id="post_id" name="post_id" required>
                                <option value="">Select a post</option>
                                @foreach($posts as $post)
                                    <option value="{{ $post->id }}" {{ old('post_id', $tag->post_id) == $post->id ? 'selected' : '' }}>
                                        {{ $post->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('post_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Tag</button>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
