<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Requests\noteRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

    
    public function __construct(){
        $this->middleware('auth');
    }

   /* public function moyNotes($notes){
        $sum=0;
            foreach ($notes as $note){
                
                $sum+=$note->note_finale;
            }
            return $sum/count($notes);
    } */

    public function index() {
        

        
        if(Auth::user()->role_id==3) {
        //dd(Auth::user()->id);

            $listenote = Note::where('user_id','=',Auth::user()->id)->get();
        }else{
            $listenote = DB::table('users')
                                ->join('notes','users.id','=','notes.user_id')->get();
           // dd($listenote);
        }
        //$notes =  Note::where('nom_et_prenom','=',Auth::user()->name)->get();
        //dd($notes);
       // $this->moyNotes($notes);
       $etudiants = User::where('role_id',"=","3")->get();
        return view('note.index', ['notes' => $listenote,'etudiants'=>$etudiants]);
        
  
        

    }
    public function create() {
        
        $this->authorize('create', 'App\Note');  

        $etudiants = User::where('role_id',"=","3")->get();
        //dd($etudiants);
        return view('note.create',['etudiants'=>$etudiants]);
    }

    public function store(Request $request) {

       // dd(request()->all());
        $note = new Note();
      // $note->nom_et_prenom = $request->input('nom_et_prenom');
        $note->matiere = $request->input('matiere');
        $note->cc1 = $request->input('cc1');
        $note->cc2 = $request->input('cc2');
        $note->note_finale = $request->input('note_finale');
        $note->user_id = $request->etudiant;

      
        $note->save();
        session()->flash('success' , 'la note à été bien enregistré !!');

        return redirect('notes');
    }
     
    public function edit ($id) {
        $note = Note::find($id);
        $this->authorize('update',$note);
        return view('note.edit', [ 'note' => $note ]);

        
    }
    public function update(Request $request , $id) {
        $note = Note::find($id);
        //$note->nom_et_prenom = $request->input('nom_et_prenom');
        $note->matiere = $request->input('matiere');
        $note->cc1 = $request->input('cc1');
        $note->cc2 = $request->input('cc2');
        $note->note_finale = $request->input('note_finale');
        $note->save();
        $note->save();
        session()->flash('success' , 'la note à été bien modifié !!');
        return redirect('notes');
    }

    public function destroy(Request $request ,$id) {
        $note = Note::find($id);
        //Note::destroy($id);
        $note->delete();
        //$this->authorize('delete',$note);
        session()->flash('success' , 'la note à été bien supprimé !!');
        return redirect ('notes');
       
       
    }
}
