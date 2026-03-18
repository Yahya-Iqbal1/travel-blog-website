<?php
$active_page = 'about';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About – Traveling Dreams & Destinations</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    /* ---- Profile layout ---- */
    .profile-grid {
      display: grid;
      grid-template-columns: 420px 1fr;
      gap: 6rem;
      align-items: start;
    }
    @media(max-width:960px){ .profile-grid{ grid-template-columns:1fr; gap:3rem; } }

    /* Photo card */
    .photo-card {
      position: relative;
      background: linear-gradient(160deg, var(--navy) 0%, var(--navy3) 60%, #1a2d47 100%);
      overflow: hidden;
    }
    .photo-card img {
      width: 100%;
      display: block;
      object-fit: contain;
      object-position: center bottom;
      max-height: 580px;
      filter: drop-shadow(0 12px 40px rgba(184,150,46,0.15));
    }
    /* Gold accent line on photo card */
    .photo-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(to right, var(--gold), var(--gold-light));
      z-index: 2;
    }
    /* Name badge bottom of photo */
    .photo-badge {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      padding: 2rem 1.75rem 1.5rem;
      background: linear-gradient(to top, rgba(14,28,47,0.95) 0%, transparent 100%);
      z-index: 1;
    }
    .photo-badge-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem; font-weight: 600; color: #fff;
    }
    .photo-badge-role {
      font-size: 0.65rem; letter-spacing: 0.28em;
      text-transform: uppercase; color: var(--gold-light);
      margin-top: 0.25rem;
    }

    /* Contact chips */
    .contact-chips {
      display: flex; flex-direction: column; gap: 0.85rem;
      margin-top: 2.5rem;
    }
    .contact-chip {
      display: flex; align-items: center; gap: 1rem;
      padding: 0.85rem 1.25rem;
      background: var(--ivory2);
      transition: background 0.2s;
    }
    .contact-chip:hover { background: var(--ivory3); }
    .contact-chip-icon {
      width: 36px; height: 36px; min-width: 36px;
      background: var(--navy); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: var(--gold-light); font-size: 0.8rem;
    }
    .contact-chip-label { font-size: 0.64rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-light); }
    .contact-chip-value { font-size: 0.9rem; color: var(--text); font-weight: 500; }
    .contact-chip a { color: var(--text); text-decoration: none; transition: color 0.2s; }
    .contact-chip a:hover { color: var(--gold); }

    /* Quote block */
    .quote-block {
      border-left: 3px solid var(--gold);
      padding: 1.5rem 2rem;
      background: var(--ivory2);
      margin: 2.5rem 0;
    }
    .quote-block p {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.35rem; font-style: italic; font-weight: 500;
      color: var(--navy); line-height: 1.6;
    }
    .quote-block span { font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold); display: block; margin-top: 0.75rem; }

    /* Travel highlights strip */
    .highlights {
      display: grid; grid-template-columns: repeat(3,1fr);
      border: 1.5px solid var(--ivory3); margin-top: 3rem;
    }
    .highlight-item {
      padding: 1.75rem 1.5rem; text-align: center;
      border-right: 1.5px solid var(--ivory3);
    }
    .highlight-item:last-child { border-right: none; }
    .highlight-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.5rem; font-weight: 600; color: var(--navy); line-height: 1;
    }
    .highlight-label {
      font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase;
      color: var(--text-light); margin-top: 0.4rem;
    }
    @media(max-width:480px){ .highlights{grid-template-columns:1fr;} .highlight-item{border-right:none;border-bottom:1.5px solid var(--ivory3);} }

    /* Journey section */
    .journey-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 1.25rem; margin-top: 3rem;
    }
    @media(max-width:640px){ .journey-grid{grid-template-columns:1fr;} }
    .journey-card {
      position: relative; overflow: hidden; aspect-ratio: 4/3;
      cursor: pointer;
    }
    .journey-card img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform 0.55s ease;
    }
    .journey-card:hover img { transform: scale(1.07); }
    .journey-card-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(14,28,47,0.82) 0%, transparent 60%);
    }
    .journey-card-info {
      position: absolute; bottom: 0; left: 0; right: 0;
      padding: 1.5rem;
    }
    .journey-card-region {
      font-size: 0.62rem; letter-spacing: 0.18em;
      text-transform: uppercase; color: var(--gold-light);
    }
    .journey-card-place {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem; font-weight: 600; color: #fff; line-height: 1.2;
    }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO VIDEO -->
