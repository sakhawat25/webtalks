@section('title', 'User Details')

<x-layout>
    <div class="d-flex justify-content-between mb-5">
        <a href="{{url()->previous()}}" class="btn btn-grey">
            <i class="ti-arrow-left"></i> Back
        </a>
    </div>

    @if ($user)
        <div class="card border-0">
            <div class="card-header text-white text-uppercase bg-dark">
                User Details
            </div>
            <div class="card-body">
                <div class="mb-5">
                    <img src="{{asset('images/' . $user->image)}}" style="width: 200px; height: 200px">
                </div>

                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Registered On</th>
                            <td>{{$user->created_at->format('M d, Y')}}</td>
                        </tr>
                        <tr>
                            <th>Comments</th>
                            <td>{{$user->comments->count()}}</td>
                        </tr>   
                    </tbody>
                </table>

                <hr>
        
                <form class="d-inline" action="{{url('admin/users/' . $user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>                  
            </div>
        </div>
    @else
        <p>The post you are looking for, has been deleted.</p>
    @endif
</x-layout>