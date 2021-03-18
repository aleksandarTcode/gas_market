
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">

            <div class="alert alert-success" <?php if (!isset($_SESSION['message'])) echo "hidden"?>>
                <?php display_message(); ?>
            </div>
            <p class="display-4 text-center">Insert Gas Data</p>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                <div class="form-group">
                    <label for="country">Import Country</label>
                    <select class="form-control" id="country" name="country" required oninvalid="this.setCustomValidity('Please select country from the list')" oninput="this.setCustomValidity('')">
                        <option value="">Choose country</option>
                        <option value="Russia" <?php select_country_in_form('Russia'); ?>>Russia</option>
                        <option value="Ukraine" <?php select_country_in_form('Ukraine'); ?>>Ukraine</option>
                        <option value="Bulgaria" <?php select_country_in_form('Bulgaria'); ?>>Bulgaria</option>
                        <option value="Hungary" <?php select_country_in_form('Hungary'); ?>>Hungary</option>
                        <option value="Romania" <?php select_country_in_form('Romania'); ?>>Romania</option>
                        <option value="North Macedonia" <?php select_country_in_form('North Macedonia'); ?>>North Macedonia</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="amount">Amount</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="amount" placeholder="Amount in &#13221;" min="1" max="999999999" required oninvalid="this.setCustomValidity('Please enter valid number between 1 and 999999999')" oninput="this.setCustomValidity('')" value="<?php echo $_SESSION['amount'];?>">
                        <div class="input-group-append">
                            <span class="input-group-text">&#13221;</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Price</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="price" placeholder="Price in &#36;" min="1" max="999999999999" required oninvalid="this.setCustomValidity('Please enter valid number between 1 and 999999999999')" oninput="this.setCustomValidity('')" value="<?php echo $_SESSION['price'];?>">
                        <div class="input-group-append">
                            <span class="input-group-text">&#36;</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" name="date" type="date" id="date" required oninvalid="this.setCustomValidity('Please select date')" oninput="this.setCustomValidity('')" value="<?php echo $_SESSION['date'];?>">
                </div>

                <button class="btn btn-primary btn-block" type="submit" name="submit">Submit</button>

            </form>

            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <button class="btn btn-secondary btn-block mt-2" type="submit" name="clear">Clear Fields</button>
            </form>
        </div>
    </div>
</div>