<?php require_once("../../resources/config.php"); ?>


                    <div class="col-lg-12">
                      

                        <h1 class="page-header">
                            Users
                        </h1>

                        <h3 class="bg-success">
                            <?php echo display_message(); ?>
                        </h3>

                          <p class="bg-success">
                            <?php //echo $message; ?>
                        </p>

                        <!-- <a href="add_user.php" class="btn btn-primary">Add User</a> -->


                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User Number</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>User Photo (Edit User)</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php echo display_users(); ?>


                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>
           
                    </div>
