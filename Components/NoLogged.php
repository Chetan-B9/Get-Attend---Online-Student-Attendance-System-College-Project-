<?php
class NoLoggedMessage
{
  public function warningBox()
  {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        body {
          display: flex;
          justify-content: center;
          align-items: center;
        }

        #warning_box {
          margin: 2rem;
          width: 22rem;
          padding: 2rem;
          background: #f5f5f5;

          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          font-family: 'Poppins', sans-serif;
          box-shadow: 5px 5px 5px #d9d9d9,
            -0.5px -0.5px 5px #ffffff;
        }

        #warning_box h1 {
          font-size: 4rem;
          margin-top: 0rem;
          margin-bottom: 0rem;
        }

        #warning_box h1,
        h5 {
          text-align: center;
        }

        #button_box {
          display: flex;
          justify-content: center;
        }

        button {
          width: 10rem;
          height: 2.8rem;
          border-radius: 3rem;
          background: #2D54FF;
          border: 0.25rem solid #D5DDFE;

          color: white;
          cursor: pointer;
        }

        button:hover {
          transition: all .3s;
          background-color: transparent;
          color: #2D54FF;
        }
      </style>
    </head>

    <body>
      <div id="warning_box">
        <h1>🤔</h1>
        <h3>I think you entered wrong login data</h3>
        <div id="button_box">
          <button onclick="window.location.href = '../Teacher Pages/Login_page.php'">Try Again</button>
        </div>
      </div>
    </body>

    </html>
<?php
  }
}
?>