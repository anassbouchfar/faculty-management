<?php

namespace App\Http\Controllers;

use App\Emploi;
use Illuminate\Http\Request;
use App\Http\Requests\emploiRequest;
use Illuminate\Support\Facades\Auth;

class EmploiController extends Controller
{


      
    public function __construct(){
        $this->middleware('auth');
    }
    public function index() {
        $listeemploi = Emploi::all();
        
        return view('emploi.index', ['emplois' => $listeemploi]);
        
  
        

    }
    public function create() {
        //$this->authorize('create', 'App\Emploi');  

      
        return view('emploi.create');
    }

    public function store(Request $request) {
       // dd(request()->all());
        $emploi = new Emploi();
        $emploi->jour = $request->input('jour');
       
        
        $emploi->premiere_sceance = $request->input('premiere_sceance');
        $emploi->deux_sceance = $request->input('deux_sceance');
        $emploi->troi_sceance = $request->input('troi_sceance');
        $emploi->quatre_sceance = $request->input('quatre_sceance');
        $emploi->user_id = Auth::user()->id;
        $emploi->save();
        session()->flash('success' , 'l\'emploi à été bien enregistré !!');

        return redirect('emplois');
    }
     
    public function edit ($id) {
        $emploi = Emploi::find ($id);
        return view('emploi.edit', [ 'emploi' => $emploi ]);

        
    }
    public function update(Request $request , $id) {
        $emploi = Emploi::find($id);
        $emploi->jour = $request->input('jour');
        
        
        $emploi->premiere_sceance = $request->input('premiere_sceance');
        $emploi->deux_sceance = $request->input('deux_sceance');
        $emploi->troi_sceance = $request->input('troi_sceance');
        $emploi->quatre_sceance = $request->input('quatre_sceance');
        $emploi->save();
        session()->flash('success' , 'l\'emploi à été bien modifié !!');

        return redirect('emplois');
    }

    public function destroy(Request $request ,$id) {
        $emploi = Emploi::find($id);
        $emploi->delete();
        session()->flash('success' , 'l\'emploi à été bien supprimé !!');

        return redirect ('emplois');
       
       
    }
}
