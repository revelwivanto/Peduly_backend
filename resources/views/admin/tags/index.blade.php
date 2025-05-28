@extends('layouts.admin')

@section('title', 'Tags')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tags</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Tag
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
                                <th>Post</th>
                                <th>Created At</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->post->title ?? 'N/A' }}</td>
                                    <td>{{ $tag->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tag?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No tags found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                <div class="card-footer">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection