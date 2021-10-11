<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>



<div class="container">

    <br>

    <div style="display:block">
        <h4 style="display:inline-block">Привет, {{ Auth::user()->name }}</h4> /
        <a style="display:inline-block" href="{{ route('Beer.create') }}">Добавить пиво</a>
        <form style="float:right" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">Выйти</button>
        </form>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Название пива</th>
            <th scope="col">Описание</th>
            <th scope="col">Изображение</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($beers as $beer)

            <tr>
                <td scope="row">{{$beer->name}}</td>
                <td>{{ \Illuminate\Support\Str::limit($beer->description,4) }}</td>
                <td><img src="{{asset('storage/beers/thumbnail') . $beer->image}}"></td>
                <td scope="col"><a href="{{ route('Beer.edit', $beer) }}">Редактировать</a></td>
                <td scope="col">
                    <form method="POST" action="{{route('Beer.destroy', $beer)}}">
                        @csrf
                        @method('Delete')
                        <button type="submit" style="margin:0; padding:0;" class="btn btn-link" onclick="return confirm('Уверены?')">Удалить</button>
                    </form>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>