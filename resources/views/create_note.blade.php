<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a note</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


    <div class="container mt-5 border border-dark p-5">
        <a href="{{ route('home')}}" class="btn btn-primary  p-1" >List Of Diary Page</a>
        <h2 class="text-center display-3">Create Your Note</h2>
        <form action="{{route('save.note')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mx-auto col-md-8">
                @if (session()->has('success'))
                    <div class="alert alert-warning">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="d_date">Date <span style="color: red">* (Date is Mandatory)</span></label>
                <input type="date" class="form-control" id="d_date" name="d_date"  >
                @error('d_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="d_title">Title <span style="color: red">* (Title is Mandatory)</span></label>
                <input type="text" class="form-control" id="d_title" name="d_title" placeholder="Enter title"  >
                @error('d_title') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group">
                <label for="d_info">Information</label>
                <textarea class="form-control" id="d_info" name="d_info" rows="3" placeholder="Enter information"  ></textarea>
                @error('d_info') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="d_info">Pictures <span style="color: red">* (Image upload below resolution  2500x2500 & maximum 5 Pictures at a time)</span></label>
                <input type="file" name="images[]"  class="form-control"  multiple>
                @error('images') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
