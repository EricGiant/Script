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
                <form action = "/edit/{{$grocery -> id}}" method = "get">
                    <input type = "submit" value = "UPDATE">
                </form>
            </th>
        </tr>
    @endforeach
</table>
<p>Total price: {{$totalPrice}}</p>
@endsection