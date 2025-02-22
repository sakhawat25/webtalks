@props(['title', 'value', 'icon', 'link'])
<div class="col-md-4 col-lg-4">
    <div class="card text-start mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">
                        <a href="{{url($link)}}">{{$title}}</a>
                    </h4>
                    <p class="card-text">{{$value}}</p>
                </div>
                <div class="col-4">
                    <i class="fas fa-{{$icon}} stat-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>