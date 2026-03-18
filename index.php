<?php
$active_page = 'home';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Traveling Dreams & Destinations – by M. Yahya Iqbal</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    .featured-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; }
    @media(max-width:900px){ .featured-grid{grid-template-columns:1fr 1fr;} }
    @media(max-width:580px){ .featured-grid{grid-template-columns:1fr;} }

    .about-strip { display:grid; grid-template-columns:1fr 1fr; }
    .about-strip img { width:100%; height:100%; object-fit:cover; display:block; min-height:520px; }
    .about-strip-text { padding:5rem 4rem; background:var(--cream2); display:flex; flex-direction:column; justify-content:center; }
    @media(max-width:768px){ .about-strip{grid-template-columns:1fr;} .about-strip-text{padding:3rem 1.5rem;} }

    .stats-bar { background:var(--dark); padding:4.5rem 0; }
    .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:2rem; text-align:center; }
    .stat-number { font-family:'Playfair Display',serif; font-size:3.25rem; font-weight:900; color:var(--gold); line-height:1; }
    .stat-label { font-size:0.7rem; letter-spacing:0.22em; text-transform:uppercase; color:rgba(255,255,255,0.45); margin-top:0.5rem; }
    @media(max-width:640px){ .stats-grid{grid-template-columns:repeat(2,1fr);} }

    /* Destination mosaic */
    .dest-mosaic { display:grid; grid-template-columns:repeat(4,1fr); grid-template-rows:260px 260px; gap:4px; }
    .dest-tile { position:relative; overflow:hidden; }
    .dest-tile:first-child { grid-row:span 2; }
    .dest-tile img { width:100%; height:100%; object-fit:cover; transition:transform 0.55s ease; display:block; }
    .dest-tile:hover img { transform:scale(1.07); }
    .dest-label { position:absolute; bottom:0; left:0; right:0; padding:1.25rem 1rem; background:linear-gradient(to top,rgba(0,0,0,0.78),transparent); color:#fff; }
    .dest-label-region { font-size:0.64rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--gold-light); }
    .dest-label-country { font-family:'Playfair Display',serif; font-size:1.25rem; font-weight:700; }
    @media(max-width:900px){ .dest-mosaic{grid-template-columns:repeat(2,1fr); grid-template-rows:auto;} .dest-tile:first-child{grid-row:span 1;} .dest-tile{height:220px;} }
    @media(max-width:480px){ .dest-mosaic{grid-template-columns:1fr;} .dest-tile{height:200px;} }

    /* Skills ticker */
    .skills-ticker { background:var(--gold); padding:0.9rem 0; overflow:hidden; white-space:nowrap; }
    .ticker-inner { display:inline-flex; animation:tickerScroll 30s linear infinite; }
    .ticker-inner span { font-size:0.72rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:var(--dark); padding:0 2.5rem; }
    .ticker-inner span::before { content:'✦'; margin-right:2.5rem; }
    @keyframes tickerScroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<section class="hero">
  <video autoplay muted loop playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2020/05/23/40836-424698052_large.mp4" type="video/mp4">
    <source src="https://videos.pexels.com/video-files/2169880/2169880-uhd_2560_1440_30fps.mp4" type="video/mp4">
  </video>
  <!-- Fallback image -->
  <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1600&q=80"
    alt="Hero background"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <span class="hero-eyebrow">Welcome to Traveling Dreams &amp; Destinations</span>
    <h1 class="hero-title">Explore. <em>Dream.</em><br>Discover.</h1>
    <p class="hero-subtitle">A world travel blog featuring breathtaking destinations, real adventures, and hidden gems from every corner of the globe.</p>
    <div class="hero-cta-group">
      <a href="blog.php" class="hero-cta"><span>Start Exploring</span> <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i></a>
      <a href="about.php" class="hero-cta-ghost">About Me</a>
    </div>
  </div>
  <div class="scroll-indicator">
    <span>Scroll</span>
    <div class="scroll-mouse"></div>
  </div>
</section>

