@extends("layout/base")
<link rel = "stylesheet" href = "/css/profile/edit.css">
@section("content")
@foreach($articals as $artical)
    <div style = "margin-bottom: 15px">
        <a href = "/articalEdit/{{$artical -> id}}" class = "artical">
            <div class = "category">
                @foreach($artical -> categories as $category)
                    @if($loop -> last)
                        {{$category -> name}}
                    @else
                        {{$category -> name}},
                    @endif
                @endforeach
            </div>
            @if($artical -> isPremium)
                <div class = "premium">
                    PREMIUM
                </div>
            @endif
            <div class = "title">
                {{$artical -> title}}
            </div>
        </a>
    </div>
@endforeach
@endsection