@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/index.css">
@section("content")
@foreach($articals as $artical)
    <div class = "artical">
        <a href = "/articalShow/{{$artical -> id}}">
            <div class = "category">
                @foreach($artical -> categories as $category)
                    @if($loop -> last)
                        {{$category -> name}}
                    @else
                        {{$category -> name}},
                    @endif
                @endforeach
            </div>
            <div class = "author">
                BY {{$artical -> author -> name}}
            </div>
            <div class = "title">
                {{$artical -> title}}
            </div>
        </a>
    </div>
@endforeach
@endsection