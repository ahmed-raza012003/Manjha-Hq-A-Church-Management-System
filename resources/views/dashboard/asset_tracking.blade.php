@extends('layouts.base')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
  /* Button Styling */
  .btn-custom {
    background-color: #5541D7;
    color: white;
    border: none;
    padding: 2px 15px;
    font-size: 14px;
    border-radius: 3px;
    margin-right: 10px; /* Adds spacing between buttons */
    display: flex;
    align-items: center;
  }
  .btn-custom:hover {
    background-color: #3A2DB3;
    color: white;
  }

  .btn-custom2{
    background-color: white;
    color: #5541D7;
    border: 1px solid #5541D7;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 3px;
    margin-right: 10px; /* Adds spacing between buttons */
    display: flex;
    align-items: center;
  }

  .btn-custom2:hover {
    background-color: white;
    color: #5541D7;
    border: 1px solid #5541D7;
  }

  /* Search Input Styling */
  .search-input {
    width: 250px;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 6px 10px;
    outline: none;
    font-size: 14px;
  }
</style>
<style>
    /* Table and Header Styling */
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead th {
      background-color: #3e3e3e;
      font-weight: normal !important;
      text-align: left;
      padding: 10px;
    }
    tbody td {
      padding: 10px;
      vertical-align: middle;
    }

    /* Checkbox Styling */
    input[type="checkbox"] {
      width: 18px;
      height: 18px;
    }

    /* Status Labels */
    .status {
      display: inline-block;
      padding: 2px 10px;
      border-radius: 15px;
      font-size: 14px;
      font-weight: 500;
    }
    .status-scheduled {
      background-color: #e0e7ff;
      color: #5a67d8;
    }
    .status-active {
      background-color: #c6f6d5;
      color: #2f855a;
    }
    .status-draft {
      background-color: rgba(205, 110, 69, 0.22);
      color: #b28c3f;
    }

    /* Pagination */
    .pagination .page-link {
      color: #5541D7;
      border: none;
    }
    .pagination .active .page-link {
      background-color: #5541D7;
      color: white;
    }

    /* Action Menu */
    .ellipsis {
      cursor: pointer;
      font-size: 20px;
      color: #555;
    }
  </style>

<div class="container mt-1">
  <div class="row align-items-center justify-content-between">
    <!-- Left Side Buttons -->
    <div class="col-auto d-flex">
      <button class="btn btn-custom">
        <i class="bi bi-plus-circle me-2"></i> Add Asset
      </button>
      <button class="btn btn-custom">
        <i class="bi bi-download me-2"></i> Export
      </button>
      <!-- Filter Dropdown Button -->
<div class="dropdown">
    <button class="btn btn-custom2 dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bi bi-filter me-2"></i> Filter
    </button>
    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
      <li><a class="dropdown-item" href="#">Filter Option 1</a></li>
      <li><a class="dropdown-item" href="#">Filter Option 2</a></li>
      <li><a class="dropdown-item" href="#">Filter Option 3</a></li>
    </ul>
  </div>
  
      <button class="btn btn-custom2">
        Pending Returns
      </button>
    </div>

    <!-- Right Side Search -->
    <div class="col-auto">
      <div class="input-group">
        <input type="text" class="form-control search-input" placeholder="Search by Asset name, Type, Status">
      </div>
    </div>
  </div>
</div>


<div class="container mt-4">
    <table class="table">
      <thead>
        <tr>
          <th><input type="checkbox"></th>
          <th>Asset</th>
          <th>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle p-0 border-0" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                CATEGORY
              </button>
              <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                <li><a class="dropdown-item" href="#">All Categories</a></li>
                <li><a class="dropdown-item" href="#">Electronics</a></li>
                <li><a class="dropdown-item" href="#">Furniture</a></li>
                <li><a class="dropdown-item" href="#">Clothing</a></li>
                <li><a class="dropdown-item" href="#">Toys</a></li>
              </ul>
            </div>
          </th>
          <th>Price</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <img src="https://via.placeholder.com/50" alt="Laptop" class="me-2">
            Laptop#12345
          </td>
          <td>Electronics</td>
          <td>$79.80</td>
          <td>79</td>
          <td><span class="status status-scheduled">Scheduled</span></td>
          <td><span class="ellipsis">⋯</span></td>
        </tr>
        <!-- Row 2 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <img src="https://via.placeholder.com/50" alt="Laptop" class="me-2">
            Laptop#12345
          </td>
          <td>Electronics</td>
          <td>$79.80</td>
          <td>79</td>
          <td><span class="status status-active">Active</span></td>
          <td><span class="ellipsis">⋯</span></td>
        </tr>
        <!-- Row 3 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <img src="https://via.placeholder.com/50" alt="Laptop" class="me-2">
            Laptop#12345
          </td>
          <td>Electronics</td>
          <td>$79.80</td>
          <td>79</td>
          <td><span class="status status-draft">Draft</span></td>
          <td><span class="ellipsis">⋯</span></td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  
    <!-- Pagination -->
    <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
        <!-- Pagination Links -->
        <ul class="pagination mb-0">
          <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="#">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      
        <!-- Pagination Summary -->
        <span class="pagination-summary text-muted">1 - 3 of 328 Items</span>
      </nav>
      
    
  </div>
  

  @endsection