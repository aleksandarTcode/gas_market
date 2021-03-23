<?php
include("includes/index_header.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
?>


<?php

if(isset($_POST['submit'])){
    if(isset($_POST['countries'])){
        $_SESSION['countries'] = $_POST['countries'];
        redirect("country.php");

    }
}

?>



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Average Price (&#36; per Mmbtu)</th>
                    <th><input type="checkbox" name="select-all" id="select-all">
                        <label for="select-all"></label></th>
                </tr>
                </thead>
                <tbody>
                <?php show_all_unique_countries(); ?>
                </tbody>
            </table>

            <button class="btn btn-primary btn-block" type="submit" name="submit">Show entries</button>

            </form>


        </div>
    </div>
</div>



<?php include ("includes/index_footer.php");?>
