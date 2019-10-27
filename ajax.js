$(document).ready(function(){
   $("#add").on('click',function(){
      $("#countryName").val('');
      $("#shortDesc").val('');
      $("#longDesc").val('');
   });
   getList();
});

function getList (){
   $.ajax({
      url: 'controller.php?op=getList',
      method: 'GET',
      dataType: 'text',
      success: function (response) {}
   }).done(function (response) {  
      $('#tbody').html(response);
   }).fail(function (error) {
      console.log(error);
   });
}

function save(){
   if(isNotEmpty($("#countryName")) && isNotEmpty($("#shortDesc")) && isNotEmpty($("#longDesc"))){
      $.ajax({
         url: 'controller.php?op=save',
         method: 'POST',
         dataType: 'text',
         data: {
            countryName : $("#countryName").val(),
            shortDesc :  $("#shortDesc").val(),
            longDesc : $("#longDesc").val()
         },
         success: function (response) {
            $("#modalForm").modal('hide');
         }
      }).done(function (response) {
         if(response == "existe"){
            alert ("O país já existe!");
         }else{
            alert(response);
            window.location.reload();
         }
      }).fail(function (error) {
         console.log(error);
      });
   }
}

function isNotEmpty(element){
   if(element.val() == ''){
       alert('Porfavor preencha o campo que está vazio!')
       element.css('border', '1px solid red');
       return false
    }else{
       element.css('border', '');
    }
   return true;
}

function delet(id){
   if(confirm('Você tem certeza??')){
      $.ajax({
         url: 'controller.php?op=delet',
         method: 'POST',
         dataType: 'text',
         data: {
            id : id
         },
         success: function (response) {
            window.location.reload();
         }
      }).done(function (response) {
         alert(response);
      }).fail(function (error) {
         console.log(error);
      });
   }else{
      alert('Exclusão cancelado!!')
   }
}

function edit(id){
   $.ajax({
      url: 'controller.php?op=edit',
      method: 'GET',
      dataType: 'json',
      data: {
         id : id
      },
      success: function (response) {
         $("#modalForm").modal('show');
      }
   }).done(function (response) {
      $("#countryName").val(response.countryName);
      $("#shortDesc").val(response.shortDesc);
      $("#longDesc").val(response.longDesc);
   }).fail(function (error) {
      console.log(error);
   });
}