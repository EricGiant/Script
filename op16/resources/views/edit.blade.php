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
<form action = "/update" method = "get">
    <!-- TODO: gebruik arrow notatie, dus geen array notatie -->
    <input type = "text" name = "name" required value = {{$_GET["name"]}} min = "2" max = "255">
    <input type = "number" step = ".01" name = "price" required value = {{$_GET["price"]}} min = ".01" max = "9999.99">
    <input type = "number" name = "amount" required value = {{$_GET["amount"]}} min = "1" max = "100">
    <select name = "category">
        @foreach($categories as $category)
            <option value = {{$category->id}} @if($category->id == $_GET["category"]) selected @endif>{{$category->name}}</option>
        @endforeach
    </select>
    <input type = "submit">
    <input type = "hidden" name = "id" value = {{$_GET["id"]}}>
</form>
@endsection