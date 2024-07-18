<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
  
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  
  <!-- Layout styles -->
  <link rel="stylesheet" href="admin/assets/css/style.css">
  
  <!-- Custom styles -->
  <style>
    body {
      background-color: #1b1b1b;
      color: #ffffff;
    }
    .table {
      background-color: #2c2c2c;
    }
    .table th, .table td {
      color: #ffffff;
      font-size: 16px;
    }
    .table th {
      background-color: #3b3b3b;
    }
    .table img {
      max-width: 150px; /* Increased size */
      height: auto; /* Maintain aspect ratio */
      height: 100px !important;
      width: 100px !important;
      border-radius: 5px;
    }
    .btn-edit {
      background-color: #ffc107;
      border: none;
    }
    .btn-delete {
      background-color: #dc3545;
      border: none;
    }
    .description-cell {
      max-width: 200px; /* Adjust as needed */
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    .table-container {
      overflow-x: auto;
      max-height: 600px; /* Adjust height as needed */
      overflow-y: auto;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1"></div>
        </div>
      </div>
    </div>
    
    <!-- partial:partials/_sidebar.html -->
    @include('admin.slidebar')
    
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      @include('admin.navebar')
      
      <div class="main-panel">
        <div class="content-wrapper">
          <h2 class="mb-4">Product List</h2>
          
          @if(session('message'))
            <div class="alert alert-success">
              {{ session('message') }}
            </div>
          @endif
          
          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          <div class="table-container">
            <table class="table">
              @csrf
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Discount Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->title }}</td>
                  <td class="description-cell">{{ $product->description }}</td>
                  <td><img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->title }}" width="100"></td>
                  <td>{{ $product->category->Category_name ?? 'N/A' }}</td>
                  <td>{{ $product->quantity }}</td>
                  <td>${{ number_format($product->price, 2) }}</td>
                  <td>${{ number_format($product->discount_price, 2) }}</td>
                  <td>
                    <a href="{{url('update_product', $product->id)}}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{url('delete_product', $product->id)}}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <!-- partial:partials/_footer.html -->
      @include('admin.footer')
      <!-- partial -->
    </div>
  </div>

  <!-- plugins:js -->
  <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- Plugin js for this page -->
  <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
  <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <script src="admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- inject:js -->
  <script src="admin/assets/js/off-canvas.js"></script>
  <script src="admin/assets/js/hoverable-collapse.js"></script>
  <script src="admin/assets/js/misc.js"></script>
  <script src="admin/assets/js/settings.js"></script>
  <script src="admin/assets/js/todolist.js"></script>
  <!-- Custom js for this page -->
  <script src="admin/assets/js/dashboard.js"></script>
</body>
</html>
