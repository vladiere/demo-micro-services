<?php
namespace App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use App\Models\Todolist;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
class Service{
    // public static function getTask(Request $request){
    //     $tasks = Todolist::where('user_id', $request->user_id)->get();
    //     return $tasks;
    // }

    // public static function addTask(Request $request){
    //     $request->validate([
    //         'user_id'=>'required|integer',
    //         'list_name'=>'required|string',
    //         'list_desc'=>'required|string'
    //     ]);
    //     $tmp = new Todolist;
    //     $tmp->user_id = $request->user_id;
    //     $tmp->list_name = $request->list_name;
    //     $tmp->list_desc = $request->list_desc;
    //     $tmp->save();
    //     return response()->json([
    //         'message'=>'Task Added Successfully'
    //     ]);
    // }

    // public static function updateTask(Request $request){
    //     $request->validate([
    //         'task'=>'required|string'
    //     ]);
    //     $tmp = Todolist::find($request->id);
    //     $tmp->task = $request->task;
    //     $tmp->save();
    //     return response()->json([
    //         'message'=>'Task Updated Successfully'
    //     ]);
    // }

    public static function doneTask(Request $request){
        $tmp = Todolist::find($request->id);
        $tmp->status = 'done';
        $tmp->save();
        return response()->json([
            'message'=>'Task done!!'
        ]);
    }

    public static function deleteTask(Request $request) {
        $task = Todolist::find($request->id);

        if (!$task) {
            return response()->json([
                'error' => 'Task not found',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }    //
    // public function getUserGallery(Request $request){
    //     $gallery = Gallery::where('user_id', $request->user_id)->get();
    //     return $gallery;
    // }
    //
    // public function getImage($filename)
    // {
    //     $path = 'public/uploads/' . $filename;
    //
    //     if (!Storage::exists($path)) {
    //         abort(404);
    //     }
    //
    //     $file = Storage::get($path);
    //     $type = Storage::mimeType($path);
    //
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //
    //     return $response;
    // }
    //
    // public static function addImage(Request $request){
    //     $request->validate([
    //         'user_id' => 'required|integer',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
    //     ]);
    //
    //     // Store the uploaded file
    //     $imagePath = $request->file('image')->store('uploads', 'public');
    //     $tmp = new Gallery;
    //     $tmp->user_id = $request->user_id;
    //     $tmp->image = $imagePath;
    //
    //     $tmp->save();
    //     return response()->json(['message' => 'Image uploaded successfully']);
    // }
    //
    // public static function deleteImage(Request $request)
    // {
    //     $gallery = Gallery::find($request->id);
    //     $path = 'public/uploads/' .$gallery->image ;
    //
    //     if (Storage::exists($path)) {
    //         Storage::delete($path);
    //
    //         $gallery->delete();
    //
    //         return response()->json(['message' => 'Image deleted successfully']);
    //     }
    //
    //     return response()->json(['error' => 'Image not found'], 404);
    // }
}
