<section class=" col-span-8 col-start-5 mt-10 space-y-6">
    @auth
        <x-panel>
            <form method="post" action="/posts/{{ $post->slug }}/comments">
                @csrf

                <header class="flex items-center">
                    <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" width="40" height="40" class="rounded-full">
                    <h2 class="ml-4">Want to participate?</h2>
                </header>

                <x-form.textarea name="body" />

                <x-form.button>post</x-form.button>

            </form>
        </x-panel>
    @else
        <p class="font-semibold">
            <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">log in</a> to leave a comment.
        </p>
    @endauth
</section>