<!-- SKILLS TICKER -->
<div class="skills-ticker">
  <div class="ticker-inner">
    <span>Pakistan</span><span>Bali</span><span>Egypt</span><span>Santorini</span>
    <span>Colombia</span><span>Morocco</span><span>Argentina</span><span>Philippines</span>
    <span>Brazil</span><span>Jordan</span><span>Naltar Valley</span><span>Neelum Valley</span>
    <span>Pakistan</span><span>Bali</span><span>Egypt</span><span>Santorini</span>
    <span>Colombia</span><span>Morocco</span><span>Argentina</span><span>Philippines</span>
    <span>Brazil</span><span>Jordan</span><span>Naltar Valley</span><span>Neelum Valley</span>
  </div>
</div>

<!-- STATS -->
<div class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div class="reveal"><div class="stat-number">20+</div><div class="stat-label">Countries Covered</div></div>
      <div class="reveal" style="transition-delay:.1s"><div class="stat-number">50+</div><div class="stat-label">Blog Posts</div></div>
      <div class="reveal" style="transition-delay:.2s"><div class="stat-number">1</div><div class="stat-label">Year of Travel Writing</div></div>
      <div class="reveal" style="transition-delay:.3s"><div class="stat-number">∞</div><div class="stat-label">Adventures Ahead</div></div>
    </div>
  </div>
</div>

<!-- FEATURED POSTS -->
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="reveal">
      <span class="section-eyebrow">Latest Stories</span>
      <h2 class="section-title">Featured <em>Blog Posts</em></h2>
      <div class="divider"></div>
    </div>
    <div class="featured-grid" style="margin-top:3rem;">
      <div class="card reveal" style="transition-delay:.05s">
        <div class="card-img-wrap"><img class="card-img" src="https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg" alt="Naltar Valley"/></div>
        <div class="card-body">
          <span class="card-tag">Pakistan • Mountains</span>
          <h3 class="card-title">Naltar Valley: Pakistan's Hidden Gem</h3>
          <p class="card-text">Famous for colourful lakes and pine forests, Naltar is a 2.5-hour drive from Gilgit — completely otherworldly.</p>
          <a href="blog.php" class="card-link">Read Article</a>
        </div>
      </div>
      <div class="card reveal" style="transition-delay:.15s">
        <div class="card-img-wrap"><img class="card-img" src="https://i.dawn.com/large/2015/12/567d1acecd90d.jpg" alt="Neelum Valley"/></div>
        <div class="card-body">
          <span class="card-tag">Pakistan • Valley</span>
          <h3 class="card-title">Neelum Valley: Azad Kashmir's Crown Jewel</h3>
          <p class="card-text">Brooks, freshwater streams, lush green mountains and a roaring river make Neelum unforgettable.</p>
          <a href="blog.php" class="card-link">Read Article</a>
        </div>
      </div>
      <div class="card reveal" style="transition-delay:.25s">
        <div class="card-img-wrap"><img class="card-img" src="https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg" alt="Egypt"/></div>
        <div class="card-body">
          <span class="card-tag">Africa • History</span>
          <h3 class="card-title">Camel Rides and Pyramids: A Week in Egypt</h3>
          <p class="card-text">The ancient wonders of Giza, the chaos of Cairo markets, and the stillness of the desert at dawn.</p>
          <a href="blog.php" class="card-link">Read Article</a>
        </div>
      </div>
    </div>
    <div style="text-align:center;margin-top:3rem;" class="reveal">
      <a href="blog.php" class="btn btn-dark">View All Posts</a>
    </div>
  </div>
</section>

