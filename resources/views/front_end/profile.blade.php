@section('title', 'Profile')

<x-front_layout>
    <section class="section-padding mt-5 pt-4">
		<div class="container"> 
            {{-- Show form errors --}}
            @error('name')
                <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms>				
                    <div class="alert alert-danger mb-5 rounded-0" role="alert" id="alert-box">
                        {{$message}}
                    </div>
                </div>
            @enderror

            @error('image')
                <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms>				
                    <div class="alert alert-danger mb-5 rounded-0" role="alert" id="alert-box">
                        {{$message}}
                    </div>
                </div>
            @enderror

            <!-- Password change modal -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-light">
                        <div class="p-3">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{url('profile')}}" id="changePasswordForm" method="POST">
                            @csrf                   
                            <div class="modal-body">                            
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">New Password</th>
                                            <td class="align-middle">
                                                <input type="password" name="password" class="form-control bg-white border-dark">
                                            </td>
                                        </tr>                                    
                                        <tr>
                                            <th class="align-middle">Confirm Password</th>
                                            <td class="align-middle">
                                                <input type="password" name="password_confirmation" class="form-control bg-white border-dark">
                                            </td>
                                        </tr>                                   
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-light">
                        <div class="p-3">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="w-100 text-white">
                                        <img class="w-100 mx-auto border border-light shadow profile-picture rounded" src="{{asset('images/' . auth()->user()->image)}}" alt="Title">
                                        @if (auth()->user()->image !== 'avatar.jpg')
                                            <div class="image-overlay bg-light position-absolute w-100 h-100 rounded d-flex flex-column justify-content-center">
                                                <button id="delete-picture-btn" class="btn btn-primary">Delete</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <form action="{{url('profile')}}" id="update-profile" method="POST" enctype="multipart/form-data">
                            @csrf                   
                            <div class="modal-body">                            
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">Name</th>
                                            <td class="align-middle">
                                                <input type="text" name="name" class="form-control bg-white border-dark" value="{{auth()->user()->name}}">
                                            </td>
                                        </tr>                                    
                                        <tr>
                                            <th class="align-middle">Profile Picture</th>
                                            <td class="align-middle">
                                                <input type="file" name="image" class="form-control bg-white border-dark">
                                            </td>
                                        </tr>                                   
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card border-0">
                        <div class="row mb-5">
                            <div class="col text-right">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pencil"></i> Edit</button>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6 offset-3">
                                <img src="{{asset('images/' . auth()->user()->image)}}" alt="profile image" class="w-100 border border-light shadow profile-picture rounded">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{auth()->user()->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{auth()->user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Registered On</th>
                                                <td>{{auth()->user()->created_at->format('M d, Y')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Comments</th>
                                                <td>{{auth()->user()->comments->count()}}</td>
                                            </tr>  
                                            <tr>
                                                <th>Password</th>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
                                                        <i class="fas fa-key"></i> Change Password
                                                    </button>
                                                </td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>

</x-front_layout>