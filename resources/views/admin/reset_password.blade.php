@section('title', 'Forgot Password')
<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <x-card title="Reset Your Password">
                    <form action="{{url('admin/reset-password')}}" method="POST" class="w-100">
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        @error('token')
                            <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                {{$message}}
                            </div>
                        @enderror    
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Enter Your Email" value="{{old('email')}}" class="form-control @error('email') input-error @enderror">
                            @error('email')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" placeholder="Enter Your Password" class="form-control @error('password') input-error @enderror">
                            @error('password')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Your Password" class="form-control">           
                        </div>
                        <button type="submit" class="btn btn-block btn-grey">Reset</button>
                    </form>             
                </x-card>
            </div>
        </div>
    </div>
</x-layout>