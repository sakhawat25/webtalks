@section('title', 'Messages')

<x-layout>
    {{-- Show form errors --}}
    @error('messageReply')
        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms>				
            <div class="alert alert-danger mb-5 rounded-0" role="alert" id="alert-box">
                {{$message}}
            </div>
        </div>
    @enderror

    <div class="d-flex justify-content-between mb-5">        
        <a href="{{url('admin')}}" class="btn btn-grey">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-light">
                <div class="p-3">
                    <div class="row mb-3">
                        <div class="col">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <div class="modal-body">                  
                    </div>
                </div>                  
            </div>
        </div>
    </div>

    <x-searchbox />

    <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>From</th>
                <th>On</th>
                <th>View</th>
                <th>Replied</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($messages->count() > 0)
                @foreach ($messages as $message)
                    <tr>
                        <td>{{$message->name}}</td>
                        <td>{{$message->created_at->format('M d, Y')}}</td>
                        <td>
                            <button class="border-0" style="cursor: pointer" title="view message" data-toggle="modal" data-target="#viewMessageModal" data-message="{{$message->id}}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td>
                            @if ($message->is_replied === 1)
                                <i class="fas fa-check text-success font-weight-bold" style="font-size: 1rem"></i>
                            @else
                                <i class="fas fa-x text-danger font-weight-bold" style="font-size: 1rem"></i>
                            @endif
                        </td>
                        <td>
                            <x-delete_button action="admin/messages/{{$message->id}}" />
                        </td>
                    </tr>
                @endforeach
            
            @else
                <tr>
                    <td colspan="5" class="text-center">
                        Currently there is no message available
                    </td>
                </tr>

            @endif
        </tbody>
    </table>
</x-layout>