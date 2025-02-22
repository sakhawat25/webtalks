@section('title', 'Create Category')

<x-layout>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('admin')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('admin/categories')}}">Categories</a>
        <span class="breadcrumb-item active" aria-current="page">Create Category</span>
    </nav>

    <x-card title="Create Category">
        <form action="{{url('admin/categories')}}" method="POST" class="w-100">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" placeholder="Enter Category Name" value="{{old('name')}}" class="form-control first-element @error('name') input-error @enderror">
                @error('name')
                    <div class="alert alert-danger mt-3 rounded-0" role="alert">
                        {{$message}}
                    </div>
                @enderror              
            </div>
            <button type="submit" class="btn btn-block btn-grey">Create</button>
        </form>
    </x-card>
</x-layout>