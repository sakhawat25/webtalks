@section('title', 'Home')

<x-front_layout>
    @include('partials._hero')

    <x-slider :posts="$featuredPosts" />

    <section class="section-padding pt-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="mb-4 post-list border-bottom pb-4">
                                <div class="row no-gutters">
                                    <div class="col-md-5">
                                        <a class="post-thumb " href="{{url('posts/' . $post->id . '/single')}}">
                                            <img src="{{cloudinary()->getUrl('images/' . $post->image)}}" class="img-fluid w-100">
                                        </a>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="post-article mt-sm-3">
                                            <div class="meta-cat">
                                                <span class="letter-spacing cat-name font-extra text-uppercase font-sm">{{$post->category->name}}</span>
                                            </div>
                                            <h3 class="post-title mt-2">
                                                <a href="{{url('posts/' . $post->id . '/single')}}">{{$post->title}}</a>
                                            </h3>
                                            <div class="post-meta">
                                                <ul class="list-inline">
                                                    <li class="post-like list-inline-item">
                                                        <span class="font-sm letter-spacing-1 text-uppercase"><i class="ti-time mr-2"></i>{{$post->created_at->format('M d, Y')}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="post-content">
                                                {!! Str::substr($post->description, 0, 200) . '...' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$posts->links('paginationlinks')}}
                    
                    @else
                        <p class="text-center">No post available.</p>
                    @endif                    
				</div>

				<div class="col-lg-4 col-md-8 col-sm-12 col-xs-12">
					<div class="sidebar sidebar-right">
						<div class="sidebar-wrap mt-5 mt-lg-0">
							<div class="sidebar-widget about mb-5 text-center p-3">
								<div class="subscribe mb-5">
									<h4 class="text-center widget-title">About</h4>
									<p>Webtalks is a blog, where every news, update is updated regarding web technology.</p>
								</div>
							</div>

							<div class="sidebar-widget follow mb-5 text-center">
                                <h4 class="text-center widget-title">Follow Me</h4>
                                @include('partials._socialLinks')
                            </div>								

							<x-categories :categories="$categories" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</x-front_layout>