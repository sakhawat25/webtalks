@php
    $currentUrl = url()->current();
    $urlArray = explode('/', $currentUrl);
    $currentUrl = last($urlArray);
@endphp

@section('title', 'Posts')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        @if ($currentUrl !== 'search')
            <a href="{{url('admin')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        @else
            <a href="{{url('admin/posts')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> All Posts
            </a>
        @endif
        
        <a href="{{url('admin/posts/create')}}" class="btn btn-grey">
            Create Post <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <x-searchbox />

    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <tr>
                        <td><a href="{{url('admin/posts/' . $post->id)}}" class="btn-link">{{$post->title}}</a></td>
                        <td>{{$post->category->name}}</td>
                        <td>
                            @if ($post->featured === 1)
                                <x-feature_button link="admin/posts/{{$post->id}}/feature" icon="check" textColor="success" />
                            @else
                                <x-feature_button link="admin/posts/{{$post->id}}/feature" icon="x" textColor="danger" />
                            @endif
                            
                        </td>
                        <td>
                            <div class="d-flex">
                                <x-edit_button link="admin/posts/{{$post->id}}/edit" />
                                <x-delete_button action="admin/posts/{{$post->id}}" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="5" class="text-center">No post available</td>
            @endif                        
        </tbody>
    </table>
</x-layout>