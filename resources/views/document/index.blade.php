@extends('layouts.app')

@section('content')

<div class="container">

	@if(Auth::user()->role_id==1 || Auth::user()->role_id==4)

				<a  class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ajouter un cours</a>
				
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="exampleModalLabel">Ajouter un cours</h5>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<form method="POST"  action="{{ route('cours.store') }}" enctype="multipart/form-data">
						<div class="modal-body">
							@csrf
							<div class="form-group">
							  <label for="recipient-name" class="col-form-label">Entrer groupe :</label>
							  <input style="margin: 0px" type="text" name='grp' class="form-control" >
							</div>
							<div class="form-group">
							  <label for="message-text" class="col-form-label">Enseignant :</label>
							  <input style="margin: 0px" type="text" name='prof' class="form-control" value="{{ old ('matiere') }}">
							</div>
							<div class="form-group">
							  <label for=""> Entrer module :							</label>
							  <input type="text"  name='module' class="form-control" value="{{ old ('cc1') }}" >
						  
							</div>
							<div class="form-group">
							  <label for=""> Enter chapitre :							</label>
							  <input type="text"  name='chapitre' class="form-control" value="{{ old ('cc2') }}" >
							</div>
							<div class="form-group">
							  <label for=""> Enter titre :							</label>
							  <input type="text"  name='titre' class="form-control" value="{{ old ('note_finale') }}" >
							</div>
							<div class="form-group">
								<label for=""> Enter description :							</label>
								<input type="text"  name='description' class="form-control" value="{{ old ('note_finale') }}" >
							  </div>
							  <div class="form-group">
								<label for=""> choisir le fichier :							</label>
								<input type="file"  name='file' class="form-control" value="{{ old ('note_finale') }}" >
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

@endif
		
	 


<br />
@if ($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered table-striped">
	<tr>
		<th width="">Id</th>
		<th width="">groupe</th>
		<th width=""><i class="icon_profile"></i>professeur</th>
		<th width="">module</th>
		<th width="">chapitre</th>
		<th width="">titre</th>
		<th width="">description</th>
		<th><i class="icon_cogs"></i>operations</th>
	</tr>
	@foreach($data as $key=>$data)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $data->grp}}</td>
			<td>{{ $data->prof}}</td>
			<td>{{ $data->module}}</td>
			<td>{{ $data->chapitre }}</td>
			<td>{{ $data->titre}}</td>
			<td>{{ $data->description }}</td>
			<td>
				<a href="/cours/download/{{ $data->file }}" class="btn btn-primary" >
					Télécharger
				</a>


				@if(Auth::user()->role_id==1 || Auth::user()->role_id==4)

			<a href="{{ route('cours.edit', $data->id) }}" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$data->id}}" data-whatever="@mdo"><i class="icon_check_alt2"></i>Modifier</a>
					<div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modifer le cours :  {{$data->module}}=>{{$data->titre}}</h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<form method="POST"  action="{{ route('cours.update',$data->id) }}" enctype="multipart/form-data">
							@method('put')
								<div class="modal-body">
								@csrf
								<div class="form-group">
								  <label for="recipient-name" class="col-form-label">Entrer groupe :</label>
								  <input style="margin: 0px" type="text" name='grp' class="form-control" value="{{$data->grp}}">
								</div>
								<div class="form-group">
								  <label for="message-text" class="col-form-label">Enseignant :</label>
								  <input style="margin: 0px" type="text" name='prof' class="form-control" value="{{$data->prof}}">
								</div>
								<div class="form-group">
								  <label for=""> Entrer module :							</label>
								  <input type="text"  name='module' class="form-control" value="{{$data->module}}" >
							  
								</div>
								<div class="form-group">
								  <label for=""> Enter chapitre :							</label>
								  <input type="text"  name='chapitre' class="form-control" value="{{$data->chapitre}}" >
								</div>
								<div class="form-group">
								  <label for=""> Enter titre :							</label>
								  <input type="text"  name='titre' class="form-control" value="{{$data->titre}}" >
								</div>
								<div class="form-group">
									<label for=""> Enter description :							</label>
									<input type="text"  name='description' class="form-control" value="{{$data->description}}" >
								  </div>
								  <div class="form-group">
								  <label for=""> Remplacer <a target="_blank" href="/storage/{{$data->file}}">ce cours</a> : </label>
									<input type="file"  name='file' class="form-control" value="{{ old ('note_finale') }}" >
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
				
				
				
				
				
				@can('delete' , $data)
					<button type="submit" class="btn btn-danger deleteCours"><i class="icon_close_alt2"></i>Supprimer</button>
					<form action="{{ route('cours.destroy', $data->id) }}" method="post" style="display: none">
						@csrf
						@method('delete')
					</form>
				@endcan

				@endif
				
			</td>
		</tr>
	@endforeach
</table>
</div>

@endsection
@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

 $('.deleteCours').on("click",function(){
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