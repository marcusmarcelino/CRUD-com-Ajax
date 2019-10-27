<?php
$op = $_GET['op'];
switch ($op){
   case 'getList':
      getList();
      break;
   case 'save':
      save();
      break;
   case 'edit':
      edit();
      break;
   case 'delet':
      delet();
      break;
   default:
      echo "Entrou na opção default";
      break;
}

function getList(){
   include_once("conexao.php");
   if(isset($_GET)){
      $sql = "SELECT * FROM country";
      $result = mysqli_query($conn,$sql);
      $response='';
      if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
            $response .= '
                  <tr>
                     <td>'.$data['id'].'</td>
                     <td id="country_'.$data['id'].'">'.$data['countryName'].'</td>
                     <td>
                        <button value="Edit" onclick="edit('.$data['id'].')" class="btn btn-primary"><i class="far fa-edit"></i></button>
                        <button value="Delet" onclick="delet('.$data['id'].')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                     </td>
                  </tr>
               ';
            }exit($response);
      }else{
         exit('Sua Base de dados está vazia!');
      }
   }
   mysqli_close($conn);
}

function save(){
   include_once("conexao.php");
   
   if(isset($_POST)){
      $countryName =$_POST['countryName'];
      $shortDesc= $_POST['shortDesc'];
      $longDesc = $_POST['longDesc'];
      $editRowID = $_POST['editRowID'];

      $result = mysqli_query($conn,"SELECT * FROM country WHERE countryName = '$countryName' ");

      if($editRowID != ''){
         mysqli_query($conn,"UPDATE country SET countryName='$countryName', shortDesc='$shortDesc', longDesc='$longDesc' WHERE id='$editRowID'");
         exit('update');
      }

      if($result->num_rows > 0){
         exit('existe');
      }else{
         mysqli_query($conn,"INSERT INTO country (countryName, shortDesc, longDesc)
            VALUES ('$countryName','$shortDesc','$longDesc')") or die($mysqli->error);
         exit('O país foi inserido!');
      }
   }
   mysqli_close($conn);
}

function edit(){
   include_once("conexao.php");
   if(isset($_GET)){
      $id =$_GET['id'];
      $result = mysqli_query($conn,"SELECT countryName, shortDesc, longDesc FROM country WHERE id='$id'")or die($mysqli->error);
      $data = $result->fetch_array();
         $jsonArray = array(
            'countryName' => $data['countryName'],
            'shortDesc' => $data['shortDesc'],
            'longDesc' => $data['longDesc'],
         );
      exit(json_encode($jsonArray));
   }
   mysqli_close($conn);
}

function delet(){
   include_once("conexao.php");
   if(isset($_POST)){
      $id =$_POST['id'];
      mysqli_query($conn,"DELETE FROM country WHERE id='$id'")or die($mysqli->error);
      exit('O registro '.$id.' foi deletado!');
   }
   mysqli_close($conn);
}
?>