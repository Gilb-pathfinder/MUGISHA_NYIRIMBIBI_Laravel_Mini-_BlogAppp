<x-blog-layout>
    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
        @if ($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @endif
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <span>By {{ $post->user->name }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ $post->created_at->format('M d, Y') }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ $post->views }} views</span>
            </div>

            <div class="prose max-w-none mb-6">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                <div class="flex items-center space-x-4">
                    @auth
                        <form action="{{ route('likes.store', $post) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </form>
                    @endauth
                    <span>{{ $post->likes->count() }} likes</span>
                </div>
                <div class="text-sm text-gray-500">
                    {{ $post->comments->count() }} comments
                </div>
            </div>
        </div>
    </article>

    <!-- Comments Section -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Comments</h2>

        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Add a comment</label>
                    <textarea name="content" id="content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Post Comment
                </button>
            </form>
        @else
            <div class="bg-gray-50 rounded-lg p-4 mb-8">
                <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">log in</a> to post a comment.</p>
            </div>
        @endauth

        <div class="space-y-6">
            @foreach ($post->comments->where('is_approved', true) as $comment)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-start">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="mt-2 text-gray-700">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-blog-layout> 