@php
    $currentUrl = url()->current();
    $urlArray = explode('/', $currentUrl);
    $currentUrl = last($urlArray);
@endphp

@section('title', 'Categories')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        @if ($currentUrl !== 'search')
            <a href="{{url('admin')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        @else
            <a href="{{url('admin/categories')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> All Categories
            </a>
        @endif
        
        <a href="{{url('admin/categories/create')}}" class="btn btn-grey">
            Create Category <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <x-searchbox />

    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <tr>
                        <td><a href="{{url('admin/categories/' . $category->id)}}" class="btn-link">{{$category->name}}</a></td>
                        <td>{{$category->created_at->format('M d, Y')}}</td>
                        <td>
                            <div class="d-flex">
                                <x-edit_button link="admin/categories/{{$category->id}}/edit" />                            
                                <x-delete_button action="admin/categories/{{$category->id}}" />
                            </div>
                        </td>
                    </tr>
                @endforeach                               
            @else
                <td colspan="3" class="text-center">No category available</td>
            @endif            
        </tbody>        
    </table>
</x-layout>