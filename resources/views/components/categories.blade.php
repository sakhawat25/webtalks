@props(['categories'])
<div class="sidebar-widget category mb-5">
    <h4 class="text-center widget-title">Catgeories</h4>
    <ul class="list-unstyled">
        @foreach ($categories as $category)
            <li class="align-items-center d-flex justify-content-between">
                <a href="{{url('posts/frontend/search?category=' . $category->id)}}">{{$category->name}}</a>
                <span>{{$category->posts->count()}}</span>
            </li>
        @endforeach
    </ul>
</div>