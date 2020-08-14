<html>

<head></head>
<body>
<form method="post" action="{{route('create_post')}}"  enctype="multipart/form-data">
    @csrf
    <input type="text" name="name"></input></br>
    <input type="number" name="price"></input></br>
    <input type="text" name="caption"></input></br>
    <input type="file" name="pic"></input></br>
    <select name="cat_id" >
        <@foreach($category as $cat)>
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        <@endforeach>
    </select>

    <input type="submit" value="submit"></input></br>



</form>


</body>



</html>
