$(document).ready(function(){
   $("#add").on('click',function(){
      $("#countryName").val('');
      $("#shortDesc").val('');
      $("#longDesc").val('');
      //alert('Entrou!');
   });
   getList();
});

function getList (){
   alert('Entrou no get Listar dados cadastrados!');
   $.ajax({
      url: 'controller.php?op=getList',
      method: 'GET',
      dataType: 'text',
      success: function (response) {
         alert('A requisição foi realizada com Sucesso!');
         //alert(response);
      }
   }).done(function (response) {  
      $('#tbody').html(response);
   }).fail(function (error) {
      console.log(error);
   });
}