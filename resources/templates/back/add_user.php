<?php require_once("../../resources/config.php") ?>
<?php 

use \Gumlet\ImageResize;

if(isset($_POST['add_user'])){
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

  // If the user uploaded new image file
  if ($image_upload_detected) {
    $image_filename = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path = file_upload_path($image_filename);

    // If file is an image file
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
      move_uploaded_file($temporary_image_path, $new_image_path);

      // Resize image
      $image = new ImageResize($new_image_path);
      $image->resizeToWidth(450);
      $image->save($new_image_path . '_medium.ext');
      $image_filename = $image_filename . '_medium.ext';

      $query_update = "INSERT INTO users (email, password, photo) VALUES (:email, :password, :photo) ";
      $statement_update = $db->prepare($query_update);
      $bind_values = ['email' => $email
                    , 'password' => $password
                    , 'photo' => $image_filename ];
      $statement_update->execute($bind_values);

      set_message("New User Added");
      redirect("index.php?users");

    }  else {
      set_message("File format should be jpg, jpeg, gif, or png");
      redirect("index.php?users");
    }
    // If the user did not upload new image file
  } else {

    $query_update_without_image = "INSERT INTO users (email, password) VALUES (:email, :password) ";
    $statement_update = $db->prepare($query_update_without_image);
    $bind_values_without_image = ['email' => $email
                                , 'password' => $password ];
    $statement_update->execute($bind_values_without_image);

    set_message("New User Added");
    redirect("index.php?users");
  }
}

?>

  <h1 class="page-header">
      Add User
      <small>Page</small>
  </h1>


<form action="" method="post" enctype="multipart/form-data">

  <div class="col-md-6">

     <!-- <div class="form-group">
     
      <input type="file" name="file">
         
     </div> -->

      <div class="form-group">
          <label for="email">Email</label>
      <input type="text" name="email" class="form-control"   >
         
     </div>

<!-- 
      <div class="form-group">
          <label for="first name">First Name</label>
      <input type="text" name="first_name" class="form-control"   >
         
     </div> -->
<!-- 
      <div class="form-group">
          <label for="last name">Last Name</label>
      <input type="text" name="last_name" class="form-control"   >
         
     </div> -->


      <div class="form-group">
          <label for="password">Password</label>
      <input type="password" name="password" class="form-control"  >
         
     </div>

     <!-- User Image -->
      <div class="form-group">
          <label for="product-title">User Image</label>
          <input type="file" name="image">
      </div>
      <input type="submit" name="add_user" class="btn btn-primary pull-right" value="Add User" >
      <div class="form-group">
         
     </div>


      

  </div>



</form>

