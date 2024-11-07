<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class HistoriesController extends Controller
{
    // public $histories = [
    //     ['id' => '1', 'era' => 'The Founding', 'year' => '1903', 'descrip' => 'The New York Yankees were founded as the Baltimore Orioles in 1901. The team relocated to New York in 1903 and was renamed the Yankees, becoming a major league team in the American League.'],
    //     ['id' => '2', 'era' => 'The Babe Ruth Era', 'year' => '1920s', 'descrip' => 'Babe Ruth, acquired from the Boston Red Sox, transformed the Yankees into a powerhouse, leading them to multiple World Series titles and changing the game of baseball forever.'],
    //     ['id' => '3', 'era' => 'The Yankee Dynasty', 'year' => '1940s-1950s', 'descrip' => 'The Yankees, under manager Casey Stengel and stars like Joe DiMaggio and Mickey Mantle, established a dynasty with numerous championships and iconic moments.'],
    //     ['id' => '4', 'era' => 'The Steinbrenner Era', 'year' => '1970s-1980s', 'descrip' => 'Under owner George Steinbrenner, the Yankees experienced a resurgence, adding more championships to their record and becoming a symbol of excellence in baseball'],
    //     ['id' => '5', 'era' => 'The Modern Era', 'year' => '1990s-Present', 'descrip' => 'The Yankees continued their winning ways with several World Series titles in the late 1990s and early 2000s, maintaining their position as a dominant force in Major League Baseball.'],
    //     ['id' => '6', 'era' => 'Legacy and Impact', 'year' => 'Ongoing', 'descrip' => 'The Yankees are known for their championships and contributions to baseball culture, including iconic pinstripe uniforms and storied rivalries'],
        
    // ];


    
    // GUEST
    public function history(){
        $histories = History::all();
        return view('guest.history', compact('histories'));
    
    }
    // AUTHENTICATED
    public function userhistory(){
        $histories = History::all();
        return view('user.user-history',compact('histories'));
    
    }
    public function mhistory(){
        $histories = History::withTrashed()->latest()->paginate(5);
        return view('admin.manage-history', compact('histories'));
    }
    public function addhistory(){
        return view('admin.add-history');
    }
    public function edithistory($id)
    {
        $history = History::find($id);
        if ($history) {
            return view('admin.edit-history', ['history' => $history]); 
        } else {
            abort(404, 'History not found.'); 
        }
    }
    // Create

public function storeshistory(Request $request){
    $validated = $request->validate([
     
     'era'=>'required',
     'year'=>'required',
     'description'=>'required',
    ],[
         
         'era.required' => 'Please enter a valid era for the Yankees. This field cannot be left empty.',
         'year.required' => 'Please enter the year/s of that era.',
         'description.required' => 'Please add the description of that era'
    ]);
 
    History::insert([
     'era' => $request->era,
     'year' => $request->year,
     'description' => $request->description,
     'user_id' => Auth::user()->id,
     'created_at' => Carbon::now()
    ]);
 
    return Redirect()->route('manage-history')->with('success', 'History added successfully!');
 
 }
 public function updatehistory(Request $request, $id) {
    $validated = $request->validate([
        'era'=>'required',
        'year'=>'required',
        'description'=>'required',
    ],[
         
         'era.required' => 'Please enter a valid era for the Yankees. This field cannot be left empty.',
         'year.required' => 'Please enter the year/s of that era.',
         'description.required' => 'Please add the description of that era'
    ]);

    
    $history = History::findOrFail($id);
    $history->era = $request->era;
    $history->year = $request->year;
    $history->description = $request->description;
    $history->updated_at = Carbon::now();
    $history->save();

    return redirect()->route('manage-history')->with('updated', 'History updated successfully!');
}
 // Soft delete a history
 public function destroy($id)
 {
     $deleted = History::where('id', $id)->delete();

     if ($deleted) {
         return redirect()->route('manage-history')->with('successsoft', 'History deleted successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 // Restore a soft-deleted history
 public function restore($id)
 {
     $history = History::withTrashed()->find($id);

     if ($history) {
         $history->restore();
         return redirect()->route('manage-history')->with('successrestore', 'History restored successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 // Permanently delete a soft-deleted history
 public function forceDelete($id)
 {
     $history = History::withTrashed()->find($id);

     if ($history) {
         $history->forceDelete();
         return redirect()->route('manage-history')->with('successdelete', 'History permanently deleted.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

}