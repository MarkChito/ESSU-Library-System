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

<!-- ======= View Full Screen Image Modal ======= -->
<div class="modal fade" id="view_image_modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <img id="image_container" alt="Full Screen Image">
        </div>
    </div>
</div>

<!-- Add New Book Modal -->
<div class="modal fade" id="new_book_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                        <img id="new_book_image_preview" class="img-bordered-sm" width="300" height="350" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <input type="file" class="custom-file-input" id="new_book_image" accept=".jpg, .jpeg, .png" required>
                            <label class="custom-file-label" for="new_book_image" id="new_book_image_label">Choose file</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="new_book_title">Title</label>
                                <input type="text" class="form-control" id="new_book_title" required>
                            </div>
                        </div>
                        <div class="col-6">
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
                                <select class="selectpicker form-control" id="new_book_genre" multiple data-live-search="true">
                                    <option value="Literary Fiction">Literary Fiction</option>
                                    <option value="Historical Fiction">Historical Fiction</option>
                                    <option value="Science Fiction">Science Fiction</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Mystery">Mystery</option>
                                    <option value="Thriller">Thriller</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Horror">Horror</option>
                                    <option value="Biography/Autobiography">Biography/Autobiography</option>
                                    <option value="Memoir">Memoir</option>
                                    <option value="Self Help">Self-Help</option>
                                    <option value="History">History</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Science">Science</option>
                                    <option value="Psychology">Psychology</option>
                                    <option value="Philosophy">Philosophy</option>
                                    <option value="True Crime">True Crime</option>
                                    <option value="Picture Books">Picture Books</option>
                                    <option value="Early Readers">Early Readers</option>
                                    <option value="Chapter Books">Chapter Books</option>
                                    <option value="Middle Grade">Middle Grade</option>
                                    <option value="Young Adult">Young Adult</option>
                                    <option value="Poetry">Poetry</option>
                                    <option value="Drama/Play">Drama/Play</option>
                                    <option value="Comics/Graphic Novels">Comics/Graphic Novels</option>
                                    <option value="Reference">Reference</option>
                                    <option value="Religious/Spiritual">Religious/Spiritual</option>
                                    <option value="Cookbooks/Food and Drink">Cookbooks/Food & Drink</option>
                                    <option value="Art/Photography">Art/Photography</option>
                                    <option value="Dystopian">Dystopian</option>
                                    <option value="Space Opera">Space Opera</option>
                                    <option value="Epic Fantasy">Epic Fantasy</option>
                                    <option value="Urban Fantasy">Urban Fantasy</option>
                                    <option value="Historical Romance">Historical Romance</option>
                                    <option value="Contemporary Romance">Contemporary Romance</option>
                                    <option value="Paranormal Romance">Paranormal Romance</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_book_year_published">Year Published</label>
                                <input type="number" class="form-control" id="new_book_year_published" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="new_book_description">Description</label>
                            <textarea class="form-control" id="new_book_description" rows="5" required></textarea>
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
<script src="<?= $_SESSION["base_url"] ?>plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
        const current_tab = "<?= $current_tab ?>";
        const notification = <?= isset($_SESSION["notification"]) ? json_encode($_SESSION["notification"]) : json_encode(null) ?>;
        const base_url = "<?= $_SESSION["base_url"] ?>";
        const server = "<?= $_SESSION["server"] ?>";

        adjustImageHeight();

        disable_developer_functions(false);

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
            var description = $("#new_book_description").val();
            var image = $("#new_book_image")[0].files[0];

            $("#new_book_submit").text("Please Wait..");
            $("#new_book_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('title', title);
            formData.append('author', author);
            formData.append('genre', genre);
            formData.append('year_published', year_published);
            formData.append('description', description);
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

        function disable_developer_functions(enabled) {
            if (enabled) {
                $(document).on('contextmenu', function() {
                    return false;
                });

                $(document).on('keydown', function(event) {
                    if (event.ctrlKey && event.shiftKey) {
                        if (event.keyCode === 74) {
                            return false;
                        }

                        if (event.keyCode === 67) {
                            return false;
                        }

                        if (event.keyCode === 73) {
                            return false;
                        }
                    }

                    if (event.ctrlKey && event.keyCode === 85) {
                        return false;
                    }
                });
            }
        }
    })
</script>

<?php unset($_SESSION["notification"]) ?>

</body>

</html>