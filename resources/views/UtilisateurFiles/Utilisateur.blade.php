@extends('layouts.admin')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-lg-12" style="text-align: center">
<div >
<h2>La liste des utilisateurs </h2>
</div>
<br/>
</div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br/>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p id="msg">{{ $message }}</p>
</div>
@endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
            <div class="card">
            
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom</th>					  
                      <th>Utilisateur</th>
					            <th>Adresse</th>           
                      <th>Email</th>
                      <th>Numero_tel</th>
                      <th width="280px ">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($Utili as $key => $value)
                      <tr> 
                        <td> {{$value->id}}  </td>					
                        <td >  {{$value->Titre}} </td>                     	
                        <td> {{$value->Description}}  </td>	                    	                 
                        <td> {{$value->Status}}  </td>	
                        <td> {{$value->Images}}  </td>
                        <td> {{$value->Videos}}  </td>	                        
                        <td >
                        <!--  <a  class="btn btn-primary btn-sm" href="#">
                             
                            <i class="fas fa-eye">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>-->

                          <form >
<!--<a class="btn btn-info" id="show-signalement" data-toggle="modal" data-id="{{ $value->id }}" ><i class="fas fa-eye">
                            </i>Show</a>-->

<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-signalement" data-id="{{ $value->id }}" class="btn btn-danger delete-user" >
<i class="fas fa-trash"></i>Delete</a>

</form>
                      </td>
                      </tr>  
                      @endforeach   
                    </tbody>
                  </table>{!! $Utili->links() !!}
                </div>
                <!-- Show customer modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="customerCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">
@if(isset($value->Titre))

<table>
<tr><td><strong>Numéro:</strong></td><td>{{$value->id}}</td></tr>
<tr><td><strong>Nom:</strong></td><td>{{$value->Titre}}</td></tr>
<tr><td><strong>Utilisateur:</strong></td><td>{{$value->Description}}</td></tr>
<tr><td><strong>Adresse:</strong></td><td>{{$value->Status}}</td></tr>
<tr><td><strong>Email:</strong></td><td>{{$value->Images}}</td></tr>
<tr><td><strong>Numero_Tel:</strong></td><td>{{$value->Videos}}</td></tr>
<!--<tr><td><strong>Date:</strong></td><td> --><!--{{$value->Date}}</td></tr>-->
<!--<tr><td><strong>AnonyUtilisateur:</strong></td><td>{{$value->AnonyUtilisateur}}</td></tr>-->
<tr><td colspan="2" style="text-align: right "><a href="{{ route('UtilisateurFiles.index') }}" class="btn btn-danger">OK</a> </td></tr>
</table>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
                <!-- /.table-responsive -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <script>
          $(document).ready(function () {


/* Show customer */
$('body').on('click', '#show-signalement', function () {
$('#customerCrudModal-show').html("Détails du signalement");
$('#crud-modal-show').modal('show');
});

/*Delete customer */
$('body').on('click', '#delete-signalement', function () {
var signale_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost/laravel7crud/public/SignaleFiles/"+signale_id,
data: {
"id": signale_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Customer entry deleted successfully');
$("#signale_id_" + signale_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
<!-- form Delete function-->
<script>
/*$(document).on('click', '.delete-signalement', function() {
$('#footer_action_button').text(" Delete");
$('#footer_action_button').removeClass('glyphicon-check');
$('#footer_action_button').addClass('glyphicon-trash');
$('.actionBtn').removeClass('btn-success');
$('.actionBtn').addClass('btn-danger');
$('.actionBtn').addClass('delete');
$('.modal-title').text('Delete Post');
$('.id').text($(this).data('id'));
$('.deleteContent').show();
$('.form-horizontal').hide();
$('.title').html($(this).data('title'));
$('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function(){
  $.ajax({
    type: 'POST',
    url: 'SignaleFiles',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.id').text()
    },
    success: function(data){
       $('.post' + $('.id').text()).remove();
    }
  });
});*/</script>         
  
  
 

@endsection