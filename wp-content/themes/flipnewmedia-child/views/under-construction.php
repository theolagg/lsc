
<?php
/*
Template Name:  construction
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WallyPass – Coming Soon</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --brand-red: #ff342a;
      --brand-burgundy: #5b003a;
      --text-dark: #2b0a1e;
      --bg: #ffffff;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
    font-family:'Manrope',sans-serif;
      background: var(--bg);
      color: var(--text-dark);
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
    }

 .loader-bg2{
 display:none;}

    .page {
    width: 100%;
    margin: auto;
    position: relative;
    overflow: hidden;
    display: flex
    ;
        height: 100%;
    align-items: center;
    justify-content: center;
    gap: 2rem;
    }
    /* LOGO */
    .logo {
      position: absolute;
      top: 32px;
      left: 32px;
        width: 100%;
        max-width: 242px;
    }

    .logo img {
      width: 100%;
      height: auto;
    }

    /* COPY */
    h1 {
      font-size: clamp(42px, 9vw, 160px);
      font-weight: 800;
      line-height: 0.9;
      color: var(--brand-red);
      margin-top: 1.25rem;
      text-transform: uppercase;
      letter-spacing: -2px;
    }

    /* LOADER */
    .loader-wrap {
    position: relative;
    width: 100%;
    max-width: 1030px;
    margin: 12vh auto 7vh auto;
    }

    img.digitalpasses {
    width: 100%;
    padding: 0 35px;
        z-index: 1;
    position: relative;
}

    .loader-bg {
      width: 100%;
      display: block;
    }

    .progress-bar {
      position: absolute;
      left: 6.5%;
      top: 50%;
      transform: translateY(-50%);
      height: 64px;
      /* adjust to match image */
      width: 73%;
      /* adjust to match image */
      border-radius: 40px;
      overflow: hidden;
      background: #ffffffaa;
      box-shadow: 0 0 6px rgba(0, 0, 0, .1) inset;
    }

    .progress {
      height: 100%;
      width: 80%;
      background: var(--brand-red);
      animation: fill 4s ease-in-out infinite;
    }

    .progress-text {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      font-weight: 600;
      color: #fff;
      mix-blend-mode: normal;
      pointer-events: none;
    }


    /* PERSON IMAGE */
    .person {
      max-height: 100vh;
    object-fit: contain;
    align-self: flex-end;
    position: absolute;
    right: 0;
    z-index: 0;
    }

    /* STACK ON MOBILE */
    @media(max-width:900px) {
      .page {
        flex-direction: column-reverse;
        justify-content: center;
        text-align: center;
        padding-top: 120px;
      }
      

      .logo {
        left: 50%;
        transform: translateX(-50%);
      }

        .loader-wrap {
        margin: 10.5rem auto 1rem;
    }

          .person {
            bottom: 0;
        min-width: 500px;
       
}
.loader-bg2{ display:block;
        width: 100%;
}
.loader-bg{ display:none;
}

section.copy {
width: 100%;
}
    

.digitalpasses{
display:none;
}
.progress-bar {
    position: absolute;
    left: 2.5%;
    top: 50%;
    transform: translateY(-50%);
    height: 45px;
    width: 95%;
    border-radius: 40px;
    overflow: hidden;
            background: white;
    box-shadow: none;
    z-index: 1;
    border: 2px solid white;
}


      h1 {
        font-size: clamp(52px, 15vw, 120px);
      }
    }


 @media(max-width:600px) {
     .person {
        width: 100%;
    }
 }

@media(max-height:840px) {

.loader-wrap {
position: relative;
width: 100%;
max-width: 800px;
margin: 12vh auto 5vh auto;
}
}


  </style>
  
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KHBVJ47Q');</script>
<!-- End Google Tag Manager -->
  
  
  
</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHBVJ47Q"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <main class="page">
    <!-- Left / Center content -->
    <section class="copy">
      <div class="logo">
        <img src="./logo.png" alt="WallyPass logo" />
      </div>

      <div class="loader-wrap">
        <!-- background shape with beveled bar (provided) -->
        <img class="loader-bg" src="./loader.png" alt="Loader background" />
        <img class="loader-bg2" src="./loader2-bg.png" alt="Loader2 background" />
        <!-- animated overlay bar -->
        <div class="progress-bar">
          <div class="progress"></div>
          <span class="progress-text">COMING SOON</span>
        </div>
      </div>

    <img class="digitalpasses" src="./digitalpasses.png" alt="digital-passes" />
    </section>

    <!-- Right person -->
    <img class="person" src="./imageperson.png" alt="Happy man using his phone" />
  </main>
</body>

</html>
