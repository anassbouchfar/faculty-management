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
				  
				  @can('create' ,'App\emploi')
						<a href="{{ url('emplois/create') }}" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add </a>
						
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							  <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="exampleModalLabel">Ajouter un jour</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<form method="POST"  action="{{ route('emplois.store') }}" enctype="multipart/form-data">
								<div class="modal-body">
									@csrf
									<div class="form-group">
									  <label for="recipient-name" class="col-form-label">jour :</label>
									  <select class="form-control" name="jour" id="jour">
										<option value="lundi">lundi</option>
										<option value="mardi">mardi</option>
										<option value="mercredi">Mercredi</option>
										<option value="jeudi">jeudi</option>
										<option value="vendredi">vendredi</option>
										<option value="samedi">samedi</option>
									  </select>
									</div>
									<div class="form-group">
									  <label for="message-text" class="col-form-label">8h30->10h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='premiere_sceance' class="form-control" value="{{ old ('premiere_sceance') }}" >
									</div>
									<div class="form-group">
									  <label for=""> 10h30->12h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='deux_sceance' class="form-control" value="{{ old ('deux_sceance') }}" >
									</div>
									<div class="form-group">
									  <label for="">14h30->16h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='troi_sceance' class="form-control" value="{{ old ('troi_sceance') }}" >
									</div>
									<div class="form-group">
									  <label for="">16h30->18h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='quatre_sceance' class="form-control" value="{{ old ('quatre_sceance') }}" >
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
						  <a href="{{route('Absences.index')}}" class="btn btn-secondary" style="float:right">Abscences</a>

				@endcan
						 
				 
		
				  
				  <h1> Emploi </h1>
				  
					<table class="table">
					 <head>
					  <tr>
						  <th>Jour</th>
						  <th>8h30-->10h15</th>
						  <th>10h30-->12h15</th>
						  <th>14h30-->16h15</th>
						  <th>16h30-->18h15</th>
						  <th>Action</th>
		
					  </tr>
					</head>
					  <body>
					  @foreach($emplois as $emploi)
					  <tr>
					 
						  <td>{{ $emploi->jour }}</td>
						 
					  <td>{{ $emploi->premiere_sceance }} </td>
					  <td>{{ $emploi->deux_sceance }} </td>
					  <td>{{ $emploi->troi_sceance }} </td>
					  <td>{{ $emploi->quatre_sceance }} </td>
					  
						  <td>
						
						
						  <a href="{{ url('emplois/'.$emploi->id.'/edit') }}" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$emploi->id}}" data-whatever="@mdo">Editer</a>
						  <div class="modal fade" id="exampleModal{{$emploi->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							  <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title" id="exampleModalLabel">Modifier un jour</h5>
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
								<form method="POST"  action="{{ route('emplois.update',['id'=>$emploi->id]) }}" >
									@csrf
									@method('put')
								<div class="modal-body">
									
									<div class="form-group">
									  <label for="recipient-name" class="col-form-label">jour :</label>
									  <select class="form-control" name="jour" id="jour">
										@foreach (['lundi','mardi','mercredi','jeudi','vendredi','samedi'] as $jour)
											@if($jour===$emploi->jour)
											<option selected="selected" value="{{$jour}}">{{$jour}}</option>
											@else 
											<option value="{{$jour}}">{{$jour}}</option>
											@endif
										@endforeach  
										
									  </select>
									</div>
									<div class="form-group">
									  <label for="message-text" class="col-form-label">8h30->10h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='premiere_sceance' class="form-control" value="{{ $emploi->premiere_sceance }}" >
									</div>
									<div class="form-group">
									  <label for=""> 10h30->12h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='deux_sceance' class="form-control" value="{{ $emploi->deux_sceance }}" >
									</div>
									<div class="form-group">
									  <label for="">14h30->16h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='troi_sceance' class="form-control" value="{{ $emploi->troi_sceance }}" >
									</div>
									<div class="form-group">
									  <label for="">16h30->18h15( module : salle)</label>
									  <input style="margin: 0px" type="text"  name='quatre_sceance' class="form-control" value="{{ $emploi->quatre_sceance }}" >
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
				



						  <button  type='submit' class ="btn btn-danger deleteEmploi">Supprimer</button>
						  <form action="{{ route('emplois.destroy', $emploi->id) }}" method="post" style="display: none">
							@csrf
							@method('delete')
						</form>
						  
						  
						  </td>
						  @endforeach
					  </tr>
					   
					  </body>
				  </table>
				</div>
			</div>
		</div>          
		@endsection
	

		@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

 $('.deleteEmploi').on("click",function(){
   var that=$(this)
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    that.next().submit()
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
  })
/*
  */
</script>
@endsection
