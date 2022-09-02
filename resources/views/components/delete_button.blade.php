@props(['action'])
<form action="{{url($action)}}" method="POST" id="deleteForm">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger px-2" title="Delete">
        <i class="fas fa-trash" title="Delete"></i>
    </button>
</form>
