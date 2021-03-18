<?php
include("includes/index_header.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
?>




<?php


//$sql = "SELECT DISTINCT country FROM gas";
//$countries_unique = num_rows($sql);



?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">

            <?php  average_gas_price("Bulgaria"); ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Average Price (&#36; per Mmbtu)</th>
                </tr>
                </thead>
                <tbody>
              <?php show_all_unique_countries(); ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



<?php include ("includes/index_footer.php");?>
