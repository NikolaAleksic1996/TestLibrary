<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>

    <title>Online library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
<nav class="flex justify-between items-center mb-4">
    <ul class="flex space-x-6 mr-6 text-lg">
        @auth()
            <li>
                <span class="font-bold uppercase">Welcome {{auth()->user()->name}} {{auth()->user()->last_name}}</span>
            </li>
            <li>
                <a href="/" class="hover:text-laravel"
                ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Books</a
                >
            </li>
            <li>
                <a href="/fetch-all-authors" class="hover:text-laravel"
                ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Authors</a
                >
            </li>
            <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="/reader-books" class="hover:text-laravel"
                ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Books Search</a
                >
            </li>
            <li>
                <a href="/register" class="hover:text-laravel"
                ><i class="fa-solid fa-user-plus"></i> Register</a
                >
            </li>
            <li>
                <a href="/login" class="hover:text-laravel"
                ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a
                >
            </li>
        @endauth
    </ul>
</nav>
{{-- add new author modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="name">First Name</label>
                            <input type="text" name="name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="picture">Select Avatar</label>
                        <input type="file" name="picture" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Author</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <input type="hidden" name="emp_avatar" id="emp_avatar">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="my-2">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="my-2">
                        <label for="post">Post</label>
                        <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="mt-2" id="avatar">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Author</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit employee modal end --}}

<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Manage Authors</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                            class="bi-plus-circle me-2"></i>Add New Author</button>
                </div>
                <div class="card-body" id="show_all_employees">
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
    // add new employee ajax request
    {{--$("#add_employee_form").submit(function(e) {--}}
    {{--    e.preventDefault();--}}
    {{--    const fd = new FormData(this);--}}
    {{--    $("#add_employee_btn").text('Adding...');--}}
    {{--    $.ajax({--}}
    {{--        url: '{{ route('flush') }}',--}}
    {{--        method: 'post',--}}
    {{--        data: fd,--}}
    {{--        cache: false,--}}
    {{--        contentType: false,--}}
    {{--        processData: false,--}}
    {{--        dataType: 'json',--}}
    {{--        success: function(response) {--}}
    {{--            console.log(response)--}}
    {{--            // if (response.status == 200) {--}}
    {{--            //     Swal.fire(--}}
    {{--            //         'Added!',--}}
    {{--            //         'Employee Added Successfully!',--}}
    {{--            //         'success'--}}
    {{--            //     )--}}
    {{--            //     fetchAllEmployees();--}}
    {{--            // }--}}
    {{--            // $("#add_employee_btn").text('Add Employee');--}}
    {{--            // $("#add_employee_form")[0].reset();--}}
    {{--            // $("#addEmployeeModal").modal('hide');--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

    {{--fetchAllAuthors();--}}

    {{--function fetchAllAuthors() {--}}
    {{--    $.ajax({--}}
    {{--        url: '{{route('fetchAll')}}',--}}
    {{--        method: 'get',--}}
    {{--        success: function (res) {--}}
    {{--            console.log(res)--}}
    {{--            $("#show_all_books").html(res);--}}
    {{--            $("table").DataTable({--}}
    {{--                order: [0, 'desc']--}}
    {{--            });--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}
</script>
</body>
</html>
