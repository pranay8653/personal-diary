<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Text Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container p-5">
        <a href="{{ route('show.particular.data',['id' => $text->id]) }}" class="btn btn-outline-secondary mt-5" >Return Page Of Diary</a>
        <h1 class="text-center" >Update Text Details</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                <form action="{{ route('update.text',['id' => $text->id]) }}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="d_title"></span></label>
                        <input type="text" class="form-control" id="d_title" name="d_title" placeholder="Enter title" value="{{ $text->d_title }}">
                        @error('d_title') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="d_info">Information</label>
                        <textarea class="form-control" id="d_info" name="d_info" rows="10" placeholder="Enter information"  >{{ $text->d_info }}</textarea>
                        @error('d_info') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success m-2 ">Update Text</button>
                </form>
            </div>


        </div>
    </div>
</body>
</html>
