<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php 

if(empty($_GET['id']))
{
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if($user)
{
    $user->delete_user();
    redirect("users.php");
    $session->message("The user has been deleted");
}
else
{
    redirect("users.php");
}

?>  