@extends("layout/base")
<link rel = "stylesheet" href = "/css/post/edit.css">
@section("content")
<form action = "/post/update/{{$post -> id}}" method = "post" enctype = "multipart/form-data">
    @csrf
    <input type = "text" name = "name" value = @if(old("name") != null)"{{old("name")}}" @else "{{$post -> name}}"@endif id = "name">
    @error("name")
        <p>{{$message}}</p>
    @enderror
    <input type = "file" name = "image" id = "image">
    @error("image")
        <p>{{$message}}</p>
    @enderror
    <textarea name = "content" id = "content">@if(old("content") != null){{old("content")}} @else{{$post -> content}}@endif</textarea>
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
                else
                {
                    foreach($post -> categories as $postCategory)
                    {
                        if($postCategory -> id == $category -> id)
                        {
                            $checked = "checked";
                        }
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