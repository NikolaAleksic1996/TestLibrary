<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

{{-- add new book modal start --}}
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_book_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="number">Book number</label>
                        <input type="number" name="number" class="form-control" placeholder="Book number" required>
                    </div>
                    <div class="my-2">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_book_btn" class="btn btn-primary">Add Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new book modal end --}}

{{-- edit book modal start --}}
<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_book_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="book_id" id="book_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="number">Number</label>
                        <input type="number" name="number" id="number" class="form-control" placeholder="Book number" required>
                    </div>
                    <div class="my-2">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_book_btn" class="btn btn-success">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit book modal end --}}

<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Manage Books</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBookModal"><i
                            class="bi-plus-circle me-2"></i>Add New Book</button>
                </div>
                <div class="card-body" id="show_all_books">
                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    //add new book
    $("#add_book_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_book_btn").text('Adding...');
        $.ajax({
            url: '{{ route('store') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log(response)
                if (response.status === 200) {
                    Swal.fire(
                        'Added!',
                        'Book Added Successfully!',
                        'success'
                    )
                    fetchAllBooks();
                }
                $("#add_book_btn").text('Add Employee');
                $("#add_book_form")[0].reset();
                $("#addBookModal").modal('hide');
            }
        });
    });

    // edit book
    $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '{{ route('editBook') }}',
            method: 'post',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $("#title").val(response.title);
                $("#number").val(response.number);
                $("#description").val(response.description);
                $("#book_id").val(response.id);
            }
        });
    });
    // update book
    $("#edit_book_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_book_btn").text('Updating...');
        $.ajax({
            url: '{{ route('updateBook') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                console.log(response)
                if (response.status == 200) {
                    Swal.fire(
                        'Updated!',
                        'Book Updated Successfully!',
                        'success'
                    )
                    fetchAllBooks();
                }
                $("#edit_book_btn").text('Update Book');
                $("#edit_book_form")[0].reset();
                $("#editBookModal").modal('hide');
            }
        });
    });

    // delete employee ajax request
    $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('deleteBook') }}',
                    method: 'delete',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Book has been deleted.',
                            'success'
                        )
                        fetchAllBooks();
                    }
                });
            }
        })
    });

    //return all books
    fetchAllBooks();

    function fetchAllBooks() {
        $.ajax({
            url: '{{route('fetchAll')}}',
            method: 'get',
            success: function (res) {
                $("#show_all_books").html(res);
                $("table").DataTable({
                    order: [0, 'desc']
                });
            }
        });
    }
</script>
</body>
</html>
