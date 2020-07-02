<?php

namespace App\Http\Controllers\Etudiant;
use App\Cv;

use App\User;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Auth;

class Cvscontroller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
/**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                   
        if(Auth::user()->role_id===5) {
            $listecv = Cv::all();
            //pagination
        }else{
            $listecv = Auth::user()->cvs; 
        }
        //dd($listecv);
        return view('cvs.index', ['data' => $listecv]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', 'App\Cv');  

        return view('cvs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Cv;
        if($request->hasFile('file'))
        {
            $file=$request->file('file');
            $filename= time().'.'.$file->getClientOriginalExtension();
             $request->file->move('storage/', $filename);
             $data->file= $filename;
         }
         $data->nom=$request->nom;
         $data->prenom=$request->prenom;
         $data->address=$request->address;
         $data->filiere=$request->filiere;
         $data->niveau=$request->niveau;//niveau scolaire
         $data->description=$request->description;
         $data->user_id = Auth::user()->id;
         $data->save();
        
      

        return redirect('cvs')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Cv::findOrFail($id);
        return view('cvs.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cv $cv)
    {
        
        $data = Cv::findOrFail($id);
      

        $this->authorize('update',$data);
        return view('cvs.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cv $cv)
    {
        
        $data = $cv;
       // dd($data);
        if($request->hasFile('file'))
        {
            //dd('ok');
            $file=$request->file('file');
            $filename= time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);
            $data->file= $filename;
            
       
         }
         
            $data->nom=$request->nom;
            $data->prenom=$request->prenom;
            $data->address=$request->address;
            $data->filiere=$request->filiere;
            $data->niveau=$request->niveau;
            $data->description=$request->description;
            $data->save();
        

        return redirect('cvs')->with('success', 'Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Cv::findOrFail($id);
        $data->delete();
        //$this->authorize('delete',$data);
        return redirect('cvs')->with('success', 'Data is successfully deleted');
    }   

    public function download($file)
    {
       return response()->download('storage/'.$file);
    }

}