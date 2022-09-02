@section('title', 'Login')

<x-front_layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <x-card title="Log In To Your Account">
                    <form action="{{url('login')}}" method="POST" class="w-100">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Enter Email" value="{{old('email')}}" class="form-control first-element @error('email') input-error @enderror">
                            @error('email')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control @error('password') input-error @enderror">
                            @error('password')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror 
                            <div class="form-check mt-3">
                                <input name="showpassword" id="showpassword" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="showpassword">
                                Show Password
                                </label>
                            </div>             
                        </div>
                        <button type="submit" class="btn btn-block btn-grey">Login</button>
                    </form>

                    <div class="mt-3 d-flex flex-column">
                        <p class="m-0 mb-1">
                            <a href="{{url('forgot-password')}}"><b>Forgot Password?<b></a>
                        </p>
                        <p class="m-0 mb-1">
                            Don't have an account? <a href="{{url('register')}}"><b>Create Account</b></a>
                        </p>                        
                    </div>               
                </x-card>
            </div>
        </div>
    </div>
</x-front_layout>