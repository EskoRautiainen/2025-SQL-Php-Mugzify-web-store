<?php
session_start();  // Käynnistetään istunto
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ryhmätyö</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <!-- Custom styles should be under Bootstrap's CSS -->
</head>


<body>
  <!-- Esko's section starts -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <!-- Article Section -->
  <article class="mugzify">
    <img src="images/logomug.png" class="feature-img" alt="Mugzify Logo">
    <h1>Mugzify</h1>



  <!-- Article Section for Navigation ends -->


<!-- Joonatan's printing service section -->
<article class="Printing service"></article>
<section id="createmugs"> </section>

<header>
  <h1>Printing service
  <!-- Shopping Cart Icon -->
  <a class="navbar-brand ms-auto" href="../index.php">
    <img src="images/return.png" alt="Return button" style="height: 32px; width: 32px;">
  </a>

<div class="d-flex-items">
      <!-- Kirjaudu ja Rekisteröidy napit -->
      <?php if (!isset($_SESSION['email'])): ?>
          <a href="https://shell.hamk.fi/~trtkp24_17/mugzify/php/login.php" class="btn btn-outline-primary me-2" style="background-color: #007BFF; color: white; border-color: #007BFF;">Login</a>
          <a href="https://shell.hamk.fi/~trtkp24_17/mugzify/php/registerajax.php" class="btn btn-primary me-3" style="background-color: #007BFF; color: white;">Register</a>
      <?php else: ?>
          <span class="navbar-text me-2">
              <?php echo $_SESSION['email']; ?> <!-- Näyttää käyttäjän sähköpostin -->
          </span>
          <a href="https://shell.hamk.fi/~trtkp24_17/mugzify/php/logout.php" class="btn btn-danger me-3">Log out</a>
      <?php endif; ?>



</h1>


</div>
</div>
</nav>
</div>  
</article>
</header>

<div class="container">
  <div class="product-preview">
      <!-- Mug image -->
      <img src="images/mugtransparent.png" alt="Upload your image" class="product-image">

      <!-- Div to display the uploaded image -->
      <div class="upload-preview">

        <!-- Default image (Swedish flag) that will change when user selects a new image -->
          <img id="uploadedImage" src="images/Flag_of_Sweden.svg.png" alt="Your custom picture" class="product-image">
        </div>
      </div>


      
  <div class="product-options">
      <h2>Select</h2>
      <label><input type="radio" name="product" id="mug" value="1" checked> Coffee mug - 13.95€</label><br>
      <label><input type="radio" name="product" id="bottle" value="2" > Water bottle - 15.95€</label>
  
          <!-- Select picture button -->
          <button type="button" class="upload-btn" onclick="document.getElementById('fileToUpload').click();">
              Select your picture
          </button>

          <!-- Hidden file input that is triggered by the button -->
        <input type="file" id="fileToUpload" accept="image/*" style="display:none;" onchange="previewImage(event)">
          
        <script>
          var imageName = "";  // Declare variable globally to store image name
        
          function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
              var preview = document.getElementById("uploadedImage");
              preview.src = reader.result;  // Set the uploaded image as the source
              // Save the image name for later
              imageName = event.target.files[0].name;
            };
            reader.readAsDataURL(event.target.files[0]);
          }
        
          function addToCart() {
    var productType = document.querySelector('input[name="product"]:checked').value;
    var quantity = document.getElementById("quantity").value;
    var imageToSend = imageName || "No image selected";

    // Get user details
    var name = document.getElementById("name").value;
    var address = document.getElementById("address").value;
    var postal = document.getElementById("postal").value;
    var city = document.getElementById("city").value;

    // Validate fields
    if (!name || !address || !postal || !city) {
        alert("Please fill in all shipping details.");
        return;
    }

    var formData = new FormData();
    formData.append("productType", productType);
    formData.append("quantity", quantity);
    formData.append("imageName", imageToSend);
    formData.append("name", name);
    formData.append("address", address);
    formData.append("postal", postal);
    formData.append("city", city);

    // Send data to PHP script
    fetch('process_order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Show success or error message
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
        </script>



      <!-- Quantity selection -->
      <div class="quantity">
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" value="1" min="1">
      </div>

      <section id="delivery"></section>
      <h3>Delivery</h3>
      <ul>
          <li>Standard Shipping: 3-5 business days. Priced 4.95€</li>
          <li>Express Shipping: 1-2 business days. Priced 9.95€</li>
          <li>Free Shipping: On orders over 50€</li>
      </ul>
  </div>
</div>

<!-- User Information Section -->
<div class="user-info">
  <h3>Shipping Information</h3>
  <form id="orderForm" onsubmit="event.preventDefault(); addToCart();">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required><br>

      <label for="postal">Postal Code:</label>
      <input type="text" id="postal" name="postal" required><br>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" required><br>

      <button type="submit" class="submit-btn">Finalize order</button>
  </form>
</div>

<!-- Farhad's contact info section starts -->
<div class="info">
  <div class="info-content">
    <!-- Contact Section -->
    <section id="contact">
      <h3>Contact</h3>
      <p>Email: <a href="mailto:support@mugzify.com">support@mugzify.com</a></p>
      <p>Phone: <a href="tel:1-800-123-4567">1-800-123-4567</a></p>
      <p>Address: 123 Mugzify Lane, City 55</p>
    </section>

    <!-- Payment Methods Section -->
    <div class="payment-methods">
      <h3>Payment Methods</h3>
      <img src="images/apple.png" alt="Apple Pay">
      <img src="images/visa.png" alt="Visa">
      <img src="images/mastercard.png" alt="MasterCard">
      <img src="images/images.png" alt="MasterCard">
    </div>

    <!-- Return Policy Section -->
    <div class="return-policy">
      <h3>Return and Refund</h3>
      <p>14 days return policy</p>
      <p>Refund will be in store credit</p>
    </div>
  </div>
</div>


<!-- Eskon's scrolling logo animation starts -->
<div class="scrolling-wrapper">
  <div class="scrolling-container">
    <img src="images/mugtransparent.png" alt="logo">
  </div>
</div>

<!-- JavaScript for scrolling animation -->
<script>
  const container = document.querySelector('.scrolling-container');
  const imageCount = 500;

  for (let i = 0; i < imageCount; i++) {
    const img = document.createElement('img');
    img.src = 'images/mugtransparent.png';
    img.alt = 'coffeemug logo';
    container.appendChild(img);
  }

  const images = container.querySelectorAll('img');
  images.forEach(img => {
    container.appendChild(img.cloneNode(true));
  });
</script>