<?php
class MenuBox
{

  public function menubox($img, $title, $path)
  {
  
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
      <style>
        .munubox_container {
          display: flex;
          margin: 0.6rem 0rem 0rem 1.25rem;
        }

        .box {
          width: 100%;
          height: 3.5rem;
          padding: 0rem 1.25rem;
          color: rgb(38, 38, 38);
          display: flex;
          justify-content: left;
          align-items: center;
          cursor: pointer;
          font-size: smaller;
        }

        .box i {
          margin: 0rem 1.5rem 0rem 0rem;
        }

        .box div {
          width: 100%;
          height: 100%;
        }

        .box:hover {
          border-top-left-radius: 2rem;
          border-bottom-left-radius: 2rem;
          color: #2D54FF;
          box-shadow: 2px 2px 10px #bfbfbf,
            -2px -2px 15px #ffffff;
        }

        a:active {
          color: #2D54FF;
        }

        #image {
          font-size: 1.3rem;
        }


        @keyframes Animation {
          from {
            width: 0rem;
            opacity: 0;
          }

          to {
            width: 12rem;
            opacity: 1;
          }
        }
      </style>
    </head>

    <body>
      <div class="menubox_container">
        <?php
        echo "<a href='$path' class='box' id = 'link'><i class = '$img' id='image'></i> $title</a>"
        ?>
      </div>
    </body>

    </html>

<?php

  }
}
?>