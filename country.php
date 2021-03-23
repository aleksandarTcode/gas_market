<?php
include("includes/index_header.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
?>


<?php

$countries_from_checkbox_for_title =implode(", ", $_SESSION['countries']);

if(isset($_GET['entry_id'])){

    delete_entry('gas',$_GET['entry_id']);
//    set_message("Entry Deleted");
    redirect($_SERVER['PHP_SELF']);
}

?>


<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-5">

            <p class="display-4 text-center">Entries for <?php echo $countries_from_checkbox_for_title;?></p>

            <table class="table table-bordered mt-5">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Country</th>
                    <th>Amount(Mmbtu)</th>
                    <th>Price(&#36; for Mmbtu)</th>
                    <th>Total Price (&#36;)</th>
                    <th>Date of Entry</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php show_selected_countries_entries(); ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



<?php include ("includes/index_footer.php");?>
