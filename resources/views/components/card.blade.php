@props(['title'])
<div class="card border-0 my-5">
    <div class="card-header bg-dark text-white text-uppercase">
        {{$title}}
    </div>
    <div class="card-body">
        <div class="container py-3">
            <div class="row">
                {{$slot}}
            </div>
        </div>
    </div>
</div>