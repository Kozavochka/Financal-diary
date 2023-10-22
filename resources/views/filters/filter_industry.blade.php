<ul class="dropdown-menu">
    @foreach($industries as $industry)
        <li><a class="dropdown-item" href="{{ url()->current() }}?filter[industry_id]={{$industry->id}}">
                {{$industry->name}}</a></li>
    @endforeach

</ul>
