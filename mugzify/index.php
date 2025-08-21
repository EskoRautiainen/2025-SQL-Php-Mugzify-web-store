<?php
session_start();  // Käynnistetään istunto
?>

<!-- PHP session (session_start()) allows data to be retained between the user's browser and server across multiple page loads. 
 It is especially useful when you want to remember the user's state information (such as login details) without having to permanently store the data in the browser. 
 Why use sessions? User-specific data: You can remember the user's state (e.g., login details) across multiple page visits.
 No unnecessary storage in the browser: Unlike cookies, the session data is not stored directly on the user's device (although the session ID might be in a cookie); the data stays on the server. 
 This makes sessions a more secure way to store data compared to cookies, as they are not directly visible to the user. -->

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

  <!-- Translation Button -->
  <div id="translateButton" title="Switch Language">
    <img id="flagImage" src="images/Flag_of_Sweden.svg.png" alt="Swedish Flag">
  </div>

  <!-- Article Section -->
  <article class="mugzify">
    <img src="images/logomug.png" class="feature-img" alt="Mugzify Logo">
    <h1>Mugzify</h1>

    <!-- Navigation and Content Section -->
    <div class="menu">
      <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>

          <!-- Hamburger Menu Button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Printing service
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#createmugs">Create An Item</a></li>
                  <li><a class="dropdown-item" href="#guidetomugs">Guide To Selecting A Picture</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  About Us
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#story">Our Story</a></li>
                  <li><a class="dropdown-item" href="#reviews">Our Reviews</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Learn More
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#delivery">Delivery</a></li>
                  <li><a class="dropdown-item" href="#faqs">FAQs</a></li>
                  <li><a class="dropdown-item" href="#contact">Contact</a></li>
                </ul>
              </li>
            </ul>


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

              <!--This line checks if the $_SESSION['email'] variable is not set (i.e., the user is not logged in). 
              If the session does not contain an email (indicating the user is not logged in), it will show the login and register buttons. -->



            <!-- Shopping Cart Icon -->
            <a class="navbar-brand ms-auto" href="cart/cart.php">
              <img src="images/cart2.png" alt="Shopping Cart" style="height: 32px; width: 32px;">
            </a>
          </div>
        </div>
      </nav>
    </div>  
  </article>
  <!-- Article Section for Navigation ends -->

  <!-- Slideshow Section -->
  <section class="container">
    <div class="slider-wrapper">
      <div class="slider">
        <img src="images/yourdesign.jpg" alt="Design Slide" class="slide" id="slide-1">
        <img src="images/Baby.jpg" alt="Baby Slide" class="slide" id="slide-2">
        <img src="images/Black.png" alt="Black Mug Slide" class="slide" id="slide-3">
      </div>

      <div class="slider-nav">
        <a href="#slide-1" class="slider-nav-link"></a>
        <a href="#slide-2" class="slider-nav-link"></a>
        <a href="#slide-3" class="slider-nav-link"></a>
      </div>
    </div>
  </section>

  <!-- Javascript for Slideshow -->
  <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slider img');
    const navLinks = document.querySelectorAll('.slider-nav a');
    let slideInterval;

    // Function to show the slide
    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.style.display = (i === index) ? 'block' : 'none';
      });
      navLinks.forEach((link, i) => {
        link.style.opacity = (i === index) ? 1 : 0.5;
      });
    }

    // Function to go to the next slide
    function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      showSlide(currentIndex);
    }

    // Start the slideshow
    function startSlideShow() {
      slideInterval = setInterval(nextSlide, 5000);
    }

    // Start slideshow on load
    showSlide(currentIndex);
    startSlideShow();

    // Handle navigation clicks
    navLinks.forEach((link, index) => {
      link.addEventListener('click', () => {
        clearInterval(slideInterval);
        currentIndex = index;
        showSlide(currentIndex);
        startSlideShow();
      });
    });

    // Click listener on slides
    slides.forEach((slide, index) => {
      slide.addEventListener('click', () => {
        clearInterval(slideInterval);
        currentIndex = index;
        showSlide(currentIndex);
        startSlideShow();
      });
    });
  </script>

  <!-- Image Boxes Section -->
  <section class="card-container">
    <div class="card">
      <img src="images/White.avif" class="img-fluid" alt="White mug">
      <div class="padding-text">
        <p>Personalized Mugs!</p>
      </div>
    </div>

    <div class="card">
      <img src="images/Bottle.jpg" class="img-fluid" alt="Bottle">
      <div class="padding-text">
        <p>Make Every Sip Special.</p>
      </div>
    </div>

    <div class="card">
      <img src="images/Red.jpg" class="img-fluid" alt="Red mug">
      <div class="padding-text">
        <p>Your Mug, Your Story.</p>
      </div>
    </div>
  </section>

  
