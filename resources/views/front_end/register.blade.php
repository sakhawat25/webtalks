@section('title', 'Registration')

<x-front_layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <x-card title="Create An Account">
                    <form action="{{url('register')}}" method="POST" enctype="multipart/form-data" class="w-100">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name" value="{{old('name')}}" class="form-control first-element @error('name') input-error @enderror">
                            @error('name')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Enter Email" value="{{old('email')}}" class="form-control @error('email') input-error @enderror">
                            @error('email')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control @error('password') input-error @enderror">
                            @error('password')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control @error('password_confirmation') input-error @enderror">
                            @error('password_confirmation')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="image" class="form-control @error('image') input-error @enderror">
                            @error('image')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <button type="submit" class="btn btn-block btn-grey">Register</button>
                    </form>
                    <p class="mt-3">Already have an account? <a href="{{route('login')}}"><b>Login</b></a></p>
                </x-card>
            </div>
        </div>
    </div>
</x-front_layout>