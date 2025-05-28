@extends('layouts.admin')

@section('title', 'Create Feature')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Feature</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.features.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon (Font Awesome class)</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="e.g., fas fa-home" required>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Enter a Font Awesome icon class (e.g., fas fa-home, fas fa-car, etc.)</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Feature</button>
                        <a href="{{ route('admin.features.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
