@section('title', 'Create Post')

<x-layout>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('admin')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('admin/posts')}}">Posts</a>
        <span class="breadcrumb-item active" aria-current="page">Create Post</span>
    </nav>

    <x-card title="Create Post">
        <form action="{{url('admin/posts')}}" method="POST" enctype="multipart/form-data" class="w-100">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" placeholder="Enter Post Title" value="{{old('title')}}" class="form-control first-element @error('title') input-error @enderror">
                @error('title')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror  
            </div>
            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-control" name="category">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" placeholder="Enter Post Author" value="{{old('author')}}" class="form-control @error('author') input-error @enderror">
                @error('author')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror  
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" cols="30" rows="10" id="description" class="form-control @error('description') input-error @enderror" placeholder="Enter Post Description">{{old('description')}}</textarea>
                
                <script>
                    CKEDITOR.replace('description');
                </script>

                @error('description')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror  
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" placeholder="Laravel, PHP, Web Development" value="{{old('tags')}}" class="form-control @error('tags') input-error @enderror">
                @error('tags')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror  
            </div>
            <div class="mb-3">
              <label class="form-label">Image</label>
              <input type="file" class="form-control @error('image') input-error @enderror" name="image" placeholder="Upload post image">
                @error('image')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror  
            </div>
            <button type="submit" class="btn btn-block btn-grey">Create</button>
        </form>
    </x-card>
</x-layout>