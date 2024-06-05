<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DiaryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""   )
        {
            $data = Diary::where('d_date','LIKE', "%$search%")->orderBy('created_at','DESC')->paginate(10);

        }
        else
        {
            $data = Diary::orderBy('created_at','DESC')->paginate(10);

        }
        return view('to-do-list',compact('data'));
    }

    // Create a note form
    public function create_diary()
    {
        return view('create_note');
    }



    public function store_date(Request $request)
    {
        $exist_date = Diary::where('d_date',$request->d_date)->first();

        if($exist_date) {
            return redirect()->back()->with('success', 'Same Date Cannot Be Added.');
        }

        $data = $request->validate([
            'd_date' => ['required'],
            'd_title' => ['required'],
            'd_info' => ['nullable'],
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'd_date.required' => 'Please enter Date!..',
            'd_title.required' => 'Please enter Title Of Notes!..',
        ]);

        $diary = Diary::create([
            'd_date'        =>$data['d_date'],
            'd_title'        =>$data['d_title'],
            'd_info'        =>$data['d_info'],
        ]);

        // Get the created Diary ID
        $diaryId = $diary->id;

        $file_path = 'upload/images';
        File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true);
        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();
                $image->move($file_path, $imageName);
                $images[] = ['image' => $imageName];
            }
        }

        foreach ($images as $key => $image) {
            Image::create([
                'diary_id' => $diaryId, // Assuming your images table has a diary_id column
                'image' => $image['image'],
            ]);
        }

        return redirect()->route('home')->with('success', 'Note Created Successfully.');
    }

    public function particular_data_all(Request $request, $id)
     {
        $note = Diary::with('images')->find($id);
        return view('show-details',compact('note'));
     }

    // Add more image
    public function add_more_image(Request $request)
     {

        $data = $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $file_path = 'upload/images';
        File::isDirectory($file_path) or File::makeDirectory($file_path, 0777, true, true);
        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();
                $image->move($file_path, $imageName);
                $images[] = ['image' => $imageName];
            }
        }

        foreach ($images as $key => $image) {
            Image::create([
                'diary_id' =>  $request->id, // Assuming your images table has a diary_id column
                'image' => $image['image'],
            ]);
        }

        return redirect()->route('show.particular.data',$request->id)->with('success', 'Picture Added Successfull.');
     }

    // Image update
    public function edit_image($id)
     {
        $data = Image::find($id);
        return view('edit_image',compact('data'));
     }

    // update Image
    public function update_image(Request $request, $id)
     {
        $post = Image::find($id);
        $post_id = Image::find($id)->diary_id ;
        $data = $request->validate([
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg' ]
        ]);

        if($post)
       {

         if($request->hasfile('image'))
          {
            $file_path = 'upload/images';

            if(File::exists(public_path($file_path . '/' . $post->image)))
               {
                 File::delete(public_path($file_path . '/' . $post->image));
               }

               $file_name = Carbon::now()->timestamp;
               $file_extension = $request['image']->getClientOriginalExtension();
               $request['image']->move($file_path, $file_name.'.'.$file_extension);
               $data['image'] = $file_name.'.'.$file_extension;

               $post->update([
                'image' => $file_name.'.'.$file_extension,
               ]);
          }

       }
        return redirect()->route('show.particular.data',$post_id)->with('success', 'Picture Updated Successfull.');
     }

    // delete image with local Storage
    public function delete_image($id)
     {
        $data = Image::find($id);
        if(!is_null($data))
         {
            unlink("upload/images/".$data->image);
            $data->delete();
         }
         return redirect()->back()->with('success', 'Picture Deleted successfully.');
     }

    // edit text details
    public function edit_text(Request $request, $id)
     {
        $text = Diary::find($id);
        return view('edit_text',compact('text'));
     }

    // Update details
    public function update_text(Request $request, $id)
     {
        $text = Diary::find($id);
        $text->update([
            'd_title'   => $request['d_title'],
            'd_info'    => $request['d_info'],
        ]);

        return redirect()->route('show.particular.data',$request->id)->with('success', 'Text Updated successfully.');
     }

     // delete details
    public function delete_details($id)
     {
        $delete_details = Diary::find($id);

    if ($delete_details) {
        $image_records = Image::where('diary_id', $delete_details->id)->get();

        foreach ($image_records as $image_record) {
            if (file_exists("upload/images/".$image_record->image)) {
                unlink("upload/images/".$image_record->image);
            }
            $image_record->delete();
        }
      }
        $delete_details->delete();
        return redirect()->route('home')->with('success', 'Note Deleted successfully.');
     }

}
