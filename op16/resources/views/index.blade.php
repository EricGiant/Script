@extends("layouts/base")

@section("content")
<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Catogory</th>
    </tr>
    @foreach($groceries as $grocery)
        <tr>
            <th>
                <form action = "/destroy" method = "get">
                    <input type = "submit" value = "REMOVE">
                    <input type = "hidden" name = "id" value = {{$grocery->id}}>
                </form>
            </th>
            <th>{{$grocery->name}}</th>
            <th>{{$grocery->price}}</th>
            <th>{{$grocery->amount}}</th>
            <th>{{$grocery->category->name}}</th>
            <th>
                <form action = "/edit" method = "get">
                    <input type = "submit" value = "UPDATE">
                    <!-- TODO: alleen id hoeft gepost te worden voor een update, de rest van de velden kan dus weg -->
                    <input type = "hidden" name = "id" value = {{$grocery->id}}>
                    <input type = "hidden" name = "name" value = {{$grocery->name}}>
                    <input type = "hidden" name = "price" value = {{$grocery->price}}>
                    <input type = "hidden" name = "amount" value = {{$grocery->amount}}>
                    <input type = "hidden" name = "category" value = {{$grocery->category_id}}>
                </form>
            </th>
        </tr>
    @endforeach
</table>
@endsection