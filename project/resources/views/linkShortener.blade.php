<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Link shortener</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <div class="container">
        <div class="card mt-5 p-4">
            <div class="input-group">
                <input class="form-control" id="link" name="link" placeholder="Введите ссылку">
                <div class="input-group-append"><button type="submit" id='submit' class="btn btn-primary">Сократить</button></button></div>
            </div>
            <br>
            <div id="table" class="p-2 bg-light border" @if (count($shortLinks) < 1) style="display: none" @endif>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-10">#</th>
                            <th>Ссылка</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($shortLinks as $link)
                            <tr>
                                <th scope="row">{{$link->id}}</th>
                                <td><a href="{{$link->short_link}}" target="_blank">http://{{ $link->short_link }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</html>

<script type="text/javascript">
    $(function() {

        $('#submit').click(function(e) {
            e.preventDefault()
            let link = $('#link').val();

            $.ajax({
                type: "POST",
                url: "/",
                data:{
                    "_token": "{{ csrf_token() }}",
                    'link': link,
                },
                success: function(data)
                {
                    $('#table').show();
                    $('#link').val('')
                    $( ".table-body").append(
                        `<tr>
                            <th scope="row">${data.id}</th>
                            <td><a href="${data.shortLink}" target="_blank">http://${data.shortLink}</a></td>
                        </tr>`
                    );
                },
                error: function (error)
                {
                    console.error(error);
                }
            });
        });

    })
</script>

