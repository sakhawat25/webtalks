@section('title', 'Forgot Password')
<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <x-card title="Recover Your Password">
                    <form action="{{url('admin/forgot-password')}}" method="POST" class="w-100">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Enter Your Email" value="{{old('email')}}" class="form-control @error('email') input-error @enderror">
                            @error('email')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror              
                        </div>
                        <button type="submit" class="btn btn-block btn-grey">Submit</button>
                    </form>             
                </x-card>
            </div>
        </div>
    </div>
</x-layout>