<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiple Image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body >
    <div class="container p-5 ">
        @php
             use App\Models\Image;
             $post_id = Image::find($data->id)->diary_id ;
            @endphp

            <a href="{{ route('show.particular.data',$post_id) }}" class="btn btn-outline-secondary mt-5" >Return Page Of Diary</a>

        <h1 class="text-center" >Update This Image</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('update.image',['id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-data">
                        <input type="file" name="image" >
                    </div>
                    <div>
                        <label for="">Old Image</label>

                    </div>
                    <img src="{{ asset('upload/images/'.$data->image) }}" width="60%" height="auto" alt="image">

                    <br>
                    <button type="submit" class="btn btn-success mt-5 ">Update Image</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
