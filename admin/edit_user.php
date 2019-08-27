<?php include("includes/header.php"); ?>
<?php include("includes/photo_modal.php") ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php

if(empty($_GET['id']))
{
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if(isset($_POST['submit']))
{
    if($user)
    {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if(!empty($_FILES['user_image']))
        {
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            // redirect("edit_user.php?id={$user->id}");
            redirect("users.php");
            $session->message("The user has been updated");
        }
        else
        {
            $user->save();
            redirect("users.php");
            $session->message("The user has been updated");
        }
    }
}

?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include("includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            PHOTOS
                            <small>Subheading</small>
                        </h1>
                    </div>
                    <div class="col-md-6 user_image_box">
                        <a href="#" data-toggle="modal" data-target="#photo-lib"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                    </div>                           
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_image">User Image</label>
                                <input type="file" name="user_image">
                            </div>
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input type="text" name="username" class="form-control"  value="<?php echo $user->username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="firstname">FirstName</label>
                                <input type="text" name="first_name" class="form-control"  value="<?php echo $user->first_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">LastName</label>
                                <input type="text" name="last_name" class="form-control"  value="<?php echo $user->last_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>
                            <div>
                                <a id="user-id" class="btn btn-danger pull-left" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                            </div>
                            <div>
                                <input class="btn btn-primary pull-right" type="submit" name="submit" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            <!-- /.row -->

            </div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
