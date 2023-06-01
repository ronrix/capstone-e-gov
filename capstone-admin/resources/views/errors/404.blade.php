  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="This is Municipality of Pililla Government Website" >
    <title>Pililla Rizal</title>


    @vite("resources/css/app.css")
    <style>
      body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      div {
        position: relative;
      }
      object {
        width: 100vw;
        height: 100vh;
      }
      h1 {
        position: absolute;
        color: #f2f2f2;
        font-size: 2em;
        display: flex;
        flex-direction: column;
        top: 70%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
      }
      span {
        font-weight: 700;
      }
      button {
        color: #3cbfc5;
        font-size: 1em;
        text-transform: uppercase;
        width: auto;
        margin 0 auto;
      }
      button:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class="relative">
      <object
        type="image/svg+xml"
        data="https://cdn.svgator.com/images/2022/01/404-svg-animation.svg"
        alt="Kitty Yarn Play 404 SVG animation example"
      ></object>

      <h1>
        <span >Sorry!</span>
        We can't find the page you're looking for!

        <button onclick="history.back()" class="block text-xl text-[] hover:underline uppercase mt-2 w-fit mx-auto"
          >go back</button
        >
      </h1>
    </div>
  </body>
  </html>