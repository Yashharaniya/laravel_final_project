<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <link rel="icon" href="https://png.pngtree.com/template/20190928/ourmid/pngtree-gold-furniture-lamp-chair-interior-logo-design-template-inspirat-image_312127.jpg" type="">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="user/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="user/css/tiny-slider.css" rel="stylesheet">
  <link href="user/css/style.css" rel="stylesheet">
</head>
<body>
  @include('user.header')

  <div class="container">
    <h1 class="my-4">Shopping Cart</h1>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($cart && count($cart) > 0)
      <table class="table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cart as $item)
            <tr>
              <td><img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="100"></td>
              <td>{{ $item->product->name }}</td>
              <td>${{ $item->product->price }}</td>
              <td>
                <form action="{{ route('cart.update') }}" method="POST" style="display: inline-block;">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                  <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 70px; display: inline-block;">
                  <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
              </td>
              <td>${{ $item->product->price * $item->quantity }}</td>
              <td>
                <form action="{{ route('remove.from.cart') }}" method="POST" style="display: inline-block;">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                  <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
            <td><strong>${{ $subtotal }}</strong></td>
            <td></td>
          </tr>
        </tfoot>
      </table>

      <div class="row">
        <div class="col-md-6">
          <a href="{{ url('shop') }}" class="btn btn-outline-primary">Continue Shopping</a>
        </div>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
      </div>
    @else
      <p>Your cart is empty.</p>
    @endif
  </div>

  @include('user.footer')

  <!-- Scripts... -->
</body>
</html>
