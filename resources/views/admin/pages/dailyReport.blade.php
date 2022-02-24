<div class="md-contents">
    <h1>
        The total number of posts today: {{ $count }} posts
    </h1>
    @foreach ($posts as $post)
    <h3> {{ $post->title }} </h3>
    <div> {{ \Illuminate\Support\Str::limit($post->body, 250, $end='...') }} </div>
    <h5> Category: {{ $post->category->name }} </h5>
    <h5> By: {{ $post->user->name }} </h5>
    @endforeach
</div>
