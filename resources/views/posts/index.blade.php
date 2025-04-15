@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Published Posts') }}</div>

                <div class="card-body">
                    @forelse ($posts as $post)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                                </h6>
                                <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No posts found.
                        </div>
                    @endforelse

                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 