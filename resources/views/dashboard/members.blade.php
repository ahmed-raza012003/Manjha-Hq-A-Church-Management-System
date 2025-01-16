@extends('layouts.base')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> -->


<style>
    .custom-container {
      /* padding: 10px; */
      border-radius: 8px;
      background-color: #f8f9fa;
    }
    .input-group-text {
      background-color: #fff;
      border: 1px solid #ced4da;
    }
    .btn-custom {
      background-color: #5541D7;
      color: white;
      padding-left: 25px;
      padding-right: 25px;
    }
    .btn-custom:hover{
        background-color: #5541D7;
      color: white;
    }
    .buttons{
        border: 1px solid #5541D7;
        color: #5541D7;
    }

    .buttons:hover{
        border: 1px solid #5541D7;
        color: #5541D7;

    }
    .button-outlined{
        background-color: #5541D7;
      color: white;

    }
    .button-outlined:hover{
        background-color: #5541D7;
        color: white;

    }
    .table-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .pagination-summary {
            margin: 0 15px;
            /* line-height: 40px; */
        }

        .custom-pagination {
        color: #5541D7 !important;
        border-color: #5541D7 !important;
    }

    .custom-pagination:hover {
        background-color: #5541D7 !important;
        color: #fff !important;
    }

    .page-item.active .page-link {
        background-color: #5541D7 !important;
        border-color: #5541D7 !important;
        color: #fff !important;
    }

</style>


<div class="container">
    <div class="row">
      <div class="col d-flex justify-content-between align-items-center custom-container">
        <!-- Add Person Button -->
        <button class="btn btn-custom d-flex align-items-center">
          <i class="bi bi-person-plus me-2"></i> Add Person
        </button>
        
        <!-- Search Input with Button -->
        <div class="input-group w-auto">
          <input type="text" class="form-control" placeholder="Search by name, Email, Number" aria-label="Search">
          <button class="btn btn-outline-secondary"  type="button">
            <i class="fas fa-list" style="color: #5541D7;"></i> <!-- Icon for filtering -->
          </button>
        </div>
      </div>
    </div>
  </div>


  <div class="container mt-3">
    <div class="d-flex justify-content-between">
      <!-- Left side: 4 outlined buttons with icons -->
      <div>
        <button class="btn btn-sm buttons">
          Select All
        </button>
        <button class="btn btn-sm buttons">
            <i class="far fa-comment"></i> Text
        </button>
        <button class="btn btn-sm buttons">
            <i class="far fa-envelope"></i> Mail
        </button>
        <button class="btn btn-sm buttons">
          <i class="fab fa-whatsapp"></i> Whatsapp
        </button>
        <button class="btn btn-sm buttons">
            <i class="fas fa-bell"></i> Notifications
        </button>
      </div>
      
      <!-- Right side: 2 simple buttons with icons -->
      <div>
        <button class="btn btn-sm button-outlined">
            <i class="fas fa-download me-1"></i> Export
        </button>
        <button class="btn btn-sm button-outlined">
            <i class="fas fa-th"></i> More Options
        </button>
      </div>
    </div>
  </div>

  <div class="container my-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-muted">
                <tr>
                    <th scope="col"><input type="checkbox"></th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">MOBILE</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <!-- Repeat this row for each entry -->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="User Photo" class="table-img me-2">
                            <span>KARIM BAIG</span>
                        </div>
                    </td>
                    <td>testing@gmail.com</td>
                    <td>+9231234567</td>
                    <td>
                        <button class="btn btn-sm ">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="User Photo" class="table-img me-2">
                            <span>KARIM BAIG</span>
                        </div>
                    </td>
                    <td>testing@gmail.com</td>
                    <td>+9231234567</td>
                    <td>
                        <button class="btn btn-sm ">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="User Photo" class="table-img me-2">
                            <span>KARIM BAIG</span>
                        </div>
                    </td>
                    <td>testing@gmail.com</td>
                    <td>+9231234567</td>
                    <td>
                        <button class="btn btn-sm ">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="User Photo" class="table-img me-2">
                            <span>KARIM BAIG</span>
                        </div>
                    </td>
                    <td>testing@gmail.com</td>
                    <td>+9231234567</td>
                    <td>
                        <button class="btn btn-sm ">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </td>
                </tr>
                <!-- Repeat the above <tr> block as needed -->
            </tbody>
        </table>
    </div>


    <div class="d-flex justify-content-between align-items-center ">
        <nav>
            <ul class="pagination mb-0">
                <li class="page-item disabled">
                    <a class="page-link custom-pagination" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link custom-pagination" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link custom-pagination" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link custom-pagination" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link custom-pagination" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <span class="pagination-summary">1 - 5 of 328 Members</span>
    </div>
    

@endsection