<!-- Farhad's introduction section starts -->
<section id="story">
  <div class="introduction">
    <p>We are Esko, Joonatan, and Farhad, a team of passionate designers and crafters united by a love for creating mugs that inspire. Founded in 2025 and based in Finland, our company is dedicated to bringing joy through thoughtfully designed mugs that brighten your day. Whether you're sipping your morning coffee or gifting a special someone, our mugs are made to bring a smile to your face. Crafted with care and creativity, each piece reflects our commitment to quality and unique design.</p>
  </div>
</section>



<!-- Joonatan's printing service section -->
<article class="Printing service"></article>
<section id="createmugs"> </section>

<header>
  <h1>Printing service</h1>
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
              Preview your picture
          </button>

          <!-- Hidden file input that is triggered by the button -->
        <input type="file" id="fileToUpload" accept="image/*" style="display:none;" onchange="previewImage(event)">
          
        <script>
          var imageName = "";  // Declare variable globally to store image name

          /*
          The button uses the onclick event to trigger the file input field. When the button is clicked, it simulates a click on the hidden file input field with the ID fileToUpload (the next input element). This allows the user to select an image file.
          The onclick="document.getElementById('fileToUpload').click();" part is essentially clicking the hidden file input field programmatically.
          
          This line declares a global variable imageName, which will be used later in the script to store the name or details of the selected image file.
          */

        
          function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {

/* FileReader() is an object that allows you to read the contents of a file (in this case, the selected image file) on the client-side (in the browser). 
This is a useful way to work with file data without needing to upload the file to the server first. */

              var preview = document.getElementById("uploadedImage");
              preview.src = reader.result;  // Set the uploaded image as the source
              // Save the image name for later
              imageName = event.target.files[0].name;
            };
            reader.readAsDataURL(event.target.files[0]);
          }
        
/* readAsDataURL(): This method reads the content of the file selected by the user as a Data URL, which encodes the file’s data in base64 format. 
The Data URL can then be used directly in the src of an image tag, making it easy to display the image without uploading it to the server first. */


function addToCart() {
            // Get the selected product (mug or bottle)
            var productType = document.querySelector('input[name="product"]:checked').value;
        
            // Get the quantity
            var quantity = document.getElementById("quantity").value;
        
            // Get the image name (if an image was selected)
            var imageToSend = imageName || "No image selected";
        
            // Collect the data to send
            var formData = new FormData();
            formData.append("productType", productType);
            formData.append("quantity", quantity);
            formData.append("imageName", imageToSend);

/* new FormData(): Creates a new FormData object, which is used to collect and send data,
 typically used for form submissions (like file uploads). */

        
            // Send the data to PHP using Fetch
            fetch('process_cart.php', {
              method: 'POST',
              body: formData
            })


/* fetch('process_cart.php', {...}): The fetch() function is used to make an HTTP request. In this case, it's sending data to a PHP file (process_cart.php) located on the server.
method: 'POST': Specifies that this is a POST request, meaning you're sending data to the server.
body: formData: The data to send is placed in the body of the request. 
This is where the FormData object, containing the collected data (product type, quantity, and image name), is passed to the server. */



            .then(response => response.text())
            .then(data => {
              alert(data); // Show the result from PHP (success or error)
            })
            .catch(error => {
              console.error('Error:', error);
            });

/* .catch(error => { ... }): If something goes wrong (e.g., network issues, server errors), this .catch() block will be triggered.
console.error('Error:', error): Logs the error to the console for debugging purposes. 
This helps track any issues that occurred during the fetch request. */

          }
        </script>

