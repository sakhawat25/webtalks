@php
    $numPosts = $posts->count();
    $numFeatured = $posts->where('featured', 1)->count();
    $numCategories = $categories->count();
    $numComments = $comments->count();
    $numUsers = $users->count() - 1;
    $numMessages = $messages->count();
@endphp

@section('title', 'Dashboard')

<x-layout>
    <x-card title="Statistics">        
        <x-stat_card title="Posts" value="{{$numPosts}}" icon="computer" link="admin/posts" />
        <x-stat_card title="Featured" value="{{$numFeatured}}" icon="pen" link="admin/posts/featured" />
        <x-stat_card title="Categories" value="{{$numCategories}}" icon="list" link="admin/categories" />
        <x-stat_card title="Comments" value="{{$numComments}}" icon="comment" link="admin/comments" />
        <x-stat_card title="Users" value="{{$numUsers}}" icon="user" link="admin/users" />
        <x-stat_card title="Messages" value="{{$numMessages}}" icon="message" link="admin/messages" />
    </x-card>
    
    <x-card title="Actions">
        <a href="{{url('admin/posts/create')}}" class="btn btn-grey mx-1 my-2">Create Post</a>
        <a href="{{url('admin/categories/create')}}" class="btn btn-grey mx-1 my-2">Create Category</a>
    </x-card>
</x-layout>