@props(['posts'])

<x-post-featured-card :post="$posts[0]" />
@if($posts->count()>1)
    <div class="lg:grid lg:grid-cols-6">
        {{--skip(1) -> to ignore the post with id=1 because we use it in post-featured-card--}}
        @foreach($posts->skip(1) as $post)
            {{-- span-2 => means that each post take 2 column of 6 column bur span-3 takes 3 column in the first & second loop--}}
            <x-post-card :post="$post" class="{{$loop->iteration<3 ? 'col-span-3' : 'col-span-2'}}" />
        @endforeach
    </div>
@endif
