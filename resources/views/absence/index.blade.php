@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
  @if(session()->has('success'))
          <div class="alert alert-success">
         {{ session()->get('success') }}
          </div>
  @endif
        
      
               
       

        
        <h1> Les Absences  </h1>

        @can('create' ,'App\emploi')
        <a href="{{ url('emplois/create') }}" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add </a>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajouter l'absence</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST"  action="{{ route('Absences.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Module :</label>
                      <input placeholder="" style="margin: 0px" type="text"  name='module' class="form-control" value="" >
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Date :</label>
                        <input placeholder="" style="margin: 0px" type="date"  name='date' class="form-control" value="" >
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Seance :</label>
                        <input placeholder="" style="margin: 0px" type="text"  name='seance' class="form-control" value="" >
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">les Abscences :</label>
                        <input placeholder="" style="margin: 0px" type="text"  name='abscences' class="form-control" value="" >
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        @endcan
          <table class="table">
           <head>
            <tr>
                <th>Module</th>
                <th>Date</th>
                <th>Seance</th>
                <th>les Abscences</th>
                <th>Actions</th>
            </tr>
          </head>
            <body>
                @foreach ($absences as $absence)
                <tr>
                    <td>{{$absence->module}}</td>
                    <td>{{$absence->date}}</td>
                    <td>{{$absence->seance}}</td>
                    @if ($absence->absences=="")
                        <td>Aucun</td>
                    @else 
                    <td>
                        {{$absence->absences}}
                    </td>
                    @endif
                    
                    <td>
                    <button class="btn btn-success"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{$absence->id}}" data-whatever="@mdo">Ajouter un absent</button>

                        <div class="modal fade" id="exampleModal{{$absence->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							  <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="exampleModalLabel">Ajouter l'absence de {{$absence->module}} {{$absence->date}}</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<form method="POST"  action="{{ route('Absences.update',['Absence'=>$absence->id]) }}">
								<div class="modal-body">
                                    @csrf
                                    @method('put')
									<div class="form-group">
									  <label for="message-text" class="col-form-label">{{$absence->seance}}</label>
									  <input placeholder="nom, nom" style="margin: 0px" type="text"  name='absences' class="form-control" value="{{$absence->absences}}" >
									</div>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								  <button type="submit" class="btn btn-primary">Enregistrer</button>
								</div>
							  </form>
							  </div>
							</div>
						  </div>

				
                    </td>
                </tr>
                @endforeach
          
             
            </body>
        </table>
      </div>
  </div>
</div>
@endsection