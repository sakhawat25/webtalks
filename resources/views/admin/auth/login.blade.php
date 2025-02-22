@section('title', 'Admin Login')

<x-layout>
    <div class="row">
        <div class="col-md-6 offset-md-3">            
            <x-card title="Admin Login">
                <form action="{{url('admin/login')}}" method="POST" enctype="multipart/form-data" class="w-100">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" placeholder="Enter Post email" value="{{old('email')}}" class="form-control first-element @error('email') input-error @enderror">
                        @error('email')
                            <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                {{$message}}
                            </div>
                        @enderror  
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter Post password" class="form-control @error('password') input-error @enderror">
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
                        <a href="{{url('admin/forgot-password')}}"><b>Forgot Password?<b></a>
                    </p>               
                </div>   
            </x-card>
        </div>
    </div>
</x-layout>