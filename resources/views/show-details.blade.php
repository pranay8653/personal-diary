<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Show Details</title>
  </head>
  <body>
    <div class="container p-5  text-center mt-5" style="border: 2px solid blue;">

        <div class="d-grid gap-2 d-md-flex justify-content-lg-start">
            <a href="{{ route('home') }}" class="btn btn-outline-info" >List Of Diary Page</a>
            <a href="{{ route('edit.text',['id' => $note->id]) }}" class="btn btn-outline-secondary" >Edit Text Details</a>
            <a href="{{ route('delete.details',['id' => $note->id]) }}" class="btn btn-outline-danger" >Remove Page Of Diary</a>
        </div>

        <h1 class="text-center display-3 text-info">Your Diary Page Details</h1>

        <div class="mx-auto col-md-8 mt-4">
            @if (session()->has('success'))
                <div class="alert alert-warning">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form action="{{ route('add.more.image',['id' => $note->id]) }}" class="p-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="d_info">Add More Pictures <span style="color: red">* (Image upload below resolution  2500x2500 & maximum 5 Pictures at a time )</span></label>
                <input type="file" name="images[]"  class="form-control m-4"  multiple>
                @error('images') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-outline-primary " >Add More Image</button>
        </form>

        <div class="row mt-4">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <h1> {{ \Carbon\Carbon::parse($note->d_date)->toFormattedDateString() }} </h1>
                <p class="border-bottom"></p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="d-flex justify-content-evenly">
                    <h1 class="text-primary" >Title:</h1>
                    <h3 > {{ $note->d_title }} </h3>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                <div class="">
                    <h1 class="text-primary">Description:</h1>
                    <h6 class="px-3 "> {{ $note->d_info }} </h6>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                <table class="table table-bordered border-primary" id="table_field">
                    <thead>
                        <td>S.No.</td>
                        <td>Image</td>
                        <td>Action</td>
                    </thead>
                    @php
                        $counter = 1;
                    @endphp

                    <tbody>
                        @foreach ($note->images as $image)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            {{-- <td>{{ $image->id }}</td> --}}

                        <td>
                                <img src="{{ asset('upload/images/'.$image->image) }}" width="100%" height="500px" alt="image " class="p-1">
                        </td>
                        <td>
                            <a href="{{ route('edit.image',['id' => $image->id ]) }}" class="btn btn-info p-3">Update Image </a>
                            <a href="{{ route('delete.image',['id' => $image->id ]) }} " class="btn btn-danger p-3">Remove Image </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>

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