<div class="page-hero" style="height:80vh;">
  <video autoplay muted loop playsinline
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
    <source src="https://cdn.pixabay.com/video/2023/08/14/175630-856514692_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
    <source src="https://videos.pexels.com/video-files/2169880/2169880-uhd_2560_1440_30fps.mp4" type="video/mp4">
  </video>
  <img src="https://images.unsplash.com/photo-1488085061387-422e29b40080?w=1600&q=80" alt="About hero"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div class="page-hero-overlay" style="background:linear-gradient(to bottom,rgba(14,28,47,0.3) 0%,rgba(14,28,47,0.78) 100%);"></div>
  <div class="page-hero-content" style="padding:0 1.5rem;">
    <span style="font-size:0.66rem;letter-spacing:0.45em;text-transform:uppercase;color:var(--gold-light);display:block;margin-bottom:1.25rem;animation:fadeInUp 0.8s ease 0.3s both;">The Story Behind the Blog</span>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,7vw,6rem);font-weight:600;animation:fadeInUp 0.9s ease 0.5s both;">About <em style="font-style:italic;color:var(--gold-pale);">Me</em></h1>
    <p style="animation:fadeInUp 1s ease 0.7s both;color:rgba(255,255,255,0.68);font-size:1rem;margin-top:1rem;">Traveler, storyteller, and software engineering student from Karachi</p>
    <div class="breadcrumb" style="animation:fadeInUp 1s ease 0.9s both;"><a href="index.php">Home</a><span>/</span><span>About</span></div>
  </div>
</div>

<!-- PROFILE SECTION -->
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="profile-grid">

      <!-- LEFT: Photo + contact -->
      <div class="reveal">
        <div class="photo-card">
          <img src="assets/yahya.jpg" alt="M. Yahya Iqbal"/>
          <div class="photo-badge">
            <div class="photo-badge-name">M. Yahya Iqbal</div>
            <div class="photo-badge-role">Travel Blogger &amp; Developer</div>
          </div>
        </div>

        <div class="contact-chips">
          <div class="contact-chip">
            <div class="contact-chip-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="contact-chip-label">Email</div>
              <div class="contact-chip-value"><a href="mailto:muhammadyahyaiqbal1@gmail.com">muhammadyahyaiqbal1@gmail.com</a></div>
            </div>
          </div>
          <div class="contact-chip">
            <div class="contact-chip-icon"><i class="fas fa-phone"></i></div>
            <div>
              <div class="contact-chip-label">Phone / WhatsApp</div>
              <div class="contact-chip-value"><a href="tel:+923223302319">+92 322 3302319</a></div>
            </div>
          </div>
          <div class="contact-chip">
            <div class="contact-chip-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <div class="contact-chip-label">Based In</div>
              <div class="contact-chip-value">Karachi, Pakistan</div>
            </div>
          </div>
          <div class="contact-chip">
            <div class="contact-chip-icon"><i class="fab fa-linkedin"></i></div>
            <div>
              <div class="contact-chip-label">LinkedIn</div>
              <div class="contact-chip-value"><a href="#">Yahya Iqbal</a></div>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT: Bio text -->
      <div class="reveal" style="transition-delay:0.12s;">
        <span class="section-eyebrow">The Author</span>
        <h2 class="section-title">Hi, I'm <em>Yahya Iqbal</em></h2>
        <div class="divider"></div>

        <p style="color:var(--text-mid);line-height:1.92;font-size:1rem;margin-bottom:1.5rem;">
          I'm <strong>M. Yahya Iqbal</strong> — a Software Engineering student from <strong>Karachi, Pakistan</strong> at Aligarh Institute of Technology. Travel has always fascinated me — the idea that somewhere beyond the horizon is a landscape, a culture, or a moment you haven't discovered yet.
        </p>
        <p style="color:var(--text-mid);line-height:1.92;font-size:1rem;margin-bottom:1.5rem;">
          This blog — <strong>Traveling Dreams &amp; Destinations</strong> — started as my 1st year final project. But it became something more: a place where I document the beauty of the world, from the colourful lakes of <strong>Naltar Valley</strong> and the stunning landscapes of <strong>Neelum Valley</strong> to the ancient pyramids of <strong>Egypt</strong> and the terraced rice fields of <strong>Bali</strong>.
        </p>
        <p style="color:var(--text-mid);line-height:1.92;font-size:1rem;margin-bottom:2rem;">
          Every destination tells a story. Every photograph holds a memory. My goal is simple — to inspire you to pack your bags and go explore the world, one adventure at a time.
        </p>

        <div class="quote-block reveal">
          <p>"Not all those who wander are lost — some are just looking for the perfect destination."</p>
          <span>Yahya Iqbal · Travel Blogger</span>
        </div>

        <!-- Travel highlights -->
        <div class="highlights reveal">
          <div class="highlight-item">
            <div class="highlight-num">20+</div>
            <div class="highlight-label">Destinations</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-num">50+</div>
            <div class="highlight-label">Blog Posts</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-num">∞</div>
            <div class="highlight-label">Adventures Ahead</div>
          </div>
        </div>

        <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:2.5rem;" class="reveal">
          <a href="blog.php" class="btn btn-dark">Read the Blog</a>
          <a href="contact.php" class="btn btn-outline">Get In Touch</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FEATURED JOURNEYS -->
