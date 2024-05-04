<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
    exit();
}
?>

<footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="<?= $_SESSION["base_url"] ?>available_books">ESSU Library System</a>.</strong>
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

<!-- Edit Book Modal -->
<div class="modal fade" id="edit_book_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="edit_book_form">
                <div class="modal-body">
                    <div class="text-center">
                        <img id="edit_book_image_preview" class="img-bordered-sm" width="300" height="350" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <input type="file" class="custom-file-input" id="edit_book_image" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="edit_book_image" id="edit_book_image_label">Choose file</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="edit_book_title">Title</label>
                                <input type="text" class="form-control" id="edit_book_title" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="edit_book_author">Author</label>
                                <input type="text" class="form-control" id="edit_book_author" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_book_genre">Genre</label>
                                <select class="selectpicker form-control" id="edit_book_genre" multiple data-live-search="true">
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
                                <label for="edit_book_year_published">Year Published</label>
                                <input type="number" class="form-control" id="edit_book_year_published" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="edit_book_description">Description</label>
                            <textarea class="form-control" id="edit_book_description" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_book_id">
                    <input type="hidden" id="edit_book_old_genre">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_book_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Book Details Modal -->
<div class="modal fade" id="book_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="book_details_book_image" class="img-bordered" width="300" height="350" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Book Title:</strong>
                    </div>
                    <div class="col-md-10">
                        <span id="book_details_book_title"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Book Author:</strong>
                    </div>
                    <div class="col-md-10">
                        <span id="book_details_book_author"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Book Genre:</strong>
                    </div>
                    <div class="col-md-10">
                        <span id="book_details_book_genre"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Year Published:</strong>
                    </div>
                    <div class="col-md-10">
                        <span id="book_details_book_year_published"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-md-10">
                        <span id="book_details_book_description"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Account Modal -->
<div class="modal fade" id="update_account_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="update_account_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="update_account_name">Name</label>
                        <input type="text" id="update_account_name" class="form-control" <?= $user_type != "admin" ? "readonly" : null ?> required>
                    </div>
                    <div class="form-group">
                        <label for="update_account_username">Username</label>
                        <input type="text" id="update_account_username" class="form-control" required>
                        <small class="text-danger d-none" id="error_update_account_username">Username is already in use</small>
                    </div>
                    <div class="form-group">
                        <label for="update_account_password">Password</label>
                        <input type="password" id="update_account_password" class="form-control">
                        <small class="text-danger d-none" id="error_update_account_password">Passwords do not match</small>
                    </div>
                    <div class="form-group">
                        <label for="update_account_confirm_password">Confirm Password</label>
                        <input type="password" id="update_account_confirm_password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="update_account_id">
                    <input type="hidden" id="update_account_old_username">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_account_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Student Modal -->
<div class="modal fade" id="update_student_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="update_student_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_student_number">Student Number</label>
                                <input type="text" class="form-control" id="update_student_student_number" required>
                                <small class="text-danger d-none" id="error_update_student_student_number">Student Number is already in use</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_course">Course</label>
                                <select id="update_student_course" class="custom-select" required>
                                    <option value disabled selected></option>
                                    <option value="BSIT">BSIT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="update_student_year">Year</label>
                                <select id="update_student_year" class="custom-select" required>
                                    <option value disabled selected></option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="update_student_section">Section</label>
                                <input type="text" class="form-control" id="update_student_section" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_first_name">First Name</label>
                                <input type="text" class="form-control" id="update_student_first_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="update_student_middle_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_last_name">Last Name</label>
                                <input type="text" class="form-control" id="update_student_last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_birthday">Birthday</label>
                                <input type="date" class="form-control" id="update_student_birthday" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_mobile_number">Mobile Number</label>
                                <input type="number" class="form-control" id="update_student_mobile_number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="update_student_email">Email</label>
                                <input type="email" class="form-control" id="update_student_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="update_student_address">Address</label>
                            <textarea id="update_student_address" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="update_student_useraccount_id">
                    <input type="hidden" id="update_student_old_student_number">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_student_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Borrow Book Modal -->
