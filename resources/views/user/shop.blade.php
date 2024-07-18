<!-- resources/views/product/index.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
    <title>Products</title>
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5%;
        }
        .product-item {
            flex: 1 0 21%;
            box-sizing: border-box;
            text-align: center;
            margin-bottom: 30px;
            max-width: 325px;
        }
        .product-thumbnail {
            width: 280px;
            height: 280px;
            object-fit: contain;
            background-color: #f0f0f0;
        }
        .product-description {
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-price-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .pagination-controls {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    @include('user.header')

    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <h1>Shop</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="category-filter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Filter by Category</h2>
                    <div class="filter-options">
                        <button class="btn btn-primary filter-btn" data-category="all">All</button>
                        @foreach ($categories as $category)
                            <button class="btn btn-primary filter-btn" data-category="{{ $category->id }}">{{ $category->Category_name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row product-list">
                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 product-item" data-category="{{ $product->category_id }}">
                        <a class="product-link" href="#">
                            <img src="{{ asset('images/' . $product->image) }}" width="200px" height="200px" alt="{{ $product->title }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $product->title }}</h3>
                            <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                            <div class="product-price-wrapper">
                                <span class="product-price"><del>${{ $product->price }}</del></span>
                                <strong class="product-discount-price">${{ $product->discount_price }}</strong>
                            </div>
                            <p class="product-category">Category: {{ $product->category->Category_name }}</p>
                            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
              </form>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @include('user.footer')

    <script src="{{ asset('user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const products = document.querySelectorAll('.product-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const category = button.getAttribute('data-category');

                    products.forEach(product => {
                        if (category === 'all' || product.getAttribute('data-category') === category) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