<!-- Add to cart button -->
<a href="cart/cart.php">
  <button class="cart-btn">Enter printing service</button>
</a>


      <section id="delivery"></section>
      <h3>Delivery</h3>
      <ul>
          <li>Standard Shipping: 3-5 business days. Priced 4.95€</li>
          <li>Express Shipping: 1-2 business days. Priced 9.95€</li>
          <li>Free Shipping: On orders over 50€</li>
      </ul>
  </div>
</div>


<!-- Guide to selecting a picture section -->
<section id="guidetomugs">
  <div class="image-guide">
    <h3>Guide to selecting a picture</h3>
    <p>We recommend you to select a picture with these requirements:</p>
    <p> Picture's maximum width and height should be 180x180px. </p>
    <p> Use pictures that are wide, not tall. </p>
  </div>
</section>
<!-- Guide to selecting a picture section ends -->


<!-- Farhad's reviews and FAQs section starts -->
<section id="reviews">
  <div class="reviews">
    <div class="review">
      <h3>Review 1: ⭐⭐⭐⭐⭐</h3>
      <p>"I love my customized mug! The design is perfect and the quality is excellent. It’s become my go-to for coffee mug every morning!"</p>
    </div>
    <div class="review">
      <h3>Review 2: ⭐⭐⭐⭐⭐</h3>
      <p>"This mug is amazing! The print is vibrant, and it feels really durable. A unique and personal touch to my daily routine!"</p>
    </div>
    <div class="review">
      <h3>Review 3: ⭐⭐⭐⭐⭐</h3>
      <p>"My custom mug turned out great! The design is clear, and it’s the perfect size. I get compliments every time I use it!"</p>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section id="faqs">
  <h2>Frequently Asked Questions</h2>
  <details>
    <summary>How can I customize my mug or bottle?</summary>
    <p class="customer-satisfaction">You can easily customize your mug or bottle using our design tool! Upload your image, add text, choose colors, and preview your design before placing your order. Simply click "Start Customizing" to begin.</p>
  </details>
  <details>
    <summary>What file formats can I upload for custom designs?</summary>
    <p class="customer-satisfaction">We accept popular file formats like JPEG, PNG, PDF, and SVG. For the best results, ensure your image has a high resolution (300 DPI or higher).</p>
  </details>
  <details>
    <summary>Can I order in bulk for events or businesses?</summary>
    <p class="customer-satisfaction">Yes! We offer special discounts for bulk orders, perfect for events, corporate gifts, or promotional items. Contact us via [link to contact form] to discuss pricing and customization options.</p>
  </details>
  <details>
    <summary>What if I’m not satisfied with my custom product?</summary>
    <p class="customer-satisfaction">We strive for 100% customer satisfaction. If your order arrives damaged or there’s an issue with the customization, let us know within 7 days of delivery. We’ll work with you to resolve the problem, whether through a replacement or refund.</p>
  </details>
  <details>
    <summary>How long does it take to process and deliver my order?</summary>
    <p class="customer-satisfaction">Once you place your order, it typically takes 2–3 business days to create your custom product. Shipping times vary based on your location and chosen delivery method. You’ll receive a tracking link once your order ships.</p>
  </details>
</section>
<!-- FAQ Section ends -->

<!-- Joonatan's translation section starts -->
<script>

