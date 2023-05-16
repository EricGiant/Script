<p><h1>Here is a list of all articals that where placed last week</h1></p>
@foreach($articals as $artical)
    <a href = "http://localhost:8000/artical/{{$artical -> id}}" style = "font-weight:bolder; font-size:30px">{{$artical -> title}}</a> <br>
@endforeach