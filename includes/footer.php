<footer id="main-footer" class="text-center p-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <p>Copyright &copy;
                    <span id="year"></span></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    // checks all checkboxes when click on select all
    $(document).ready(function () {
        $('#select-all').click(function () {

            if(this.checked){
                $('.check').each(function () {
                    this.checked = true;
                });
            } else {
                $('.check').each(function () {
                    this.checked = false;
                });
            }


        });
    });

    // unchecks select_all checkbox when some other checkbox is unchecked
    $(document).ready(function () {
        $('.check').click(function () {

            if(!this.checked){
                $('#select-all').each(function () {
                    this.checked = false;
                });
            }

        });
    });
</script>
</body>
</html>