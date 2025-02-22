@section('title', $post->title)

<x-layout>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('admin')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('admin/posts')}}">Posts</a>
        <span class="breadcrumb-item active" aria-current="page">
            @php  echo ($post->title ?? 'View Post'); @endphp
        </span>
    </nav>

    @if ($post)
        <div class="card border-0">
            <div class="card-header text-white text-uppercase bg-dark">
                {{$post->title}}
            </div>
            <div class="card-body">
                <div class="mb-5">
                    <img src="{{cloudinary()->getUrl('images/' . $post->image)}}" class="w-100" alt="{{$post->title}}">
                </div>
                <h4 class="card-title">Description</h4>
                <div class="mb-5">
                    {!! ($post->description) !!}
                </div>
                
                <div class="row mb-5">                       
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Author</h4>
                            <p class="card-text">{{$post->author}}</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Slug</h4>
                            <p class="card-text">{{$post->slug}}</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Category</h4>
                            <a href="{{url('admin/posts/search?category=' . $post->category->id)}}" class="btn-link">{{$post->category->name}}</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Created At</h4>
                            <p class="card-text text-uppercase">{{$post->created_at->format('M d, Y')}}</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Featured</h4>
                            @if ($post->featured === 1)
                                <p class="card-text text-uppercase">
                                    <x-feature_button link="admin/posts/{{$post->id}}/feature" icon="check" textColor="success" />
                                </p>
                            @else
                                <p class="card-text text-uppercase">
                                    <x-feature_button link="admin/posts/{{$post->id}}/feature" icon="x" textColor="danger" />
                                </p>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>

                <h4 class="card-title">Tags</h4>
                @php
                    $tags = explode(',', $post->tags);
                @endphp
                <div class="card-body">
                    <div class="row mb-5">                   
                        @foreach ($tags as $tag)                    
                            <a href="{{url('admin/posts/search?tag=' . $tag)}}" class="btn btn-grey rounded mr-2 mb-2">{{$tag}}</a>
                        @endforeach
                    </div>
                </div>

                <hr>
        
                <a href="{{url('admin/posts/' . $post->id . '/edit')}}" class="btn btn-secondary mr-2"><i class="fas fa-pencil"></i> Edit</a>
                <form class="d-inline" action="{{url('admin/posts/' . $post->id)}}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>                  
            </div>
        </div>
    @else
        <p>The post you are looking for, has been deleted.</p>
    @endif
</x-layout>