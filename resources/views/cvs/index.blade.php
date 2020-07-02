@extends('layouts.ap')

@section('content')

<br />
@if ($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif
	@if(!count($data))
		<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Editer Cv</h5>
				 
				</div>
				<form method="POST"  action="{{ route('cvs.store')}}" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<div class="form-group">
					  <label for="recipient-name" class="col-form-label"> le nom :</label>
					  <input style="margin: 0px" type="text" name='nom' class="form-control" >
					</div>
					<div class="form-group">
					  <label for="message-text" class="col-form-label"> le prenom :</label>
					  <input style="margin: 0px" type="text" name='prenom' class="form-control" >
					</div>
					<div class="form-group">
					  <label for=""> Enter l'address :</label>
					  <input type="text"  name='address' class="form-control"  >
				  
					</div>
					<div class="form-group">
					  <label for=""> Enter filiere :</label>
					  <input type="text"  name='filiere' class="form-control" >
					</div>
					<div class="form-group">
					  <label for=""> Enter niveau scolaire :							</label>
					  <input type="text"  name='niveau' class="form-control" >
					</div>
					<div class="form-group">
						<label for=""> Enter description :							</label>
						<input type="text"  name='description' class="form-control"  >
					  </div>
					  <div class="form-group">
					  <label for=""> ajouter un fichier:	</label>
						<input type="file"  name='file' class="form-control"  >
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








<table class="table table-bordered table-striped">
	<tr>
		<th width="">No</th>
		<th width="">nom</th>
		<th width="">prenom</th>
		<th width="">address</th>
		<th width="">filiere</th>
		<th width="">niveau scl.</th>
		<th width="">description</th>
		<th>actions</th>
	</tr>
	@foreach($data as $key=>$data)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $data->nom}}</td>
			<td>{{ $data->prenom}}</td>
			<td>{{ $data->address}}</td>
			<td>{{ $data->filiere }}</td>
			<td>{{ $data->niveau}}</td>
			<td>{{ $data->description }}</td>
			<td>
				
				
			<a href="/storage/{{$data->file}}" target="_blank" class="btn btn-primary">Show</a>

			@can('update' , $data)
				<a  class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$data->id}}" data-whatever="@mdo">Edit</a>
					
				
				<div class="modal fade" id="exampleModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="exampleModalLabel">Editer Cv</h5>
						 
						</div>
						<form method="POST"  action="{{ route('cvs.update', ['cv'=>$data->id]) }}" enctype="multipart/form-data">
						<div class="modal-body">
							@csrf
							@method('put')
							<div class="form-group">
							  <label for="recipient-name" class="col-form-label">changer le nom :</label>
							  <input style="margin: 0px" type="text" name='nom' class="form-control" value="{{ $data->nom }}">
							</div>
							<div class="form-group">
							  <label for="message-text" class="col-form-label">changer le prenom :</label>
							  <input style="margin: 0px" type="text" name='prenom' class="form-control" value="{{ $data->prenom}}">
							</div>
							<div class="form-group">
							  <label for=""> changer l'address :</label>
							  <input type="text"  name='address' class="form-control" value="{{ $data->address }}" >
						  
							</div>
							<div class="form-group">
							  <label for=""> changer filiere :</label>
							  <input type="text"  name='filiere' class="form-control" value="{{ $data->filiere }}" >
							</div>
							<div class="form-group">
							  <label for=""> changer niveau scolaire :							</label>
							  <input type="text"  name='niveau' class="form-control" value="{{ $data->niveau }}" >
							</div>
							<div class="form-group">
								<label for=""> Enter description :							</label>
								<input type="text"  name='description' class="form-control" value="{{ $data->description }}" >
							  </div>
							  <div class="form-group">
							  <label for=""> chancger <a target="_blank" href="/storage/{{$data->file}}">ce fichier</a>:							</label>
								<input type="file"  name='file' class="form-control" value="" >
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

					<a href="/cvs/download/{{ $data->file }}">Download</a>
					

					@can('delete' , $data)
					<button type="submit" class="btn btn-danger deleteCv">Delete</button>
					<form style="display: none" action="{{ route('cvs.destroy', $data->id) }}" method="post">
						@csrf
						@method('DELETE')
					</form>

					

					@endcan
					
			</td>
		</tr>
	@endforeach
</table>

@endsection


@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>
		$('.deleteCv').on("click",function(){
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
	</script>
@endsection