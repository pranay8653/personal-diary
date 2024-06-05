<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Persional Diary</title>
  </head>
  <body>

    <div class="container p-2  m-3 mx-auto">
        <a href="{{ route('home')}}" class="btn btn-primary btn-lg p-2" >Refresh Page</a>
        <h1 class="text-center display-3">Your Persional Diary</h1>
        <div class="row">
            <form action="" >
                {{-- @csrf --}}

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
                    <div class="d-grid gap-2 col-12 mx-auto p-3 d-flex justify-content-between">
                        <input type="date" name="search" value="{{ Request::get('search') }}" class="form-control">

                        <button class="btn btn-primary " type="submit">Search</button>
                      </div>
                </div>
            </form>
            <h6 class="text-center">Enter Date And Search here</h6>
        </div>
    </div>
    <div class="container p-1  mx-auto m-3">
        <div class="d-flex justify-content-center">
            <a href="{{ route('create.note')}}" class="btn btn-primary btn-lg p-3" >Create Note</a>
          </div>
    </div>

    <div class="mx-auto col-md-8">
        @if (session()->has('success'))
            <div class="alert alert-warning">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Diary Entries</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($data as $item)
            <tbody>
                <tr>
                    <td>{{ $item->d_date }}</td>
                    <td>{{ $item->d_title }}</td>
                    <td style="width: 600px">{{  Str::limit($item->d_info, 200) }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('show.particular.data',['id' => $item->id])}}" class="btn btn-primary px-4 mx-1">View Page Of Diary</a>

                        <a href="{{ route('delete.details',['id' => $item->id]) }}" class="btn btn-danger px-4 mx-1">Remove Page Of Diary</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <div >
            <p >
                {{ $data->render('pagination::bootstrap-4') }}
            </p>
        </div>
        <div>
            Showing{{ $data->firstItem() }} to {{ $data->lastItem() }} of
            {{ $data->total() }} entries
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
