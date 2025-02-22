@props(['link', 'icon', 'textColor'])

<a href="{{url($link)}}" class="btn">
    <i
        class="fas fa-{{$icon}} text-{{$textColor}} font-weight-bold"
        style="font-size: 1rem"
    ></i>
</a>