const storyEnglish = 
  "We are Esko, Joonatan, and Farhad, a team of passionate designers and crafters united by a love for creating mugs that inspire. Founded in 2025 and based in Finland, our company is dedicated to bringing joy through thoughtfully designed mugs that brighten your day. Whether you're sipping your morning coffee or gifting a special someone, our mugs are made to bring a smile to your face. Crafted with care and creativity, each piece reflects our commitment to quality and unique design.";

  const storySwedish = 
  "Vi är Esko, Joonatan och Farhad, ett team av passionerade designers och hantverkare förenade av kärleken till att skapa inspirerande muggar. Grundat 2025 och baserat i Finland är vårt företag dedikerat till att sprida glädje genom genomtänkt designade muggar som lyser upp din dag. Oavsett om du njuter av ditt morgonkaffe eller ger bort en speciell present är våra muggar skapade för att ge ett leende. Med omsorg och kreativitet speglar varje mugg vårt engagemang för kvalitet och unik design.";

  const faqsEnglish = [
    {
      question: "How can I customize my mug or bottle?",
      answer: "You can easily customize your mug or bottle using our design tool! Upload your image, add text, choose colors, and preview your design before placing your order. Simply click 'Start Customizing' to begin."
    },
    {
      question: "What file formats can I upload for custom designs?",
      answer: "We accept popular file formats like JPEG, PNG, PDF, and SVG. For the best results, ensure your image has a high resolution (300 DPI or higher)."
    },
    {
      question: "Can I order in bulk for events or businesses?",
      answer: "Yes! We offer special discounts for bulk orders, perfect for events, corporate gifts, or promotional items. Contact us via [link to contact form] to discuss pricing and customization options."
    },
    {
      question: "What if I’m not satisfied with my custom product?",
      answer: "We strive for 100% customer satisfaction. If your order arrives damaged or there’s an issue with the customization, let us know within 7 days of delivery. We’ll work with you to resolve the problem, whether through a replacement or refund."
    },
    {
      question: "How long does it take to process and deliver my order?",
      answer: "Once you place your order, it typically takes 2–3 business days to create your custom product. Shipping times vary based on your location and chosen delivery method. You’ll receive a tracking link once your order ships."
    }
  ];

  const faqsSwedish = [
    {
      question: "Hur kan jag anpassa min mugg eller flaska?",
      answer: "Du kan enkelt anpassa din mugg eller flaska med vårt designverktyg! Ladda upp din bild, lägg till text, välj färger och förhandsgranska din design innan du gör din beställning. Klicka bara på 'Börja anpassa' för att komma igång."
    },
    {
      question: "Vilka filformat kan jag ladda upp för anpassade designer?",
      answer: "Vi accepterar populära filformat som JPEG, PNG, PDF och SVG. För bästa resultat, se till att din bild har en hög upplösning (300 DPI eller högre)."
    },
    {
      question: "Kan jag beställa i bulk för evenemang eller företag?",
      answer: "Ja! Vi erbjuder specialrabatter för beställningar i bulk, perfekt för evenemang, företagsgåvor eller reklamartiklar. Kontakta oss via [länk till kontaktformulär] för att diskutera priser och anpassningsalternativ."
    },
    {
      question: "Vad händer om jag inte är nöjd med min anpassade produkt?",
      answer: "Vi strävar efter 100 % kundnöjdhet. Om din beställning anländer skadad eller om det finns problem med anpassningen, meddela oss inom 7 dagar efter leverans. Vi arbetar med dig för att lösa problemet, antingen genom en ersättning eller återbetalning."
    },
    {
      question: "Hur lång tid tar det att bearbeta och leverera min beställning?",
      answer: "När du gör din beställning tar det vanligtvis 2–3 arbetsdagar att skapa din anpassade produkt. Leveranstiden varierar beroende på din plats och vald leveransmetod. Du får en spårningslänk när din beställning skickas."
    }
  ];

  const reviewsEnglish = [
    { title: "Review 1: ⭐⭐⭐⭐⭐", text: '"I love my customized mug! The design is perfect and the quality is excellent. It’s become my go-to for coffee mug every morning!"' },
    { title: "Review 2: ⭐⭐⭐⭐⭐", text: '"This mug is amazing! The print is vibrant, and it feels really durable. A unique and personal touch to my daily routine!"' },
    { title: "Review 3: ⭐⭐⭐⭐⭐", text: '"My custom mug turned out great! The design is clear, and it’s the perfect size. I get compliments every time I use it!"' }
  ];

  const reviewsSwedish = [
    { title: "Recension 1: ⭐⭐⭐⭐⭐", text: '"Jag älskar min anpassade mugg! Designen är perfekt och kvaliteten är utmärkt. Den har blivit min favoritmugg varje morgon!"' },
    { title: "Recension 2: ⭐⭐⭐⭐⭐", text: '"Den här muggen är fantastisk! Trycket är livfullt och den känns verkligen hållbar. En unik och personlig touch till min dagliga rutin!"' },
    { title: "Recension 3: ⭐⭐⭐⭐⭐", text: '"Min anpassade mugg blev jättebra! Designen är tydlig och den har perfekt storlek. Jag får komplimanger varje gång jag använder den!"' }
  ];

  let isSwedish = false; // start in English
  const swedishFlag = "images/Flag_of_Sweden.svg.png";
  const englishFlag = "images/Flag_of_the_United_Kingdom.png";

  // Function to initialize content in English
  function initializeTranslation() {
    const flagImage = document.getElementById('flagImage');
    flagImage.src = swedishFlag; // Show Swedish flag (indicating you can switch to Swedish)
    flagImage.alt = "Swedish Flag";

    const faqsSection = document.getElementById('faqs');
    faqsSection.querySelectorAll('details').forEach((detail, index) => {
      detail.querySelector('summary').textContent = faqsEnglish[index].question;
      detail.querySelector('p').textContent = faqsEnglish[index].answer;
    });
  }

  function toggleTranslation() {
    const faqsSection = document.getElementById('faqs');
    const reviewsSection = document.querySelector('.reviews');
    const storySection = document.querySelector('#story .introduction p');
    const flagImage = document.getElementById('flagImage');

    if (isSwedish) {
      flagImage.src = swedishFlag; // Show Swedish flag
      flagImage.alt = "Swedish Flag";

      faqsSection.querySelectorAll('details').forEach((detail, index) => {
        detail.querySelector('summary').textContent = faqsEnglish[index].question;
        detail.querySelector('p').textContent = faqsEnglish[index].answer;
      });

      reviewsSection.innerHTML = '';
      reviewsEnglish.forEach(review => {
        const div = document.createElement('div');
        div.classList.add('review');
        div.innerHTML = `<h3>${review.title}</h3><p>${review.text}</p>`;
        reviewsSection.appendChild(div);
      });

      storySection.textContent = storyEnglish;

    } else {
      flagImage.src = englishFlag; // Show English flag
      flagImage.alt = "English Flag";

      faqsSection.querySelectorAll('details').forEach((detail, index) => {
        detail.querySelector('summary').textContent = faqsSwedish[index].question;
        detail.querySelector('p').textContent = faqsSwedish[index].answer;
      });

      reviewsSection.innerHTML = '';
      reviewsSwedish.forEach(review => {
        const div = document.createElement('div');
        div.classList.add('review');
        div.innerHTML = `<h3>${review.title}</h3><p>${review.text}</p>`;
        reviewsSection.appendChild(div);
      });
    }

    storySection.textContent = storySwedish;

    isSwedish = !isSwedish;
    faqsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  initializeTranslation();
  document.getElementById('translateButton').addEventListener('click', toggleTranslation);
</script>

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

<!-- Enter mysql: docker exec -it web-dev-env-main-db-1 mysql -u esko -p -->


