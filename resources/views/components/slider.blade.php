@props(['posts'])
<section class="slider mt-4">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-12 col-sm-12 col-md-12 slider-wrap">                
                @foreach ($posts as $post)
                    <div class="slider-item">
                        <div class="slider-item-content">
                            <div class="post-thumb mb-4">
                                <a href="{{url('posts/' . $post->id . '/single')}}">
                                    <img src="{{asset('images')}}/{{$post->image}}" class="img-fluid">
                                </a>
                            </div>

                            <div class="slider-post-content">
                                <span class="cat-name text-color font-sm font-extra text-uppercase letter-spacing">{{$post->category->name}}</span>
                                <h3 class="post-title mt-1"><a href="{{url('posts/' . $post->id . '/single')}}">{{$post->title}}</a></h3>
                                <span class=" text-muted  text-capitalize">{{$post->created_at->format('M d, Y')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>