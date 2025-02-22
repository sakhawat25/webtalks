@section('title', $category->name)

<x-layout>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('admin')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{url('admin/categories')}}">Categories</a>
        <span class="breadcrumb-item active" aria-current="page">{{$category->name}}</span>
    </nav>

    @if ($category)
        <div class="card border-0">
            <div class="card-header text-white text-uppercase bg-dark">
                {{$category->name}}
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Created At</h4>
                            <p class="card-text text-uppercase">{{$category->created_at->format('M d, Y')}}</p>
                        </div>
                        </div>
                    </div>
                </div>

                <hr>
                
                <a href="{{url('admin/categories/' . $category->id . '/edit')}}" class="btn btn-secondary mr-2"><i class="fas fa-pencil"></i> Edit</a>
                <form class="d-inline" action="{{url('admin/categories/' . $category->id)}}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>                  
            </div>
        </div>
    @else
        <p>The category you are looking for, has been deleted.</p>
    @endif
</x-layout>