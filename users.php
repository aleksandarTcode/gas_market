<?php
include("includes/index_header.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
?>






<?php include ("includes/index_footer.php");?>
