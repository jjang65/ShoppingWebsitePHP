<?php require_once("../../resources/config.php"); ?>

<?php 

if(isset($_GET['id'])){
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM users WHERE id = :id";
  $statement = $db->prepare($query);
  $statement->bindValue(":id", $id, PDO::PARAM_INT);
  $statement->execute();
  $row = $statement->fetch();

  $email    = $row['email'];
  $password = $row['password'];
  $user_photo = $row['photo'];
}


if(isset($_POST['update_user'])){
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

  // If the user uploaded new image file
  if ($image_upload_detected) {
    $image_filename = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path = file_upload_path($image_filename);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
      move_uploaded_file($temporary_image_path, $new_image_path);

      $query_update = "UPDATE users SET email = :email
                                          , password = :password
                                          , photo = :photo
                                   WHERE id = :id";
      $statement_update = $db->prepare($query_update);
      $bind_values = ['email' => $email
                    , 'password' => $password
                    , 'photo' => $image_filename
                    , 'id' => $id ];
      $statement_update->execute($bind_values);
    } 
    // If the user did not upload new image file
  } else {

    $query_update_without_image = "UPDATE users SET email = :email
                                          , password = :password
                                   WHERE id = :id";
    $statement_update = $db->prepare($query_update_without_image);
    $bind_values_without_image = ['email' => $email
                                , 'password' => $password
                                , 'id' => $id ];
    $statement_update->execute($bind_values_without_image);
    
  }

  set_message("User has been Updated");
  redirect("index.php?users");
}


?>


                        <h1 class="page-header">
                            Edit User
                            <small><?= $email ?></small>
                        </h1>

                      <div class="col-md-4 user_image_box">
                          
                    <a href="#" data-toggle="modal" data-target="#photo-library">
                      <?php if(isset($row['photo'])): ?>
                        <img class="img-responsive" src="../resources/uploads/<?= $user_photo ?>" alt="photo">
                      <?php endif ?>

                    </a>

                      </div>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="col-md-6">

                           <div class="form-group">
                              <label for="email">Email</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"  >


                            <!-- <div class="form-group">
                                <label for="first name">First Name</label>
                            <input type="text" name="first_name" class="form-control"  >
                               
                           </div>

                            <div class="form-group">
                                <label for="last name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" >
                               
                           </div> -->


                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?= $password ?>">
                               
                           </div>


                           <!-- User Photo -->
                            <div class="form-group">
                                <label for="product-title">User Photo</label> <br>

                                <input type="file" name="image">
                            </div>

                            <div class="form-group">

                            <a id="user-id" class="btn btn-danger" href="index.php?delete_user&id=<?= $id ?>">Delete</a>


                            <!-- Update Button -->
                            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update" >
                               
                           </div>


                            

                        </div>

                      

            </form>





    