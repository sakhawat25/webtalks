@section('title', 'Contact')

<x-front_layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <x-card title="Get In Touch">
                    <form action="{{url('contact')}}" method="POST" class="w-100">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name" value="{{old('name')}}" class="form-control first-element @error('name') input-error @enderror">
                            @error('name')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror  
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="text" name="email" placeholder="Enter Your Email" value="{{old('email')}}" class="form-control @error('email') input-error @enderror">
                            @error('email')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror  
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Your Message</label>
                            <textarea name="message" cols="30" rows="10" class="form-control @error('message') input-error @enderror" placeholder="Enter Post message">{{old('message')}}</textarea>
                            @error('message')
                                <div class="alert alert-danger mt-3 rounded-0" role="alert">
                                    {{$message}}
                                </div>
                            @enderror  
                        </div>
                        <button type="submit" class="btn btn-block btn-grey">Send Message</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>    
</x-front_layout>