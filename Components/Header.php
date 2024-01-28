<?php
class Header
{
  public function Header($logo, $home, $about)
  {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>

      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />

      <!-- fonts style -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

      <!-- font awesome style -->
      <link href="../../css/font-awesome.min.css" rel="stylesheet" />

      <!-- Custom styles for this template -->
      <link href="../../css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="../../css/responsive.css" rel="stylesheet" />
    </head>

    <body>
      <header class="header_section" style="border-bottom: 0.2rem solid #cccccc">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" >
              <?php
              echo "<img src = '$logo' alt = 'logo'/>";
              ?>

            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo $home;?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $about;?>">About</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="service.html">Services</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact Us</a>
                </li> -->
              </ul>

            </div>
          </nav>
        </div>
      </header>
    </body>

    </html>

<?php
  }
}
?>