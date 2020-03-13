<?php require_once("../../resources/config.php"); ?>

<?php 

if(isset($_GET['id'])){
  $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['id']) . "");
  confirm($query);

  while($row = fetch_array($query)){
    $username = escape_string($row['username']);
    $email    = escape_string($row['email']);
    $password = escape_string($row['password']);
    $user_photo = escape_string($row['user_photo']);
  }

}

 ?>


 <?php update_user(); ?>

                        <h1 class="page-header">
                            Edit User
                            <small><?php 
                              echo $username;
                             ?></small>
                        </h1>

                      <div class="col-md-6 user_image_box">
                          
                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="" alt=""></a>

                      </div>


                    <form action="" method="post" enctype="multipart/form-data">

  


                        <div class="col-md-6">

                           <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                           </div>

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
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                               
                           </div>


                           <!-- User Photo -->
                            <div class="form-group">
                                <label for="product-title">User Photo</label> <br>
                                    <img width='200' src="../resources/uploads/<?php echo $user_photo; ?>" alt="">
                                <input type="file" name="file">
                            </div>

                            <div class="form-group">

                            <a id="user-id" class="btn btn-danger" href="">Delete</a>


                            <!-- Update Button -->
                            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update" >
                               
                           </div>


                            

                        </div>

                      

            </form>





    