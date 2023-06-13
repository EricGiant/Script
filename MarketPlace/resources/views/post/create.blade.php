@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/create.css">
@section("content")
<form action = "/post/store" method = "post" enctype = "multipart/form-data">
    @csrf
    <input type = "text" name = "name" value = "{{old("name")}}" id = "name">
    @error("name")
        <p>{{$message}}</p>
    @enderror
    <input type = "file" name = "image" id = "image">
    @error("image")
        <p>{{$message}}</p>
    @enderror
    <textarea name = "content" id = "content">{{old("content")}}</textarea>
    @error("content")
        <p>{{$message}}</p>
    @enderror
    <div id = "categories">
        @foreach($categories as $category)
            @php
                //check if box was checked
                $checked = "";
                if(old("categories") != null)
                {
                    if(in_array($category -> id, old("categories")))
                    {
                        $checked = "checked";
                    }
                }
            @endphp
            <input type = "checkbox" value = "{{$category -> id}}" name = "categories[]" {{$checked}}>{{$category -> name}}<br>
        @endforeach
    </div>
    @error("categories")
        <p>{{$message}}</p>
    @enderror
    <input type = "submit">
</form>
@endsection