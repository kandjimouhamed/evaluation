<?php
include('config/connexion.php');

if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];

  $req = $bdd->prepare('UPDATE user_detail SET name = :name, age = :age WHERE id = :id');
  $req->execute(array(
            'name' => $name,
            'age' => $age,
            'id' => $row
        ));	 
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
  $req = $bdd->prepare('DELETE FROM user_detail WHERE id = :id');
  $req->execute(array(
             'id' => $row_no
         ));
 echo "success";
 exit();
}

if(isset($_POST['insert_row']))
{
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];
 
 $req = $bdd->prepare('INSERT INTO user_detail(name, age) VALUES(:name, :age)');
        $req->execute(array(
            'name' => $name,
            'age' => $age
 ));
 echo 1;
 exit();
}
?>
