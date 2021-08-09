
@extends('layouts.admin')
@section('content')
<div class="row">
<div class="col-lg-12" style="text-align: center">
<div >
<h2>La liste des produits </h2>
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
        <th>Nom</th>	
        <th>Catégories</th>
         <th>Date_Expire</th>
<th width="280px">Action</th>
</tr>

@foreach($Prod as $key => $value)
<tr> 
  <td> {{$value->id}}  </td>					
  <td >  {{$value->nom}} </td>
  <td> {{$value->Catégories}}  </td>
  <td> {{$value->DateExpiration}}  </td>
  <td>

<form action="{{ route('ProduitFiles.destroy',$value->id) }}" method="POST">
<a class="btn btn-info" id="show-publication" data-toggle="modal" data-id="{{ $value->id }}" ><i class="fas fa-eye">
                            </i>Show</a>
<a href="javascript:void(0)" class="btn btn-success" id="edit-Produit" data-toggle="modal" data-id="{{ $value->id }}">
<i class="fas fa-pencil-alt"> </i>Edit </a>

<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-publication" data-id="{{ $value->id }}" class="btn btn-danger delete-user" >
<i class="fas fa-trash"></i>Delete</a>
</form>
</td>
</tr>
@endforeach

</table>
{!! $Prod->links() !!}
<!-- Add and Edit customer modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="customerCrudModal"></h4>
</div>
<div class="modal-body">
<form name="custForm" action="{{ route('ProduitFiles.store') }}" method="POST">
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
<strong>Nom:</strong>
<input type="text" name="nom" id="nom" class="form-control" placeholder="Titre" onchange="validate()">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Catégorie:</strong>
    <input type="text" name="Catégorie" id="Catégorie" class="form-control" placeholder="Contenue" onchange="validate()" onkeypress="validate()">
    </div>
    </div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Compagnie:</strong>
<input type="text" name="Compagnie" id="Compagnie" class="form-control" placeholder="Catégories" onchange="validate()" onkeypress="validate()">
</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group">
<strong>Date d'éxpiration:</strong>
<input type="text" name="DateExpiration" id="DateExpiration" class="form-control" placeholder="Lien" onchange="validate()" onkeypress="validate()">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Prix d'achat:</strong>
<input type="text" name="Prix d'achat" id="prixAchat" class="form-control" placeholder="Images" onchange="validate()" onkeypress="validate()">
</div>
</div>

 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
 <strong>Prix de vente:</strong>
<input type="text" name="Prix de vente" id="prixVente" class="form-control" placeholder="Videos" onchange="validate()" onkeypress="validate()">
</div>
 </div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
<a href="{{ route('ProduitFiles.index') }}" class="btn btn-danger">Cancel</a>
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
<tr><td><strong>Nom:</strong></td><td>{{$value->nom}}</td></tr>
<tr><td><strong>Catégorie:</strong></td><td>{{$value->catégorie}}</td></tr>
<tr><td><strong>Compagnie:</strong></td><td>{{$value->compagnie}}</td></tr>
<tr><td><strong>Date d'éxpiration:</strong></td><td>{{$value->DateExpiration}}</td></tr>
<tr><td><strong>Prix d'achat:</strong></td><td>{{$value->prixAchat}}</td></tr>
<tr><td><strong>Prix de vente:</strong></td><td>{{$value->prixVente}}</td></tr>

<tr><td colspan="2" style="text-align: right "><a href="{{ route('ProduitFiles.index') }}" class="btn btn-danger">OK</a> </td></tr>
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
var Produit_id = $(this).data('id');
$.get('publicationDossier/'+Produit_id+'/edit', function (data) {
$('#customerCrudModal').html("Edit customer");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#pub_id').val(data.id);
$('#Nom').val(data.nom);
$('#Catégorie').val(data.catégorie);
$('#Compagnie').val(data.compagnie);
$('#DateExpiration').val(data.DateExpiration);
$('#PrixAchat').val(data.prixAchat);
$('#PrixVente').val(data.prixVente);
})
});
/* Show customer */
$('body').on('click', '#show-publication', function () {
$('#customerCrudModal-show').html("Customer Details");
$('#crud-modal-show').modal('show');
});

/*Delete customer */
$('body').on('click', '#delete-publication', function () {
var Prodl = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost/laravel7crud/public/publicationDossier/"+Prodl,
data: {
"id": Prodl,
"_token": token,
},
success: function (data) {
$('#msg').html('Customer entry deleted successfully');
$("#Publi_id_" + Prodl).remove();
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