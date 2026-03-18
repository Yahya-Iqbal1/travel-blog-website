<?php
$active_page = 'blog';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blog – Traveling Dreams & Destinations</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    .blog-hero-video { position:relative; height:70vh; min-height:460px; overflow:hidden; }
    .blog-hero-video video { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
    .blog-hero-video .overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(0,0,0,0.25),rgba(0,0,0,0.65)); }
    .blog-hero-video .content { position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff; text-align:center; }

    /* Filter tabs */
    .filter-tabs { display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap; justify-content:center; }
    .filter-tab {
      padding:0.5rem 1.25rem;
      font-size:0.72rem; font-weight:600;
      letter-spacing:0.12em; text-transform:uppercase;
      border:1.5px solid #d0cbc0;
      background:transparent; color:var(--text-light);
      cursor:pointer; transition:all 0.2s;
    }
    .filter-tab:hover, .filter-tab.active {
      background:var(--dark); color:#fff; border-color:var(--dark);
    }

    /* Featured post */
    .featured-post {
      display:grid; grid-template-columns:1.4fr 1fr;
      background:#fff; overflow:hidden;
      box-shadow:0 4px 32px rgba(0,0,0,0.08);
    }
    .featured-post img { width:100%; height:100%; object-fit:cover; display:block; }
    .featured-post-body { padding:3rem; display:flex; flex-direction:column; justify-content:center; }
    @media(max-width:768px){ .featured-post{grid-template-columns:1fr;} }

    /* Post grid */
    .posts-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; }
    @media(max-width:900px){ .posts-grid{grid-template-columns:repeat(2,1fr);} }
    @media(max-width:540px){ .posts-grid{grid-template-columns:1fr;} }

    .post-date { font-size:0.72rem; color:var(--text-light); margin-bottom:0.4rem; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<div class="blog-hero-video">
  <video autoplay muted loop playsinline>
    <source src="https://cdn.pixabay.com/video/2023/08/14/175630-856514692_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
    <source src="https://videos.pexels.com/video-files/4133023/4133023-uhd_2560_1440_30fps.mp4" type="video/mp4">
  </video>
  <img src="https://images.unsplash.com/photo-1500835556837-99ac94a94552?w=1600&q=80"
    alt="Blog hero"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div class="overlay"></div>
  <div class="content">
    <span style="font-size:0.72rem;letter-spacing:0.35em;text-transform:uppercase;color:var(--gold);margin-bottom:1rem;">Stories & Guides</span>
    <h1 style="font-family:'Playfair Display',serif;font-size:clamp(3rem,7vw,5.5rem);font-weight:900;">The Blog</h1>
    <p style="margin-top:1rem;font-size:1.05rem;color:rgba(255,255,255,0.75);max-width:480px;">Real travel stories, honest tips, and breathtaking photography from the road.</p>
  </div>
</div>

<!-- FILTER TABS -->
<section style="background:#fff; padding:2rem 0; border-bottom:1px solid #ede8df;">
  <div class="container">
    <div class="filter-tabs">
      <button class="filter-tab active">All</button>
      <button class="filter-tab">Pakistan</button>
      <button class="filter-tab">Asia</button>
      <button class="filter-tab">Europe</button>
      <button class="filter-tab">Americas</button>
      <button class="filter-tab">Africa</button>
      <button class="filter-tab">Adventure</button>
    </div>
  </div>
</section>

<!-- FEATURED POST -->
<section class="section" style="background:var(--cream); padding-top:4rem;">
  <div class="container">
    <div class="reveal" style="margin-bottom:2rem;">
      <span class="section-eyebrow">Editor's Pick</span>
    </div>
    <div class="featured-post reveal">
      <img src="https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg" alt="Naltar Valley"/>
      <div class="featured-post-body">
        <span class="card-tag">Pakistan • Mountains • Lakes</span>
        <h2 style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;line-height:1.2;margin:0.75rem 0 1rem;">Naltar Valley: Pakistan's Hidden Gem</h2>
        <p style="color:var(--text-light);line-height:1.8;margin-bottom:2rem;">Naltar is famous for its colourful lakes, situated at a 2.5-hour drive from Gilgit. World's tastiest potatoes are cultivated here. Covered with pine trees, this valley doesn't seem to be part of this world.</p>
        <div class="post-date"><i class="far fa-calendar-alt" style="margin-right:0.4rem;"></i> December 15, 2024</div>
        <a href="#" class="btn btn-dark" style="align-self:flex-start;">Read Full Story</a>
      </div>
    </div>
  </div>
</section>

<!-- BLOG POSTS GRID -->
<section class="section" style="background:var(--cream);">
  <div class="container">
    <div class="reveal" style="margin-bottom:3rem;">
      <span class="section-eyebrow">Recent Posts</span>
      <h2 class="section-title">Latest <em>Adventures</em></h2>
      <div class="divider"></div>
    </div>

    <div class="posts-grid">

      <?php
      $posts = [
        ['img'=>'https://i.dawn.com/large/2015/12/567d1acecd90d.jpg','tag'=>'Pakistan • Valley','title'=>'Neelum Valley: Crown Jewel of Azad Kashmir','text'=>'Neelum is one of the most beautiful valleys of Azad Kashmir, hosting brooks, freshwater streams, forests, lush mountains, and a roaring river.','date'=>'Nov 28, 2024'],
        ['img'=>'https://i.dawn.com/large/2015/12/567d1d027a917.jpg','tag'=>'Colombia • Trekking','title'=>'The Lost City Trek: La Ciudad Perdida','text'=>'An epic multi-day jungle hike to pre-Columbian ruins hidden deep in the Sierra Nevada mountains of Colombia.','date'=>'Oct 12, 2024'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg','tag'=>'Africa • History','title'=>'Camel Rides and Pyramids: A Week in Egypt','text'=>'The ancient wonders of Giza, the chaos of Cairo markets, and the stillness of the desert at dawn — Egypt never stops surprising.','date'=>'Sep 5, 2024'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg','tag'=>'Asia • Culture','title'=>'Bali: Rice Fields, Temples and Sunsets','text'=>'The terraced rice fields of Ubud, sacred water temples, and watching the sun melt into the Indian Ocean from Uluwatu.','date'=>'Aug 20, 2024'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/IZk8bOUGmZ2lqfKMaRJFeTddfm8t6V8NL6dBZVA3810.jpg','tag'=>'Europe • Islands','title'=>'Santorini: Everything They Say is True','text'=>'White-washed buildings, blue-domed churches, volcanic beaches, and the most spectacular sunset in the Mediterranean.','date'=>'Jul 3, 2024'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/hUb25mkiDK1BQ9Qkkvu_ft0N9wfGec8G2JfiQRRh80I.jpg','tag'=>'Asia • Beach','title'=>'Palawan: The Last Frontier of the Philippines','text'=>'Crystal-clear lagoons, dramatic limestone cliffs, and pristine beaches make Palawan consistently ranked among the world\'s best islands.','date'=>'Jun 14, 2024'],
      ];
      foreach($posts as $i=>$p):
      ?>
      <div class="card reveal" style="transition-delay:<?= ($i%3)*0.1 ?>s">
        <div class="card-img-wrap">
          <img class="card-img" src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['title']) ?>"/>
        </div>
        <div class="card-body">
          <span class="card-tag"><?= $p['tag'] ?></span>
          <h3 class="card-title"><?= $p['title'] ?></h3>
          <p class="card-text"><?= $p['text'] ?></p>
          <div class="post-date" style="margin-bottom:1rem;"><i class="far fa-calendar-alt" style="margin-right:0.4rem;"></i><?= $p['date'] ?></div>
          <a href="#" class="card-link">Read More</a>
        </div>
      </div>
      <?php endforeach; ?>

    </div>

    <div style="text-align:center;margin-top:3.5rem;" class="reveal">
      <a href="#" class="btn btn-outline">Load More Posts</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
  // Filter tab interaction
  document.querySelectorAll('.filter-tab').forEach(function(btn){
    btn.addEventListener('click', function(){
      document.querySelectorAll('.filter-tab').forEach(function(b){ b.classList.remove('active'); });
      this.classList.add('active');
    });
  });
</script>
</body>
</html>
