@extends("layout/base")
<link rel = "stylesheet" href = "/css/artical/index.css">
@section("categorySort")
    <p id = "categoriesSort" onclick = "changeMenu()">SORT BY CATEGORY</p>
    <form method = "get" action = "/artical">
        <div id = "categoriesMenu" style = "display: none">
            <div id = "categoriesSelect">
                @foreach($categories as $category)
                    <input type = "checkbox" value = "{{$category -> id}}" name = "categories[]">
                    {{$category -> name}}<br>
                @endforeach
            </div>
            <input type = "submit" style = "margin-top: 5px">
        </div>
    </form>
@endsection
@section("content")
    @foreach($articals as $artical)
        <div class = "artical">
            <a href = "/artical/{{$artical -> id}}">
                <div class = "category">
                    @php
                        $artical -> categories = $artical -> categories -> implode("name", ", ", "");
                    @endphp
                    {{$artical -> categories}}
                </div>
                <div class = "author">
                    BY {{$artical -> author -> name}}
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
<script src = "/js/artical/index.js"></script>