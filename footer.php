    </div>

    <hr>
    <footer class="container">
      <p>&copy; thermatk 2013</p>
    </footer>

    <script src="vendor/jquery-1.10.2.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <?php
    foreach($addscripts as $script) {
      echo '<script src="'.$script.'"></script>';
    }
    ?>
  </body>
</html>