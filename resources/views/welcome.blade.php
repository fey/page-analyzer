<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-auto w-50 h-50">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Domains</a>
                        </li>
                    </ul>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Page Analyzer</h5>
                        </div>
                        <div class="card-body">
                            <form action="" class="form-inline">
                                <input
                                    type="url"
                                    class="form-control mb-2 mr-sm-2"
                                    id="inlineFormInputName2"
                                    placeholder="https://www.example.com"
                                    autocomplete>
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
