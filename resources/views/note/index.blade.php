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
 
          <h1> Les Notes </h1>
          
          <div class="pull-right">
         
          @can('create' ,'App\note' )
          <a href="{{ url('notes/create') }}" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ajouter une note</a>
          @endcan
            
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajouter une note</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('notes.store') }}" method="Post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Etudiant :</label>
                      <select class="form-control" name="etudiant" id="">
                        @foreach ($etudiants as $etudiant)
                      <option value="{{$etudiant->id}}">{{$etudiant->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">matiere :</label>
                      <input style="margin: 0px" type="text" name='matiere' class="form-control" value="{{ old ('matiere') }}">
                    </div>
                    <div class="form-group">
                      <label for=""> cc1 </label>
                      <input type="text"  name='cc1' class="form-control" value="{{ old ('cc1') }}" >
                  
                    </div>
                    <div class="form-group">
                      <label for=""> cc2 </label>
                      <input type="text"  name='cc2' class="form-control" value="{{ old ('cc2') }}" >
                    </div>
                    <div class="form-group">
                      <label for=""> Note finale </label>
                      <input type="text"  name='note_finale' class="form-control" value="{{ old ('note_finale') }}" >
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
         
         
          </div>

            <table class="table">
             <head>
              <tr>
                  <th>Nom Et Prénom   </th>
                  <th>Matiére</th>
                  <th>cc1</th>
                  <th>cc2</th>
                  <th>Note</th>
                  
                  <th>Action</th>

              </tr>
            </head>
              <body>
              @foreach($notes as $note)
              <tr>
                  <td>{{ $note->name }}  </td>
                  <td>{{ $note->matiere }}</td>
                  <td>{{ $note->cc1 }}</td>
                  <td>{{ $note->cc2 }}</td>
                  <td>{{ $note->note_finale }}</td>
                  
                  
                  <td>
                


                         
                  <a href="" class ="btn btn-primary">Details</a>
                  
                  @if(in_array(Auth::user()->role_id, [1,4]))

                  <a href="{{ url('notes/'.$note->id.'/edit') }}" class ="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$note->id}}" data-whatever="@mdo">Editer</a>
                  <div class="modal fade" id="exampleModal{{$note->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modifier La note de {{$note->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ route('notes.update',['id'=>$note->id]) }}" method="Post">
                          @csrf
                          @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">matiere :</label>
                              <input style="margin: 0px" type="text" name='matiere' class="form-control" value="{{ $note->matiere }}">
                            </div>
                            <div class="form-group">
                              <label for=""> cc1 </label>
                              <input type="text"  name='cc1' class="form-control" value="{{  $note->cc1 }}" >
                          
                            </div>
                            <div class="form-group">
                              <label for=""> cc2 </label>
                              <input type="text"  name='cc2' class="form-control" value="{{  $note->cc2 }}" >
                            </div>
                            <div class="form-group">
                              <label for=""> Note finale </label>
                              <input type="text"  name='note_finale' class="form-control" value="{{  $note->note_finale }}" >
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

                  @if(in_array(Auth::user()->role_id, [1,4]))
                  <button  type='button' class ="btn btn-danger deleteNote" >Supprimer</button>
                  <form action="{{route('notes.destroy',['id'=>$note->id])}}" method="post" style="display: none">
                    @csrf
                    @method('delete')
                  </form>
                  @endif
              
                  
                  </td>
              </tr>
                @endforeach
              </body>
          </table>
        </div>
    </div>
</div>          
@endsection


@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

 $('.deleteNote').on("click",function(){
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