<section class="section" style="background:var(--ivory2);padding-top:5rem;padding-bottom:5rem;">
  <div class="container">
    <div style="text-align:center;margin-bottom:3rem;" class="reveal">
      <span class="section-eyebrow">My Journeys</span>
      <h2 class="section-title">Places That <em>Inspired</em> This Blog</h2>
      <div class="divider divider-center"></div>
    </div>
    <div class="journey-grid">
      <div class="journey-card reveal">
        <img src="https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg" alt="Naltar Valley"/>
        <div class="journey-card-overlay"></div>
        <div class="journey-card-info">
          <div class="journey-card-region">Pakistan · Mountains</div>
          <div class="journey-card-place">Naltar Valley</div>
        </div>
      </div>
      <div class="journey-card reveal" style="transition-delay:0.1s">
        <img src="https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg" alt="Egypt"/>
        <div class="journey-card-overlay"></div>
        <div class="journey-card-info">
          <div class="journey-card-region">Africa · History</div>
          <div class="journey-card-place">Egypt</div>
        </div>
      </div>
      <div class="journey-card reveal" style="transition-delay:0.2s">
        <img src="https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg" alt="Bali"/>
        <div class="journey-card-overlay"></div>
        <div class="journey-card-info">
          <div class="journey-card-region">Asia · Culture</div>
          <div class="journey-card-place">Bali, Indonesia</div>
        </div>
      </div>
      <div class="journey-card reveal" style="transition-delay:0.3s">
        <img src="https://storage.googleapis.com/a1aa/image/IZk8bOUGmZ2lqfKMaRJFeTddfm8t6V8NL6dBZVA3810.jpg" alt="Santorini"/>
        <div class="journey-card-overlay"></div>
        <div class="journey-card-info">
          <div class="journey-card-region">Europe · Islands</div>
          <div class="journey-card-place">Santorini, Greece</div>
        </div>
      </div>
    </div>
    <div style="text-align:center;margin-top:3rem;" class="reveal">
      <a href="destinations.php" class="btn btn-dark">Explore All Destinations</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
