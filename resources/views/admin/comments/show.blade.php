@section('title', 'Single Comment')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        <a href="{{url()->previous()}}" class="btn btn-grey">
            <i class="ti-arrow-left"></i> Back
        </a>
    </div>

    @if ($comment)
        <div class="card border-0">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{asset('images/' . $comment->user->image)}}" style="width: 200px; height: 200px">
                    <h2>{{$comment->user->name}}</h2>
                    <blockquote>{{$comment->body}}</blockquote>
                </div>
                
                <div class="row mb-5">
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Comment Post</h4>
                                <a href="{{url('admin/posts/' . $comment->post->id)}}">{{$comment->post->title}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Commented On</h4>
                                <p class="card-text text-uppercase">{{$comment->created_at->format('M d, Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
        
                <form class="d-inline" action="{{url('admin/comments/' . $comment->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>                  
            </div>
        </div>
    @else
        <p>The comment you are looking for, has been deleted.</p>
    @endif
</x-layout>