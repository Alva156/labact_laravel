<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class MatchesController extends Controller
{
    // GUEST
    public function schedule(){
        $tickets = Tickets::all();
        return view('guest.schedule', compact('tickets'));
    }
     // AUTHENTICATED
    public function userschedule(){
        $tickets = Tickets::all();
        return view('user.user-schedule', compact('tickets'));
    }
    public function userschedreserve()
    {
        $books = Book::where('user_id', Auth::id())
                    ->latest()
                    ->withTrashed()
                    ->paginate(5);
    
        return view('user.user-schedreserve', compact('books'));
    }
    public function mschedule() {
        $books = Book::latest()->paginate(5);
        $tickets = Tickets::withTrashed()->latest()->paginate(5);
    
        return view('admin.manage-schedule', compact('tickets', 'books'));
    }
    public function userbook($id)
    {
        $ticket = Tickets::find($id);
        if ($ticket) {
            return view('user.user-book', ['ticket' => $ticket]); 
        } else {
            abort(404, 'Match not found.'); 
        }
    }
    
    public function addschedule(){
        return view('admin.add-schedule');
    }
   
    public function editschedule($id)
    {
        $ticket = Tickets::find($id);
        if ($ticket) {
            return view('admin.edit-schedule', ['ticket' => $ticket]); 
        } else {
            abort(404, 'Ticket not found.'); 
        }
    }

    public function storeschedule(Request $request){
        $validated = $request->validate([
         'first_team'=>'required',
         'second_team'=>'required',
         'date'=>'required',
         'time'=>'required',
         'price'=>'required',
        ],[
             'first_team.required' => 'Please add the first team',
             'second_team.required' => 'Please add the second team',
             'date.required' => 'Please add the date of the game',
             'time.required' => 'Please add time of the game',
             'price.required' => 'Please add the price of the game'
        ]);
     
        Tickets::insert([
         'first_team' => $request->first_team,
         'second_team' => $request->second_team,
         'date' => $request->date,
         'time' => $request->time,
         'price' => $request->price,
         'user_id' => Auth::user()->id,
         'created_at' => Carbon::now()
        ]);
     
        return Redirect()->route('manage-schedule')->with('success', 'Match added successfully!');
     
     }
    public function storebook(Request $request){
        $validated = $request->validate([
         'fullname'=>'required',
         'address'=>'required', 
         'number'=>'required|digits_between:8,15',
         'quantity'=>'required|min:1',
        ],[
             'fullname' => 'Please add your full name',
             'address' => 'Please add your address',       
             'number' => 'Please add yout contact number',
             'number.digits_between' => 'The contact number must be between 8 and 15 digits',
             'quantity' => 'Please indicate the quantity of tickets',
             'quantity.min' => 'The quantity must be at least 1',
        ]);
     
        Book::insert([
        'ticketid' =>$request->ticketid,
         'fullname' => $request->fullname,
         'address' => $request->address,
         'number' => $request->number,
         'quantity' => $request->quantity,
         'user_id' => Auth::user()->id,
         'created_at' => Carbon::now()
        ]);
     
        return Redirect()->route('user-schedule')->with('success', 'Ticket purchased successfully!');
     
    }

    public function updateschedule(Request $request, $id) {
        $validated = $request->validate([
            'first_team' => 'required',
            'second_team' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required|numeric',
        ], [
            'first_team.required' => 'First team cannot be empty',
            'second_team.required' => 'Second team cannot be empty',
            'date.required' => 'Date team cannot be empty',
            'time.required' => 'Time team cannot be empty',
            'price.required' => 'Price team cannot be empty'
        ]);
    
        
        $ticket = Tickets::findOrFail($id);
        $ticket->first_team = $request->first_team;
        $ticket->second_team = $request->second_team;
        $ticket->date = $request->date;
        $ticket->time = $request->time;
        $ticket->price = $request->price;
        $ticket->updated_at = Carbon::now();
        $ticket->save();
    
        return redirect()->route('manage-schedule')->with('updated', 'Match updated successfully!');
    }
    // Soft delete a schedule
    public function destroy($id)
    {
        $deleted = Tickets::where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('manage-schedule')->with('successsoft', 'Game deleted successfully.');
        } else {
            return abort(404, 'Game not found.');
        }
    }

    // Restore a soft-deleted schedule
    public function restore($id)
    {
        $ticket = Tickets::withTrashed()->find($id);

        if ($ticket) {
            $ticket->restore();
            return redirect()->route('manage-schedule')->with('successrestore', 'Game restored successfully.');
        } else {
            return abort(404, 'Game not found.');
        }
    }

    // Permanently delete a soft-deleted schedule
    public function forceDelete($id)
    {
        $ticket = Tickets::withTrashed()->find($id);

        if ($ticket) {
            $ticket->forceDelete();
            return redirect()->route('manage-schedule')->with('successdelete', 'Game permanently deleted.');
        } else {
            return abort(404, 'Game not found.');
        }
    }
  
}