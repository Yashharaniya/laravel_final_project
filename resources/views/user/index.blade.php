<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
		<title>project </title>
	</head>
	<style>
		.hero {
    position: relative;
    padding: 60px 0; /* Adjust padding as needed */
}

.hero .hero-img-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%; /* Ensure it takes full width */
}

.hero-img-wrap img {
    width: 100%; /* Ensure image width is 100% of its container */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Ensure image is displayed */
}

@media (max-width: 992px) {
    .hero {
        padding: 30px 0; /* Adjust for smaller screens */
    }

}

	</style>

	<body>
<!-- Start Header/Navigation -->
		@include('user.header')
<!-- End Header/Navigation -->
		<!-- Start Hero Section -->
        @include('user.hero')
		<!-- End Hero Section -->

		<!-- Start Product Section -->
        @include('user.product')
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
        @include('user.section')
		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
        @include('user.help')
		<!-- End We Help Section -->

		<!-- Start Popular Product -->
        @include('user.popular')
		<!-- End Popular Product -->

		<!-- Start Testimonial Slider -->
        @include('user.slider')
		<!-- End Testimonial Slider -->

		<!-- Start Blog Section -->
		@include('user.blog')
		<!-- End Blog Section -->	

		<!-- Start Footer Section -->
        @include('user.footer')
		<!-- End Footer Section -->	


		<script src="user/js/bootstrap.bundle.min.js"></script>
		<script src="user/js/tiny-slider.js"></script>
		<script src="user/js/custom.js"></script>
	</body>

</html>
