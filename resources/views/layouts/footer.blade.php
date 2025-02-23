
<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
  <div class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-twitter-x"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="bi bi-github"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container-fluid text-center text-md-start mt-1">
      <!-- Grid row -->
      <div class="row mt-1">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-1">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-1">
          <a href="#">
          <i class="bi bi-house-heart"></i>
        </a>CSMS APPLICATION
          </h6>
          <p>
            Terms And Conditions.
          </p>
          <p>
            <i class="bi bi-envelope-fill"></i>
            <a href="mailto:<?php echo Auth::user()->email; ?>"><?php echo Auth::user()->email; ?></a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Features
          </h6>
          <p>
            <a href="#!" class="text-reset">Assignments.</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Library.</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Fee.</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Communications</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Profile</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">link</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="bi bi-geo-alt-fill"></i> Kisumu, Ksm 41, KENYA</p>
          <p>
            <i class="bi bi-envelope-fill"></i>
            <a href="mailto:omondimichaellokoth.com">omondimichaellokoth@gmail.com</a>
          </p>
          <p><i class="bi bi-telephone-fill"></i> + 254 762 307 016</p>
          <p><i class="bi bi-telephone-fill"></i> + 254 791 716 367</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-reset fw-bold" href="#!">My CSMS App</a>
  </div>
  <!-- Copyright -->
</footer>
        <article>
                <section id="sessionIdSec"><?php echo Auth::user()->id; ?></section>
        </article>
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
