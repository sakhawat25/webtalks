@section('title', $post->title)

@php
    $tags = explode(',', $post->tags);
@endphp

<x-front_layout>
    <section class="single-block-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-post">
                        <!--Post Header-->
                        <div class="post-header mb-5 text-center">
                            <div class="meta-cat">
                                <a class="post-category font-extra text-color text-uppercase font-sm letter-spacing-1" href="#">{{$post->category->name}}</a>
                            </div>
                            <h2 class="post-title mt-2">
                                {{$post->title}}
                            </h2>
                            <div class="post-meta">
                                <span class="text-uppercase font-sm letter-spacing-1 mr-3">{{$post->author}}</span>
                                <span class="text-uppercase font-sm letter-spacing-1">{{$post->created_at->format('M d, Y')}}</span>
                            </div>
                            <div class="post-featured-image mt-5">
                                <img src="{{cloudinary()->getUrl('images/' . $post->image)}}" class="img-fluid w-100" alt="featured-image">
                            </div>
                        </div>
                        <!--Post Header End-->

                        <!--Post Body-->
                        <div class="post-body">
                            <div class="entry-content">
                                {!! $post->description !!}
                            </div>
                                    
                            <div class="py-3">
                                @foreach ($tags as $tag)
                                    <a href="{{route('frontend.search', ['tag' => $tag])}}" class="btn-grey d-inline-block py-2 px-4 rounded mr-3 mb-2">{{$tag}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!--Comments Section-->
                    <div class="comment-area my-5">
                        <h3 class="mb-4 text-center"><i class="fas fa-comment"></i>  {{$post->comments->count()}} {{Str::plural('Comment', $post->comments->count())}}</h3>
                        @foreach ($post->comments as $comment)
                                {{--comment--}}
                                <div class="comment-area-box media mt-5 pt-4">                                
                                    <img src="{{cloudinary()->getUrl('images/' . $comment->user->image)}}" class="float-left mr-3 mt-2 rounded-circle shadow" style="width: 100px; height: 100px">
                                    <div class="media-body ml-4">
                                        <h4 class="mb-0">{{$comment->user->name}} </h4>
                                        <span class="date-comm font-sm text-capitalize text-color"><i class="fas fa-clock"></i> {{$comment->created_at->format('M d, Y')}} </span>

                                        <div class="comment-content mt-3">
                                            <p>{{$comment->body}}</p>
                                        </div>

                                        @auth
                                            <div class="comment-meta mt-4 mt-lg-0 mt-md-0">
                                                <div x-data="{show: false}">
                                                    <div class="d-flex mb-2">
                                                        <a class="btn btn-linked px-0" class="text-underline" @click="show=  !show">
                                                            Reply
                                                        </a>
                                                        @if ($comment->user_id === auth()->user()->id)
                                                            {{-- Delete Comment Form --}}
                                                            <form action="{{url('comments/' . $comment->id)}}" class="ml-2" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <div x-show="show" x-transition.duration.400ms>
                                                        <form action="{{url('comments/store')}}" method="POST" class="mt-3" id="reply-form">
                                                            @csrf
                                                            <input type="hidden" name="post_id" value="{{$comment->post->id}}">
                                                            <input type="hidden" name="parent_comment" value="{{$comment->id}}">
                                                            <div class="form-group">
                                                                <textarea name="reply" rows="3" class="form-control border border-3 border-dark rounded"></textarea>
                                                            </div>
                                                            <button class="btn btn-success btn-sm">Reply</button>                                                
                                                        </form>
                                                    </div> 
                                                </div>                                                
                                            </div>
                                        @endauth
                                    </div>
                                </div>

                                @foreach ($comment->replies as $reply)
                                    {{--Comment replies--}}
                                    <div class="row my-2">
                                        <div class="col-md-1 col-2"></div>
                                        <div class="col">
                                            <div class="d-flex">                                            
                                                <img src="{{cloudinary()->getUrl('images/' . $reply->user->image)}}" class="float-left mr-3 mt-2 rounded-circle shadow" style="width: 100px; height: 80px">
                                                
                                                <div class="replybox px-2">
                                                    <h4>{{$reply->user->name}}</h4>
                                                    <span class="date-comm font-sm text-capitalize text-color"><i class="fas fa-clock"></i> {{$reply->created_at->format('M d, Y')}} </span>
                                                    <div class="comment-content mt-3">
                                                        <p>{{$reply->body}}</p>
                                                    </div>

                                                    @auth
                                                        <div class="comment-meta mt-4 mt-lg-0 mt-md-0">
                                                            <div x-data="{show: false}">
                                                                <div class="d-flex mb-2">
                                                                    <a class="btn btn-linked px-0" class="text-underline" @click="show=  !show">
                                                                        Reply
                                                                    </a>
                                                                    @if ($reply->user_id === auth()->user()->id)
                                                                        {{-- Delete Comment Form --}}
                                                                        <form action="{{url('comments/' . $reply->id)}}" class="ml-2" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                                <div x-show="show" x-transition.duration.400ms>
                                                                    <form action="{{url('comments/store')}}" method="POST" class="mt-3" id="reply-form">
                                                                        @csrf
                                                                        <input type="hidden" name="post_id" value="{{$reply->post->id}}">
                                                                        <input type="hidden" name="parent_comment" value="{{$reply->id}}">
                                                                        <div class="form-group">
                                                                            <textarea name="reply" rows="3" class="form-control border border-3 border-dark rounded"></textarea>
                                                                        </div>
                                                                        <button class="btn btn-success btn-sm">Reply</button>                                                
                                                                    </form>
                                                                </div> 
                                                            </div>                                               
                                                        </div>
                                                    @endauth
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($reply->replies as $doubleReply)
                                        {{--Reply's reply--}}
                                        <div class="row my-2">
                                            <div class="col-md-2 col-3"></div>
                                            <div class="col">
                                                <div class="d-flex">                                            
                                                    <img src="{{cloudinary()->getUrl('images/' . $doubleReply->user->image)}}" class="float-left mr-3 mt-2 rounded-circle shadow" style="width: 100px; height: 80px">
                                                    
                                                    <div class="replybox px-2">
                                                        <h4>{{$doubleReply->user->name}}</h4>
                                                        <span class="date-comm font-sm text-capitalize text-color"><i class="fas fa-clock"></i> {{$doubleReply->created_at->format('M d, Y')}} </span>
                                                        <div class="comment-content mt-3">
                                                            <p>{{$doubleReply->body}}</p>
                                                        </div>

                                                        @auth
                                                            <div class="comment-meta mt-4 mt-lg-0 mt-md-0">
                                                                <div x-data="{show: false}">
                                                                    <div class="d-flex mb-2">
                                                                        <a class="btn btn-linked px-0" class="text-underline" @click="show=  !show">
                                                                            Reply
                                                                        </a>
                                                                        @if ($doubleReply->user_id === auth()->user()->id)
                                                                            {{-- Delete Comment Form --}}
                                                                            <form action="{{url('comments/' . $doubleReply->id)}}" class="ml-2" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                    <div x-show="show" x-transition.duration.400ms>
                                                                        <form action="{{url('comments/store')}}" method="POST" class="mt-3" id="reply-form">
                                                                            @csrf
                                                                            <input type="hidden" name="post_id" value="{{$doubleReply->post->id}}">
                                                                            <input type="hidden" name="parent_comment" value="{{$doubleReply->id}}">
                                                                            <div class="form-group">
                                                                                <textarea name="reply" rows="3" class="form-control border border-3 border-dark rounded"></textarea>
                                                                            </div>
                                                                            <button class="btn btn-success btn-sm">Reply</button>                                                
                                                                        </form>
                                                                    </div> 
                                                                </div>                                               
                                                            </div>
                                                        @endauth
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>

                                        @foreach ($doubleReply->replies as $tripleReply)
                                            {{--Reply's reply's reply--}}
                                            <div class="row my-2">
                                                <div class="col-md-3 col-4"></div>
                                                <div class="col">
                                                    <div class="d-flex">                                            
                                                        <img src="{{cloudinary()->getUrl('images/' . $tripleReply->user->image)}}" class="float-left mr-3 mt-2 rounded-circle shadow" style="width: 100px; height: 80px">
                                                        
                                                        <div class="replybox px-2">
                                                            <h4>{{$tripleReply->user->name}}</h4>
                                                            <span class="date-comm font-sm text-capitalize text-color"><i class="fas fa-clock"></i> {{$tripleReply->created_at->format('M d, Y')}} </span>
                                                            <div class="comment-content mt-3">
                                                                <p>{{$tripleReply->body}}</p>
                                                            </div>

                                                            @auth
                                                                <div class="comment-meta mt-4 mt-lg-0 mt-md-0">
                                                                    <div class="d-flex mb-2">
                                                                        @if ($doubleReply->user_id === auth()->user()->id)
                                                                            {{-- Delete Comment Form --}}
                                                                            <form action="{{url('comments/' . $tripleReply->id)}}" class="ml-2" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endauth
                                                        </div>                                            
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach

                                <hr>
                        @endforeach                       
                    </div>
                    <!--Comments Section End-->

                    @auth
                        <!--Comments Form-->
                        <form action="{{url('comments/store')}}" method="POST" class="comment-form mb-5 gray-bg p-5" id="comment-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <h3 class="mb-4 text-center">Leave  a comment</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea class="form-control mb-3 @error('comment') input-error @enderror" name="comment" id="comment" cols="30" rows="5" placeholder="Comment"></textarea>
                                    @error('comment')
                                        <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror 
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" name="submit-contact" id="submit_contact" value="Comment">
                        </form>
                    
                    @else
                        <div class="bg-danger text-white py-2 px-3">
                            Please login to comment on this post.
                        </div>

                    @endauth
                </div>
            </div>
        </div>
    </section>
</x-front_layout>