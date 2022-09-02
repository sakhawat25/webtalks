@php
    $currentUrl = url()->current();
    $urlArray = explode('/', $currentUrl);
    $currentUrl = last($urlArray);
@endphp

@section('title', 'Users')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        @if ($currentUrl !== 'search')
            <a href="{{url('admin')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        @else
            <a href="{{url('admin/users')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> All Users
            </a>
        @endif
    </div>

    <x-searchbox />

    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{url('admin/users/' . $user->id)}}" class="btn-link">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->is_verified === 1)
                                <x-feature_button link="admin/users/{{$user->id}}/verify" icon="check" textColor="success" />
                            @else
                                <x-feature_button link="admin/users/{{$user->id}}/verify" icon="x" textColor="danger" />
                            @endif
                            
                        </td>
                        <td>
                            <div class="d-flex">
                                <x-delete_button action="admin/users/{{$user->id}}" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="5" class="text-center">There is no user available.</td>
            @endif                        
        </tbody>
    </table>
</x-layout>