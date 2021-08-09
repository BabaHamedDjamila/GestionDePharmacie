
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
    <div >
    <h2>La liste des stocks </h2>
    </div>
    <br/>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="pull-right">
    <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-customer" data-toggle="modal">Ajouter </a>
    </div>
    </div>
    </div>
    <br/>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p id="msg">{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>  <th>Id</th>
            <th>Produit</th>	
            <th>Catégories</th>
             <th>Quantité disponible</th>
             <th>Prix</th>
             <th>Date de péremption</th>
    <th width="280px">Action</th>
    </tr>
    
    @foreach($Stock as $key => $value)
    <tr> 
      <td> {{$value->id}}  </td>					
      <td >  {{$value->Titre}} </td>
      <td> {{$value->Catégories}}  </td>
      <td> {{$value->Date}}  </td>
      <td>
    
    <form action="{{ route('publicationDossier.destroy',$value->id) }}" method="POST">
    <a class="btn btn-info" id="show-publication" data-toggle="modal" data-id="{{ $value->id }}" ><i class="fas fa-eye">
                                </i>Show</a>
    <a href="javascript:void(0)" class="btn btn-success" id="edit-publication" data-toggle="modal" data-id="{{ $value->id }}">
    <i class="fas fa-pencil-alt"> </i>Edit </a>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a id="delete-publication" data-id="{{ $value->id }}" class="btn btn-danger delete-user" >
    <i class="fas fa-trash"></i>Delete</a>
    </form>
    </td>
    </tr>
    @endforeach
    
    </table>
    {!! $Stock->links() !!}
    <!-- Add and Edit customer modal -->
    <div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="customerCrudModal"></h4>
    </div>
    <div class="modal-body">
    <form name="custForm" action="{{ route('publicationDossier.store') }}" method="POST">
    <input type="hidden" name="publica_id" id="publica_id" >
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Numéro:</strong>
    <input type="text" name="id" id="id" class="form-control" placeholder="id" onchange="validate()" >
    </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Référence:</strong>
    <input type="text" name="Titre" id="Titre" class="form-control" placeholder="Titre" onchange="validate()">
    </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Marque:</strong>
        <input type="text" name="Contenue" id="Contenue" class="form-control" placeholder="Contenue" onchange="validate()" onkeypress="validate()">
        </div>
        </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Nom_Générique:</strong>
    <input type="text" name="Catégories" id="Catégories" class="form-control" placeholder="Catégories" onchange="validate()" onkeypress="validate()">
    </div>
    </div>
    
    
    <div class="col-xs-12 col-sm-12 col-md-12">
     <div class="form-group">
    <strong>Catégories:</strong>
    <input type="text" name="Lien" id="Lien" class="form-control" placeholder="Lien" onchange="validate()" onkeypress="validate()">
    </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Prix:</strong>
    <input type="text" name="Images" id="Images" class="form-control" placeholder="Images" onchange="validate()" onkeypress="validate()">
    </div>
    </div>
    
     <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
     <strong>Quantité:</strong>
    <input type="text" name="Videos" id="Videos" class="form-control" placeholder="Videos" onchange="validate()" onkeypress="validate()">
    </div>
     </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Date_Expire:</strong>
    <input type="text" name="Date" id="Date" class="form-control" placeholder="Date" onchange="validate()" onkeypress="validate()">
    </div>
    </div>
     
    
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
    <a href="{{ route('publicationDossier.index') }}" class="btn btn-danger">Cancel</a>
    </div>
    
    </div>
    </form>
    </div>
    </div>
    </div>
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
    <tr><td><strong>Référence:</strong></td><td>{{$value->Titre}}</td></tr>
    <tr><td><strong>Marque:</strong></td><td>{{$value->Contenue}}</td></tr>
    <tr><td><strong>Nom_Générique:</strong></td><td>{{$value->Catégories}}</td></tr>
    <tr><td><strong>Catégories:</strong></td><td>{{$value->Lien}}</td></tr>
    <tr><td><strong>Prix:</strong></td><td>{{$value->Images}}</td></tr>
    <tr><td><strong>Quantité:</strong></td><td>{{$value->Videos}}</td></tr>
    <tr><td><strong>Date_Expire:</strong></td><td>{{$value->Date}}</td></tr>
    <tr><td colspan="2" style="text-align: right "><a href="{{ route('publicationDossier.index') }}" class="btn btn-danger">OK</a> </td></tr>
    </table>
    @endif
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <script>
    error=false
    
    function validate()
    {
        if(document.custForm.Titre.value !='' && document.custForm.Contenue.value !='' && document.custForm.Catégories.value !=''
        && document.custForm.Lien.value !=''&& document.custForm.Images.value !=''&& document.custForm.Videos.value !=''
        && document.custForm.Date.value !='')
            document.custForm.btnsave.disabled=false
        else
            document.custForm.btnsave.disabled=true
    }
    </script>
    
    <script>
    $(document).ready(function () {
    
    /* When click New customer button */
    $('#new-customer').click(function () {
    $('#btn-save').val("create-customer");
    $('#customer').trigger("reset");
    $('#customerCrudModal').html("Add New Customer");
    $('#crud-modal').modal('show');
    });
    
    /* Edit customer */
    $('body').on('click', '#edit-publication', function () {
    var Stock_id = $(this).data('id');
    $.get('publicationDossier/'+Stock_id+'/edit', function (data) {
    $('#customerCrudModal').html("Edit customer");
    $('#btn-update').val("Update");
    $('#btn-save').prop('disabled',false);
    $('#crud-modal').modal('show');
    $('#pub_id').val(data.id);
    $('#Titre').val(data.Titre);
    $('#Contenue').val(data.Contenue);
    $('#Catégories').val(data.Catégories);
    $('#Lien').val(data.Lien);
    $('#Images').val(data.Images);
    $('#Videos').val(data.Videos);
    $('#Date').val(data.Date);
    })
    });
    /* Show customer */
    $('body').on('click', '#show-publication', function () {
    $('#customerCrudModal-show').html("Customer Details");
    $('#crud-modal-show').modal('show');
    });
    
    /*Delete customer */
    $('body').on('click', '#delete-publication', function () {
    var Stock_id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    confirm("Are You sure want to delete !");
    
    $.ajax({
    type: "DELETE",
    url: "http://localhost/laravel7crud/public/publicationDossier/"+Stock_id,
    data: {
    "id": Stock_id,
    "_token": token,
    },
    success: function (data) {
    $('#msg').html('Customer entry deleted successfully');
    $("#Publi_id_" + Stock_id).remove();
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
    $(document).on('click', '.delete-publication', function() {
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
        url: 'publicationDossier',
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('.id').text()
        },
        success: function(data){
           $('.post' + $('.id').text()).remove();
        }
      });
    });</script>
    
@endsection