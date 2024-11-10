<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class OpinionsController extends Controller
{
    // public $opinions = [
    //     ['id' => '1','name' => 'Alex','content' => 'Watching the Yankees play is like a family tradition for me. Their games are always a highlight of my week!'],
    //     ['id' => '2', 'name' => 'Jamie','content' => 'The energy at Yankee Stadium is unmatched. Its the best place to feel the thrill of baseball.'],
    //     ['id' => '3', 'name' => 'Sam','content' => 'Some of my best memories are from watching Yankees games with my friends. They never disappoint!'],
    //     ['id' => '4', 'name' => 'Taylor','content' => 'I love how the Yankees always fight hard until the end. Their spirit is contagious and keeps me cheering every game.'],
    //     ['id' => '5', 'name' => 'Morgan','content' => 'Being a Yankees fan is about loyalty and passion. I support them through thick and thin, no matter what.'],
        
        
    // ];
    // GUEST
    public function opinions(){
        $opinions = Opinion::all();
        return view('guest.opinions', compact('opinions'));
    
    }
    // AUTHENTICATED
    public function useropinions(){
        $opinions = Opinion::all();
        return view('user.user-opinions', compact('opinions'));
    
    }
   
    public function usershare(){
        return view('user.user-share');
    }
    public function myopinions(){
        $opinions = Opinion::where('user_id', Auth::id())
                            ->latest()
                            ->withTrashed() // Include soft-deleted records
                            ->paginate(5);
        return view('user.user-myopinions', compact('opinions'));
    }
    
    public function editopinions($id)
    {
        $opinion = Opinion::find($id);
        if ($opinion) {
            return view('user.user-editopinions', ['opinion' => $opinion]);
        } else {
            abort(404, 'Opinion not found.');
        }
    }
   
    public function mopinions(){
        $opinions = Opinion::withTrashed()->latest()->paginate(5);
        return view('admin.manage-opinions', compact('opinions'));
    
    }
    public function storesopinion(Request $request){
        $validated = $request->validate([
         
         'content' => 'required',
        
    
        ],[
             
             'content.required' => 'Please provide content for this field. It cannot be empty.',
             
        ]);
     
        Opinion::insert([
         'content' => $request->content,
         'user_id' => Auth::user()->id,
         'created_at' => Carbon::now()
        ]);
     
        return Redirect()->route('user-opinions')->with('success', 'Comment posted successfully!');
     
     }
     public function updateopinion(Request $request, $id) {
        // Validate the input
        $validated = $request->validate([
            'content' => 'required',
        ],[
            'content.required' => 'Please provide content for this field. It cannot be empty.',
        ]);
    
        // Find the opinion by ID and update it
        $opinion = Opinion::findOrFail($id);
        $opinion->content = $request->content;
        $opinion->updated_at = Carbon::now();
        $opinion->save();
    
        // Redirect back with a success message
        return redirect()->route('user-myopinions')->with('successupdate', 'Your opinion has been updated successfully');
    }
    
      // Soft delete a opinion
      public function destroy($id)
      {
          $deleted = Opinion::where('id', $id)->delete();
      
          if ($deleted) {
              $route = request()->is('manage-opinions') ? 'manage-opinions' : 'user-myopinions';
              return redirect()->route($route)->with('successsoft', 'Opinion deleted successfully.');
          } else {
              return abort(404, 'Game not found.');
          }
      }
      

        // Restore a soft-deleted opinion
        public function restore($id)
        {
            $opinion = Opinion::withTrashed()->find($id);

            if ($opinion) {
                $opinion->restore();
                $route = request()->is('manage-opinions') ? 'manage-opinions' : 'user-myopinions';
                return redirect()->route($route)->with('successrestore', 'Opinion restored successfully.');
            } else {
                return abort(404, 'Game not found.');
            }
        }


        // Permanently delete a soft-deleted opinion
        public function forceDelete($id)
        {
            $opinion = Opinion::withTrashed()->find($id);

            if ($opinion) {
                $opinion->forceDelete();
                $route = request()->is('manage-opinions') ? 'manage-opinions' : 'user-myopinions';
                return redirect()->route($route)->with('successdelete', 'Opinion permanently deleted.');
            } else {
                return abort(404, 'Game not found.');
            }
        }
}