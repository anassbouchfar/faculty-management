<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Emploi;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absences = Absence::all();
        return view('absence.index',['absences'=>$absences]);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absence = new Absence;
        $absence->module=$request->module;
        $absence->date=$request->date;
        $absence->seance=$request->seance;
        $absence->absences=$request->abscences;
        $absence->save();

        session()->flash('success' , 'l\'absence à été bien enregistré !!');

        return redirect('Absences');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Absence $Absence)
    {
        //$absence = Absence::find($absence);
        $Absence->absences=$request->absences;

        //$absence->user_id=$absence->user_id;
       // dd($absence->id);

        $Absence->save();
        session()->flash('success' , 'l\'absence à été bien enregistré !!');

        return redirect('Absences');

    }   
       
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