<!-- DESTINATIONS MOSAIC -->
<section class="section" style="background:var(--cream);padding-bottom:0;">
  <div class="container">
    <div class="reveal" style="text-align:center;margin-bottom:3rem;">
      <span class="section-eyebrow">Around the World</span>
      <h2 class="section-title">Top <em>Destinations</em></h2>
    </div>
  </div>
  <div class="dest-mosaic">
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg" alt="Egypt"/><div class="dest-label"><div class="dest-label-region">Africa</div><div class="dest-label-country">Egypt</div></div></div>
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg" alt="Bali"/><div class="dest-label"><div class="dest-label-region">Asia</div><div class="dest-label-country">Bali</div></div></div>
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/IZk8bOUGmZ2lqfKMaRJFeTddfm8t6V8NL6dBZVA3810.jpg" alt="Santorini"/><div class="dest-label"><div class="dest-label-region">Europe</div><div class="dest-label-country">Santorini</div></div></div>
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/k7tTey5EOe1HGnN-ff11Xeudt7HmTKlwvymicXdTP4U.jpg" alt="Argentina"/><div class="dest-label"><div class="dest-label-region">Americas</div><div class="dest-label-country">Argentina</div></div></div>
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/hUb25mkiDK1BQ9Qkkvu_ft0N9wfGec8G2JfiQRRh80I.jpg" alt="Palawan"/><div class="dest-label"><div class="dest-label-region">Asia</div><div class="dest-label-country">Palawan</div></div></div>
    <div class="dest-tile"><img src="https://storage.googleapis.com/a1aa/image/Gsbowqd53lqJDts5BOV1RBOOJFUwCCpyVnnACnfgiME.jpg" alt="Morocco"/><div class="dest-label"><div class="dest-label-region">Africa</div><div class="dest-label-country">Morocco</div></div></div>
    <div class="dest-tile"><img src="https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg" alt="Pakistan"/><div class="dest-label"><div class="dest-label-region">Asia</div><div class="dest-label-country">Pakistan</div></div></div>
  </div>
  <div style="text-align:center;padding:3rem 0;background:var(--cream);" class="reveal">
    <a href="destinations.php" class="btn btn-dark">Explore All Destinations</a>
  </div>
</section>

<!-- ABOUT STRIP -->
<section class="about-strip">
  <div style="background:linear-gradient(160deg, var(--navy) 0%, var(--navy2) 60%, var(--navy3) 100%);display:flex;align-items:flex-end;justify-content:center;overflow:hidden;min-height:520px;">
    <img src="assets/yahya.jpg" alt="M. Yahya Iqbal"
      style="width:82%;max-width:360px;display:block;object-fit:contain;margin-top:2rem;filter:drop-shadow(0 8px 32px rgba(184,150,46,0.2));"/>
  </div>
  <div class="about-strip-text reveal">
    <span class="section-eyebrow">About the Author</span>
    <h2 class="section-title">Hi, I'm <em>Yahya Iqbal</em></h2>
    <div class="divider"></div>
    <p style="color:var(--text-mid);line-height:1.9;margin-bottom:1.25rem;">
      I'm <strong>M. Yahya Iqbal</strong> — a Software Engineering student from <strong>Karachi, Pakistan</strong> at Aligarh Institute of Technology. This travel blog is my 1st year final project, built with HTML, CSS, JavaScript, PHP &amp; MySQL.
    </p>
    <p style="color:var(--text-mid);line-height:1.9;margin-bottom:2rem;">
      I started this blog to document incredible destinations across Pakistan and the world — from the valleys of Gilgit-Baltistan to the pyramids of Egypt. Every story here is written with a passion for exploration and discovery.
    </p>
    <div style="display:flex;gap:1rem;flex-wrap:wrap;">
      <a href="about.php" class="btn btn-dark">Read My Story</a>
      <a href="contact.php" class="btn btn-outline">Get in Touch</a>
    </div>
  </div>
</section>

<!-- AS SEEN IN / BUILT WITH -->
<section class="section" style="background:#fff;padding:4rem 0;">
  <div class="container" style="text-align:center;">
    <p style="font-size:0.68rem;letter-spacing:0.32em;text-transform:uppercase;color:var(--text-light);margin-bottom:2.5rem;">Built With</p>
    <div style="display:flex;align-items:center;justify-content:center;gap:3rem;flex-wrap:wrap;opacity:0.5;">
      <span style="font-family:'DM Sans',sans-serif;font-size:1.1rem;font-weight:700;letter-spacing:0.05em;">HTML5</span>
      <span style="font-family:'DM Sans',sans-serif;font-size:1.1rem;font-weight:700;">CSS3</span>
      <span style="font-family:'DM Sans',sans-serif;font-size:1.1rem;font-weight:700;">JavaScript</span>
      <span style="font-family:'DM Sans',sans-serif;font-size:1.1rem;font-weight:700;">PHP</span>
      <span style="font-family:'DM Sans',sans-serif;font-size:1.1rem;font-weight:700;">MySQL</span>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
