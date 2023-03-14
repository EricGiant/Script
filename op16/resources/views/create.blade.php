@extends("layouts/base")

@section("content")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
Product Price Amount Category
<form action = "/store" method = "get">
    <input type = "text" name = "name" required min = "2" max = "255">
    <input type = "number" step = ".01" name = "price" required min = ".01" max = "9999.99">
    <input type = "number" name = "amount" required min = "1" max = "100">
    <select name = "category">
        @foreach($categories as $category)
            <option value = {{$category->id}}>{{$category->name}}</option>
        @endforeach
    </select>
    <input type = "submit">
</form>
@endsection