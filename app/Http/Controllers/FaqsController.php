<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Models\Faq;

class FaqsController extends Controller
{
    // public $faqs = [
    //     ['id' => '1', 'question' => 'What types of products are available in the shop?', 'answer' => 'Our shop offers a variety of Yankees-themed merchandise including jerseys, hats, memorabilia, and more. To access the shop, please log in to your account.'],
    //     ['id' => '2', 'question' => 'How can I buy tickets for Yankees games?', 'answer' => 'You can purchase tickets for Yankees games through the Game Schedule section on our website. Please log in to view and book tickets.'],
    //     ['id' => '3', 'question' => 'Can I get updates on Yankees game schedules?', 'answer' => 'Yes, the Game Schedule section on our website is regularly updated with the latest game dates and times. You need to log in to access this information.'],
    //     ['id' => '4', 'question' => 'How can I learn more about the Yankees and their legacy?', 'answer' => 'Our About section provides comprehensive information about the Yankees, including their history, notable achievements, and contributions to baseball. This section is available to all visitors.'],
    //     ['id' => '5', 'question' => 'How can I leave my opinion about the Yankees?', 'answer' => 'You can share your opinions and read others comments in the  Opinions section. You need to log in to submit your own opinion, but you can read others opinions without logging in.'],
    // ];
    // GUEST

    
    public function faqs(){
        $faqs = Faq::all();
        return view('guest.faqs', compact('faqs'));
    }
    // AUTHENTICATED
    public function userfaqs(){
        $faqs = Faq::all();
        return view('user.user-faqs', compact('faqs'));
    }
    public function mfaqs(){
        $faqs = Faq::withTrashed()->latest()->paginate(5);
        return view('admin.manage-faqs', compact('faqs'));
    }
    public function addfaqs(){
        return view('admin.add-faqs');
    } 
    public function editfaqs($id)
    {
        $faq = Faq::find($id);
        if ($faq) {
            return view('admin.edit-faqs', ['faq' => $faq]); 
        } else {
            abort(404, 'Match not found.'); 
        }
    }

    public function storesfaq(Request $request){
        $validated = $request->validate([
         
         'question' => 'required',
         'answer' => 'required',
        
    
        ],[
             
             'question.required' => 'Please provide a question for this field. It cannot be empty.',
             'answer.required' => 'Please provide an answer for this field. It cannot be empty.',
             
        ]);
     
        Faq::insert([
         'question' => $request->question,
         'answer' => $request->answer,
         'user_id' => Auth::user()->id,
         'created_at' => Carbon::now()
        ]);
     
        return Redirect()->route('manage-faqs')->with('success', 'FAQ created successfully!');
     
     }
     public function updatefaq(Request $request, $id) {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ],[
             
             'question.required' => 'Please provide a question for this field. It cannot be empty.',
             'answer.required' => 'Please provide an answer for this field. It cannot be empty.',
        ]);
    
        
        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->updated_at = Carbon::now();
        $faq->save();
    
        return redirect()->route('manage-faqs')->with('updated', 'Faq updated successfully!');
    }
    // Soft delete a faq
 public function destroy($id)
 {
     $deleted = Faq::where('id', $id)->delete();

     if ($deleted) {
         return redirect()->route('manage-faqs')->with('successsoft', 'faq deleted successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 // Restore a soft-deleted faq
 public function restore($id)
 {
     $faq = Faq::withTrashed()->find($id);

     if ($faq) {
         $faq->restore();
         return redirect()->route('manage-faqs')->with('successrestore', 'faq restored successfully.');
     } else {
         return abort(404, 'Game not found.');
     }
 }

 // Permanently delete a soft-deleted faq
 public function forceDelete($id)
 {
     $faq = Faq::withTrashed()->find($id);

     if ($faq) {
         $faq->forceDelete();
         return redirect()->route('manage-faqs')->with('successdelete', 'faq permanently deleted.');
     } else {
         return abort(404, 'Game not found.');
     }
 }
}