<div class="modal fade" id="borrow_book_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrow Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="borrow_book_form">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="borrow_book_image" class="img-bordered" width="300" height="350" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Book Title:</strong>
                        </div>
                        <div class="col-md-9">
                            <span id="borrow_book_title"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Quantity:</strong>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="borrow_book_quantity" value="1" required>
                            <small class="text-danger d-none" id="error_borrow_book_quantity">Quantity must be greater than zero</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="borrow_book_id">
                    <input type="hidden" id="borrow_book_user_id" value="<?= $_SESSION["user_id"] ?>">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="borrow_book_submit">Borrow</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Inventory Modal -->
<div class="modal fade" id="update_inventory_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="update_inventory_form">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="update_inventory_image" class="img-bordered" width="300" height="350" src="<?= $_SESSION["base_url"] ?>dist/img/default_item_image.png">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Book Title:</strong>
                        </div>
                        <div class="col-md-9">
                            <span id="update_inventory_title"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Quantity:</strong>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="update_inventory_quantity" value="1" required>
                            <small class="text-danger d-none" id="error_update_inventory_quantity">Quantity must be greater than or equal zero</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="update_book_id">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update_inventory_submit">Update</button>
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
        const notification = <?= isset($_SESSION["notification"]) ? json_encode($_SESSION["notification"]) : json_encode(null) ?>;
        const base_url = "<?= $_SESSION["base_url"] ?>";
        const server = "<?= $_SESSION["server"] ?>";

        var current_tab = "<?= $current_tab ?>";

        adjustImageHeight();

        // disable_developer_functions(true);

        switch (current_tab) {
            case "Available Books":
                current_tab = "available_books";

                break;
            case "Books Management":
                current_tab = "books_management";

                break;
            case "Activity Logs":
                current_tab = "activity_logs";

                break;

            case "Students Management":
                current_tab = "students_management";

                break;

            case "My Profile":
                current_tab = "profile";

                break;

            case "Borrowed Books":
                current_tab = "borrowed_books";

                break;

            case "Books Inventory":
                current_tab = "books_inventory";

                break;
        }

        if (notification) {
            sweetalert(notification.title, notification.text, notification.icon);
        }

        $(window).resize(function() {
            adjustImageHeight();
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

        $("#edit_book_form").submit(function() {
            var id = $("#edit_book_id").val();
            var title = $("#edit_book_title").val();
            var author = $("#edit_book_author").val();
            var genre = $("#edit_book_genre").val();
            var old_genre = $("#edit_book_old_genre").val();
            var year_published = $("#edit_book_year_published").val();
            var description = $("#edit_book_description").val();
            var image = $("#edit_book_image")[0].files[0];

            if (genre.length == 0) {
                genre = old_genre.split(",");
            }

            $("#edit_book_submit").text("Please Wait..");
            $("#edit_book_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('id', id);
            formData.append('title', title);
            formData.append('author', author);
            formData.append('genre', genre);
            formData.append('year_published', year_published);
            formData.append('description', description);
            formData.append('image', image);

            formData.append('edit_book', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = "books_management";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#search_form").submit(function() {
            const search = $("#search_input").val();

            location.href = base_url + "available_books?search=" + search;
        })

        $(".book_details").click(function() {
            const book_id = $(this).attr("book_id");

            var formData = new FormData();

            formData.append('book_id', book_id);

            formData.append('book_details', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#book_details_book_image").attr("src", base_url + "dist/img/books/" + response[0].image);
                    $("#book_details_book_title").text(response[0].title);
                    $("#book_details_book_author").text(response[0].author);
                    $("#book_details_book_genre").text(response[0].genre.replace(",", ", "));
                    $("#book_details_book_year_published").text(response[0].year_published);
                    $("#book_details_book_description").text(response[0].description);
                    $("#book_details_modal").modal("show");
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $(".account_settings").click(function() {
            const id = $(this).attr("account_id");
            const name = $(this).attr("account_name");
            const username = $(this).attr("username");

            $("#update_account_id").val(id);
            $("#update_account_name").val(name);
            $("#update_account_username").val(username);
            $("#update_account_old_username").val(username);

            $("#update_account_modal").modal("show");
        })

        $("#update_account_form").submit(function() {
            const id = $("#update_account_id").val();
            const name = $("#update_account_name").val();
            const username = $("#update_account_username").val();
            const password = $("#update_account_password").val();
            const confirm_password = $("#update_account_confirm_password").val();
            const old_username = $("#update_account_old_username").val();

            if ((password || confirm_password) && password != confirm_password) {
                $("#update_account_password").addClass("is-invalid");
                $("#update_account_confirm_password").addClass("is-invalid");
                $("#error_update_account_password").removeClass("d-none");
            } else {
                $("#update_account_submit").text("Please wait...");
                $("#update_account_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('id', id);
                formData.append('name', name);
                formData.append('username', username);
                formData.append('password', password);
                formData.append('old_username', old_username);

                formData.append('update_account', true);

                $.ajax({
                    url: server,
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response) {
                            location.href = base_url + current_tab;
                        } else {
                            $("#update_account_username").addClass("is-invalid");
                            $("#error_update_account_username").removeClass("d-none");

                            $("#update_account_submit").text("Submit");
                            $("#update_account_submit").removeAttr("disabled");
                        }
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            }
        })

        $("#update_account_username").keydown(function() {
            $("#update_account_username").removeClass("is-invalid");
            $("#error_update_account_username").addClass("d-none");
        })

        $("#update_account_password").keydown(function() {
            $("#update_account_password").removeClass("is-invalid");
            $("#update_account_confirm_password").removeClass("is-invalid");
            $("#error_update_account_password").addClass("d-none");
        })

        $("#update_account_confirm_password").keydown(function() {
            $("#update_account_password").removeClass("is-invalid");
            $("#update_account_confirm_password").removeClass("is-invalid");
            $("#error_update_account_password").addClass("d-none");
        })

        $(document).on("click", ".delete_book", function() {
            const book_id = $(this).attr("book_id");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();

                    formData.append('book_id', book_id);

                    formData.append('delete_book', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            location.href = base_url + "books_management";
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            });
        })

        $(document).on("click", ".edit_book", function() {
            const book_id = $(this).attr("book_id");

            var formData = new FormData();

            formData.append('book_id', book_id);

            formData.append('book_details', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#edit_book_image_preview").attr("src", base_url + "dist/img/books/" + response[0].image);
                    $("#edit_book_title").val(response[0].title);
                    $("#edit_book_author").val(response[0].author);
                    $("#edit_book_old_genre").val(response[0].genre);
                    $("#edit_book_year_published").val(response[0].year_published);
                    $("#edit_book_description").val(response[0].description);
                    $("#edit_book_id").val(response[0].id);

                    $("#edit_book_modal").modal("show");
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $('#edit_book_image').change(function(e) {
            var selectedFile = e.target.files[0];

            if (selectedFile) {
                var fileName = selectedFile.name;

                $('#edit_book_image_label').text(fileName);
                $('#edit_book_image_preview').attr('src', URL.createObjectURL(selectedFile));
            }
        })

        $(document).on("click", ".edit_student", function() {
            const useraccount_id = $(this).attr("useraccount_id");

            var formData = new FormData();

            formData.append('useraccount_id', useraccount_id);
            formData.append('get_student_data', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    const student_data = response[0];

                    $("#update_student_old_student_number").val(student_data.student_number);
                    $("#update_student_useraccount_id").val(student_data.useraccount_id);

                    $("#update_student_student_number").val(student_data.student_number);
                    $("#update_student_course").val(student_data.course);
                    $("#update_student_year").val(student_data.year);
                    $("#update_student_section").val(student_data.section);
                    $("#update_student_first_name").val(student_data.first_name);
                    $("#update_student_middle_name").val(student_data.middle_name);
                    $("#update_student_last_name").val(student_data.last_name);
                    $("#update_student_birthday").val(student_data.birthday);
                    $("#update_student_mobile_number").val(student_data.mobile_number);
                    $("#update_student_email").val(student_data.email);
                    $("#update_student_address").val(student_data.address);

                    $("#update_student_modal").modal("show");
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#update_student_form").submit(function() {
            const student_number = $("#update_student_student_number").val();
            const course = $("#update_student_course").val();
            const year = $("#update_student_year").val();
            const section = $("#update_student_section").val();
            const first_name = $("#update_student_first_name").val();
            const middle_name = $("#update_student_middle_name").val();
            const last_name = $("#update_student_last_name").val();
            const birthday = $("#update_student_birthday").val();
            const mobile_number = $("#update_student_mobile_number").val();
            const email = $("#update_student_email").val();
            const address = $("#update_student_address").val();
            const old_student_number = $("#update_student_old_student_number").val();
            const useraccount_id = $("#update_student_useraccount_id").val();

            $("#update_student_submit").text("Please wait...");
            $("#update_student_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('student_number', student_number);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('birthday', birthday);
            formData.append('mobile_number', mobile_number);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('old_student_number', old_student_number);
            formData.append('useraccount_id', useraccount_id);

            formData.append('update_student', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        location.href = base_url + current_tab;
                    } else {
                        $("#update_student_student_number").addClass("is-invalid");
                        $("#error_update_student_student_number").removeClass("d-none");

                        $("#update_student_submit").text("Submit");
                        $("#update_student_submit").removeAttr("disabled");
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#update_student_student_number").keydown(function() {
            $("#update_student_student_number").removeClass("is-invalid");
            $("#error_update_student_student_number").addClass("d-none");
        })

        $(document).on("click", ".delete_student", function() {
            const useraccount_id = $(this).attr("useraccount_id");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();

                    formData.append('useraccount_id', useraccount_id);

                    formData.append('delete_student', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            location.href = base_url + "students_management";
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            });
        })

        $("#update_profile_form").submit(function() {
            const id = $("#update_profile_id").val();
            const student_number = $("#update_profile_student_number").val();
            const course = $("#update_profile_course").val();
            const year = $("#update_profile_year").val();
            const section = $("#update_profile_section").val();
            const first_name = $("#update_profile_first_name").val();
            const middle_name = $("#update_profile_middle_name").val();
            const last_name = $("#update_profile_last_name").val();
            const birthday = $("#update_profile_birthday").val();
            const mobile_number = $("#update_profile_mobile_number").val();
            const email = $("#update_profile_email").val();
            const address = $("#update_profile_address").val();
            const old_student_number = $("#update_profile_old_student_number").val();

            $("#update_profile_submit").text("Please wait...");
            $("#update_profile_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('id', id);
            formData.append('student_number', student_number);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('birthday', birthday);
            formData.append('mobile_number', mobile_number);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('old_student_number', old_student_number);

            formData.append('update_profile', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        location.href = base_url + current_tab;
                    } else {
                        $("#update_profile_student_number").focus();

                        $("#update_profile_student_number").addClass("is-invalid");
                        $("#error_update_profile_student_number").removeClass("d-none");

                        $("#update_profile_submit").text("Submit");
                        $("#update_profile_submit").removeAttr("disabled");
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#update_profile_student_number").keydown(function() {
            $("#update_profile_student_number").removeClass("is-invalid");
            $("#error_update_profile_student_number").addClass("d-none");
        })

        $(".borrow_this_book").click(function() {
            const book_id = $(this).attr("book_id");

            var formData = new FormData();

            formData.append('book_id', book_id);

            formData.append('book_details', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#borrow_book_image").attr("src", base_url + "dist/img/books/" + response[0].image);
                    $("#borrow_book_title").text(response[0].title);

                    $("#borrow_book_id").val(book_id);
                    $("#borrow_book_modal").modal("show");
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#borrow_book_form").submit(function() {
            const book_id = $("#borrow_book_id").val();
            const user_id = $("#borrow_book_user_id").val();
            const book_quantity = $("#borrow_book_quantity").val();

            if (parseInt(book_quantity) <= 0) {
                $("#borrow_book_quantity").addClass("is-invalid");
                $("#error_borrow_book_quantity").text("Quantity must be greater than 0");
                $("#error_borrow_book_quantity").removeClass("d-none");
            } else {
                $("#borrow_book_submit").text("Please wait...");
                $("#borrow_book_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('book_id', book_id);
                formData.append('user_id', user_id);
                formData.append('book_quantity', book_quantity);

                formData.append('borrow_book', true);

                $.ajax({
                    url: server,
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (!response) {
                            location.href = base_url + current_tab;
                        } else {
                            $("#borrow_book_quantity").addClass("is-invalid");
                            $("#error_borrow_book_quantity").text(response.error);
                            $("#error_borrow_book_quantity").removeClass("d-none");

                            $("#borrow_book_submit").text("Borrow");
                            $("#borrow_book_submit").removeAttr("disabled");
                        }
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            }
        })

        $("#borrow_book_quantity").keydown(function() {
            $("#borrow_book_quantity").removeClass("is-invalid");
            $("#error_borrow_book_quantity").addClass("d-none");
        })

        $(document).on("click", ".approve_request", function() {
            const offtake_id = $(this).attr("offtake_id");

            Swal.fire({
                title: "Are you sure?",
                text: "You are going to approve this request!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Approve it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();

                    formData.append('offtake_id', offtake_id);

                    formData.append('approved_request', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            location.href = base_url + current_tab;
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            })
        })

        $(document).on("click", ".reject_request", function() {
            const offtake_id = $(this).attr("offtake_id");

            Swal.fire({
                title: "Are you sure?",
                text: "You are going to reject this request!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Reject it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();

                    formData.append('offtake_id', offtake_id);

                    formData.append('reject_request', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            location.href = base_url + current_tab;
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            })
        })

        $(document).on("click", ".offtake_request", function() {
            const offtake_status = $(this).attr("offtake_status");

            Swal.fire({
                title: "Attention!",
                text: "This request has been " + offtake_status + ".",
                icon: "info"
            });
        })

        $(document).on("click", ".edit_inventory", function() {
            const book_id = $(this).attr("book_id");

            var formData = new FormData();

            formData.append('book_id', book_id);

            formData.append('book_details', true);

            $.ajax({
                url: server,
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    var formData = new FormData();

                    formData.append('book_id', book_id);

                    formData.append('inventory_details', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response_2) {
                            $("#update_inventory_image").attr("src", base_url + "dist/img/books/" + response[0].image);
                            $("#update_inventory_title").text(response[0].title);

                            $("#update_inventory_quantity").val(response_2[0].inventory);
                            $("#update_book_id").val(book_id);
                            $("#update_inventory_modal").modal("show");
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });

            $("#update_inventory_modal").modal("show");
        })

        $("#update_inventory_form").submit(function() {
            const book_id = $("#update_book_id").val();
            const quantity = $("#update_inventory_quantity").val();

            if (parseInt(quantity) < 0) {
                $("#update_inventory_quantity").addClass("is-invalid");
                $("#error_update_inventory_quantity").removeClass("d-none");
            } else {
                $("#update_inventory_submit").text("Please wait...");
                $("#update_inventory_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('book_id', book_id);
                formData.append('quantity', quantity);

                formData.append('update_inventory', true);

                $.ajax({
                    url: server,
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url + current_tab;
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            }
        })

        $("#update_inventory_quantity").keydown(function() {
            $("#update_inventory_quantity").removeClass("is-invalid");
            $("#error_update_inventory_quantity").addClass("d-none");
        })

        $(document).on("click", ".set_as_returned", function() {
            const offtake_id = $(this).attr("offtake_id");

            Swal.fire({
                title: "Are you sure?",
                text: "You are going to set this book as returned!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm"
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();

                    formData.append('offtake_id', offtake_id);

                    formData.append('set_as_returned', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            location.href = base_url + current_tab;
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            })
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