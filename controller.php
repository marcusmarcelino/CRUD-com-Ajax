<?php
$op = $_GET['op'];
switch ($op){
   case 'getList':
      getList();
      break;
   case 'save':
      save();
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
                        <button value="Edit" onclick="edit('.$data['id'].')" class="btn btn-primary">edit</button>
                        <button value="Delete" onclick="deleteRow('.$data['id'].')" class="btn btn-danger">delete</button>
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

      $sql = "SELECT * FROM country WHERE countryName = '$countryName' ";
      $result = mysqli_query($conn,$sql);

      if($result->num_rows > 0){
         exit('O país já existe!');
      }else{
         mysqli_query($conn,"INSERT INTO country (countryName, shortDesc, longDesc)
            VALUES ('$countryName','$shortDesc','$longDesc')") or die($mysqli->error);
         exit('O país foi inserido!');
      }
   }
   mysqli_close($conn);
}
?>