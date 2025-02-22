@php
    $currentUrl = url()->current();
    $urlArray = explode('/', $currentUrl);
    $currentUrl = last($urlArray);
@endphp

@section('title', 'Comments')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        @if ($currentUrl !== 'search')
            <a href="{{url('admin')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        @else
            <a href="{{url('admin/comments')}}" class="btn btn-grey">
                <i class="fas fa-arrow-left"></i> All Comments
            </a>
        @endif
    </div>

    <x-searchbox />

    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>By</th>
                <th>For</th>
                <th>View</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($comments->count() > 0)
                @foreach ($comments as $comment)
                    @switch($currentUrl)
                        @case('search')
                            <tr>
                                <td>{{$comment->userName}}</td>
                                <td><a href="{{url('admin/posts/' . $comment->postId)}}" class="btn-link">{{$comment->postTitle}}</a></td>
                                <td>
                                    <a href="{{url('admin/comments/' . $comment->commentId)}}" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <x-delete_button action="admin/comments/{{$comment->commentId}}" />                            
                                </td>
                            </tr>
                            @break

                        @default
                            <tr>
                                <td>{{$comment->user->name}}</td>
                                <td><a href="{{url('admin/posts/' . $comment->post->id)}}" class="btn-link">{{$comment->post->title}}</a></td>
                                <td>
                                    <a href="{{url('admin/comments/' . $comment->id)}}" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <x-delete_button action="admin/comments/{{$comment->id}}" />                            
                                </td>
                            </tr>                            
                    @endswitch
                @endforeach                               
            @else
                <td colspan="5" class="text-center">No comment available</td>
            @endif            
        </tbody>        
    </table>
</x-layout>