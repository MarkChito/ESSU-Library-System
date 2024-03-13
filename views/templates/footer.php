<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
    exit();
}
?>

<footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="<?= $_SESSION["base_url"] ?>">ESSU Library System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- ======= View Profile Picture Modal ======= -->
<div class="modal fade" id="view_image_modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <img id="image_container" alt="Full Screen Image">
        </div>
    </div>
</div>

<!-- Add New Book Modal -->
<div class="modal fade" id="new_book_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="new_book_form">
                <div class="modal-body">
                    <div class="text-center">
                        <img id="new_book_image_preview" class="img-bordered-sm" width="200" height="250" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <input type="file" class="custom-file-input" id="new_book_image" accept=".jpg, .jpeg, .png" required>
                            <label class="custom-file-label" for="new_book_image" id="new_book_image_label">Choose file</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="new_book_title">Title</label>
                                <input type="text" class="form-control" id="new_book_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="new_book_author">Author</label>
                                <input type="text" class="form-control" id="new_book_author" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_book_genre">Genre</label>
                                <input type="text" class="form-control" id="new_book_genre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_book_year_published">Year Published</label>
                                <input type="number" class="form-control" id="new_book_year_published" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_book_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $_SESSION["base_url"] ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>dist/js/adminlte.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= $_SESSION["base_url"] ?>plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        const current_tab = "<?= $current_tab ?>";
        const notification = <?= isset($_SESSION["notification"]) ? json_encode($_SESSION["notification"]) : json_encode(null) ?>;
        const base_url = "<?= $_SESSION["base_url"] ?>";
        const server = "<?= $_SESSION["server"] ?>";

        adjustImageHeight();

        if (notification) {
            sweetalert(notification.title, notification.text, notification.icon);
        }

        $(window).resize(function() {
            adjustImageHeight();
        })

        $(".clickable_image").click(function() {
            const src = $(this).attr("src");

            $("#image_container").attr("src", src);

            $("#view_image_modal").modal("show");
        })

        $('#data_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        })

        $('#new_book').click(function() {
            $('#new_book_modal').modal("show");
        })

        $('#new_book_image').change(function(e) {
            var selectedFile = e.target.files[0];

            if (selectedFile) {
                var fileName = selectedFile.name;

                $('#new_book_image_label').text(fileName);
                $('#new_book_image_preview').attr('src', URL.createObjectURL(selectedFile));
            }
        })

        $("#new_book_form").submit(function() {
            var title = $("#new_book_title").val();
            var author = $("#new_book_author").val();
            var genre = $("#new_book_genre").val();
            var year_published = $("#new_book_year_published").val();
            var image = $("#new_book_image")[0].files[0];

            $("#new_book_submit").text("Please Wait..");
            $("#new_book_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('title', title);
            formData.append('author', author);
            formData.append('genre', genre);
            formData.append('year_published', year_published);
            formData.append('image', image);

            formData.append('new_book', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        location.href = "books_management";
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $(".sidebar-links").click(function() {
            location_link = $(this).attr("location_link");

            var formData = new FormData();

            formData.append('location_link', location_link);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = response;
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        function sweetalert(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon
            });
        }

        function adjustImageHeight() {
            var imageWidth = $('.book_cover').width();
            var content_wrapper_height = $('.content-wrapper').height();
            var content_header_height = $('.content-header').height();

            $('.book_cover').height(imageWidth);
            $('.no_books').height(content_wrapper_height - (content_header_height + 100));
        }
    })
</script>

<?php unset($_SESSION["notification"]) ?>

</body>

</html>