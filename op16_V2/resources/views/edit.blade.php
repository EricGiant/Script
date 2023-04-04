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
<form action = "/update/{{$grocery -> id}}" method = "get">
    <input type = "text" name = "name" required value = {{$grocery -> name}} min = "2" max = "255">
    <input type = "number" step = ".01" name = "price" required value = {{$grocery -> price}} min = ".01" max = "9999.99">
    <input type = "number" name = "amount" required value = {{$grocery -> amount}} min = "1" max = "100">
    <select name = "category">
        @foreach($categories as $category)
            <option value = {{$category->id}} @if($category->id == $grocery -> category_id) selected @endif>{{$category->name}}</option>
        @endforeach
    </select>
    <input type = "submit">
</form>
@endsection