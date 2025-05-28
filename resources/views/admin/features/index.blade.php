@extends('layouts.admin')

@section('title', 'Features')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Features</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.features.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Feature
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>ID</th>
                                    <th>Name</th>
                                <th>Icon</th>
                                <th>Created At</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($features as $feature)
                                <tr>
                                    <td>{{ $feature->id }}</td>
                                    <td>{{ $feature->name }}</td>
                                    <td><i class="{{ $feature->icon }}"></i> {{ $feature->icon }}</td>
                                    <td>{{ $feature->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('admin.features.edit', $feature) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feature?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No features found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                <div class="card-footer">
                    {{ $features->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection