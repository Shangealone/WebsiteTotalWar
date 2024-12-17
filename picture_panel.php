<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Gallery</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="image-gallery" id="uniqueImageGallery">
    <img src="Picpanel/Warhammer.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer2.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer3.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer4.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer5.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer6.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Warhammer7.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Threekingdoms.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Shogun.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Rome 2.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Napoleon.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Attila2.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Attila.jpg" class="active" alt="Image 1">
    <img src="Picpanel/Attiila3.jpg" class="active" alt="Image 1">
    <img src="Pictures/Warhammer.jpg" class="active" alt="Image 1">
    <img src="Website/Britonnia.jpg" alt="Image 2">
    <img src="Pictures/Attila.jpg" alt="Image 3">
    <img src="Pictures/Three Kingdoms.jpg" alt="Image 4">
    <img src="Pictures/War hammer.jpg" alt="Image 5">
    <button class="nav-button left-button" id="prevButton" onclick="prevImage()">&#10094;</button>
    <button class="nav-button right-button" id="nextButton" onclick="nextImage()">&#10095;</button>
  </div>

  <script>
    let currentIndex = 0; // Initialize the current image index
    const images = document.querySelectorAll('.image-gallery img'); // Select all images in the gallery

    function showImage(index) {
      images.forEach((img, i) => {
        img.classList.toggle('active', i === index); // Show the active image and hide others
        img.style.display = (i === index) ? 'block' : 'none'; // Manage image display
      });
    }

    function nextImage() {
      currentIndex = (currentIndex + 1) % images.length; // Increment index and loop back if at end
      showImage(currentIndex); // Show the new image
    }

    function prevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length; // Decrement index and loop back if at start
      showImage(currentIndex); // Show the new image
    }

    // Initially show the first image
    showImage(currentIndex);
  </script>
</body>
</html>
