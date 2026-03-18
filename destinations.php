<?php
$active_page = 'destinations';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Destinations – Traveling Dreams & Destinations</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    /* Jump nav */
    .jump-nav { display:flex;gap:0.5rem;flex-wrap:wrap;justify-content:center; }
    .jump-link {
      padding:0.5rem 1.5rem;
      font-size:0.7rem; font-weight:600;
      letter-spacing:0.15em; text-transform:uppercase;
      border:1.5px solid var(--dark); color:var(--dark);
      text-decoration:none; transition:all 0.2s;
    }
    .jump-link:hover { background:var(--dark); color:#fff; }

    /* Region section */
    .region-section { padding:5rem 0; border-bottom:1px solid var(--cream2); }
    .region-section:last-child { border:none; }
    .region-header { display:flex;align-items:center;gap:1.5rem;margin-bottom:3rem; }
    .region-number { font-family:'Playfair Display',serif;font-size:5rem;font-weight:900;color:var(--cream2);line-height:1; }
    
    /* Destination cards */
    .dest-grid { display:grid;grid-template-columns:repeat(4,1fr);gap:1rem; }
    @media(max-width:900px){ .dest-grid{grid-template-columns:repeat(2,1fr);} }
    @media(max-width:480px){ .dest-grid{grid-template-columns:1fr;} }

    .dest-card {
      position:relative; overflow:hidden;
      border-radius:2px; cursor:pointer;
      aspect-ratio:3/4;
    }
    .dest-card img { width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease; }
    .dest-card:hover img { transform:scale(1.08); }
    .dest-card-overlay {
      position:absolute; inset:0;
      background:linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
      transition:background 0.3s;
    }
    .dest-card:hover .dest-card-overlay {
      background:linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 100%);
    }
    .dest-card-info {
      position:absolute; bottom:0; left:0; right:0; padding:1.25rem;
    }
    .dest-card-name {
      font-family:'Playfair Display',serif; font-size:1.25rem;
      font-weight:700; color:#fff; line-height:1.2;
    }
    .dest-card-tags {
      font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase;
      color:var(--gold-light); margin-top:0.3rem;
      display:none;
    }
    .dest-card:hover .dest-card-tags { display:block; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- PAGE HERO VIDEO -->
<div class="page-hero" style="height:75vh;">
  <video autoplay muted loop playsinline id="dest-video"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;"
    onerror="document.getElementById('dest-video').style.display='none'">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2020/05/23/40836-424698052_large.mp4" type="video/mp4">
    <source src="https://videos.pexels.com/video-files/3194277/3194277-uhd_2560_1440_30fps.mp4" type="video/mp4">
  </video>
  <!-- Fallback background image if video fails -->
  <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1600&q=80"
    alt="Destinations"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div class="page-hero-overlay" style="background:linear-gradient(to bottom,rgba(0,0,0,0.25) 0%,rgba(0,0,0,0.7) 100%);"></div>
  <div class="page-hero-content" style="padding:0 1.5rem;">
    <span style="font-size:0.68rem;letter-spacing:0.4em;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:1rem;animation:fadeInUp 0.8s ease 0.3s both;">Around The World</span>
    <h1 style="animation:fadeInUp 0.9s ease 0.5s both;">Destinations</h1>
    <p style="animation:fadeInUp 1s ease 0.7s both;">Every corner of the globe, waiting to be explored</p>
    <div class="breadcrumb" style="animation:fadeInUp 1s ease 0.9s both;"><a href="index.php">Home</a><span>/</span><span>Destinations</span></div>
  </div>
</div>

<!-- JUMP NAVIGATION -->
<section style="background:#fff; padding:2.5rem 0; border-bottom:1px solid var(--cream2); position:sticky;top:72px;z-index:100;">
  <div class="container">
    <div class="jump-nav">
      <a class="jump-link" href="#africa">Africa</a>
      <a class="jump-link" href="#americas">Americas</a>
      <a class="jump-link" href="#asia">Asia</a>
      <a class="jump-link" href="#caribbean">Caribbean</a>
      <a class="jump-link" href="#europe">Europe</a>
      <a class="jump-link" href="#middle-east">Middle East</a>
      <a class="jump-link" href="#oceania">Oceania</a>
    </div>
  </div>
</section>

<!-- AFRICA -->
<section class="region-section" id="africa" style="background:#fff;">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">01</span>
      <div>
        <span class="section-eyebrow">Continent</span>
        <h2 class="section-title" style="margin:0;">Africa</h2>
      </div>
    </div>
    <div class="dest-grid">
      <?php
      $africa = [
        ['img'=>'https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg','name'=>'Egypt','tags'=>'Pyramids • History • Desert'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/Gsbowqd53lqJDts5BOV1RBOOJFUwCCpyVnnACnfgiME.jpg','name'=>'Morocco','tags'=>'Culture • Medinas • Sahara'],
      ];
      foreach($africa as $i=>$d): ?>
      <div class="dest-card reveal" style="transition-delay:<?=$i*0.1?>s">
        <img src="<?=$d['img']?>" alt="<?=$d['name']?>"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name"><?=$d['name']?></div>
          <div class="dest-card-tags"><?=$d['tags']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- AMERICAS -->
<section class="region-section" id="americas" style="background:var(--cream);">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">02</span>
      <div>
        <span class="section-eyebrow">Continent</span>
        <h2 class="section-title" style="margin:0;">Americas</h2>
      </div>
    </div>
    <div class="dest-grid">
      <?php
      $americas = [
        ['img'=>'https://storage.googleapis.com/a1aa/image/k7tTey5EOe1HGnN-ff11Xeudt7HmTKlwvymicXdTP4U.jpg','name'=>'Argentina','tags'=>'Patagonia • Wine • Tango'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/2zeLTI-ceRt-ywmUzJP037tEq5ZVVH92Fd9sDEp2MAM.jpg','name'=>'Belize','tags'=>'Ruins • Jungle • Reef'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/EDP58K8DBgL526Ii2XYFqkTnB3IRug0FTDn6LhC8aCg.jpg','name'=>'Brazil','tags'=>'Amazon • Carnival • Beaches'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/kKBc4KX0OeGSmbv44LFiIjnxBulC9Ktw2RbpWQPu8z4.jpg','name'=>'Chile','tags'=>'Atacama • Patagonia • Wine'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/-7LSXzeDyZ2dkonLPClvgkvvxXGDqBZ9TfeD5mZe4vs.jpg','name'=>'Colombia','tags'=>'Coffee • Nature • Culture'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/q4ZJ91MGbcrq1_YeE4s81rbJcCtjr8WR5wS1apQlbDU.jpg','name'=>'El Salvador','tags'=>'Volcanoes • Beaches • Ruins'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/kFj0urw3lLQti-KGMD01J_WuPMjv5gvnfgZMA2vS6Pk.jpg','name'=>'Guatemala','tags'=>'Mayan Ruins • Lakes • Textiles'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/MtsrAOkuZDf8x_NBzyhKhTjp7qml80j_B31cT-_TmJY.jpg','name'=>'Honduras','tags'=>'Bay Islands • Ruins • Rainforest'],
      ];
      foreach($americas as $i=>$d): ?>
      <div class="dest-card reveal" style="transition-delay:<?=$i*0.07?>s">
        <img src="<?=$d['img']?>" alt="<?=$d['name']?>"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name"><?=$d['name']?></div>
          <div class="dest-card-tags"><?=$d['tags']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ASIA -->
<section class="region-section" id="asia" style="background:#fff;">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">03</span>
      <div>
        <span class="section-eyebrow">Continent</span>
        <h2 class="section-title" style="margin:0;">Asia</h2>
      </div>
    </div>
    <div class="dest-grid">
      <?php
      $asia = [
        ['img'=>'https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg','name'=>'Bali','tags'=>'Temples • Rice Fields • Beaches'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/hUb25mkiDK1BQ9Qkkvu_ft0N9wfGec8G2JfiQRRh80I.jpg','name'=>'Palawan','tags'=>'Lagoons • Reefs • Islands'],
        ['img'=>'https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg','name'=>'Pakistan','tags'=>'Mountains • Valleys • Culture'],
        ['img'=>'https://media.istockphoto.com/id/520839324/photo/wild-elephant.jpg?s=612x612&w=0&k=20&c=jnDbuC5oqdaH_OCVsBGa19A5sCx7EVKj94DdVA6Xe0g=','name'=>'Sri Lanka','tags'=>'Wildlife • Tea • History'],
      ];
      foreach($asia as $i=>$d): ?>
      <div class="dest-card reveal" style="transition-delay:<?=$i*0.08?>s">
        <img src="<?=$d['img']?>" alt="<?=$d['name']?>"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name"><?=$d['name']?></div>
          <div class="dest-card-tags"><?=$d['tags']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CARIBBEAN -->
<section class="region-section" id="caribbean" style="background:var(--cream);">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">04</span>
      <div>
        <span class="section-eyebrow">Islands</span>
        <h2 class="section-title" style="margin:0;">Caribbean</h2>
      </div>
    </div>
    <div class="dest-grid">
      <?php
      $carib = [
        ['img'=>'https://storage.googleapis.com/a1aa/image/R1gODMJEbKr5G3UcqHKHvW3pcWcWkQJJrK5Kn2Z_tAA.jpg','name'=>'Costa Rica','tags'=>'Rainforest • Wildlife • Surf'],
        ['img'=>'https://storage.googleapis.com/a1aa/image/DGoNkWzQ1DVJDHSafOkFcTb7yAMHvPvWrP93Xmpui7Y.jpg','name'=>'Cuba','tags'=>'Havana • Beaches • History'],
      ];
      foreach($carib as $i=>$d): ?>
      <div class="dest-card reveal" style="transition-delay:<?=$i*0.1?>s">
        <img src="<?=$d['img']?>" alt="<?=$d['name']?>" onerror="this.src='https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg'"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name"><?=$d['name']?></div>
          <div class="dest-card-tags"><?=$d['tags']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- EUROPE -->
<section class="region-section" id="europe" style="background:#fff;">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">05</span>
      <div>
        <span class="section-eyebrow">Continent</span>
        <h2 class="section-title" style="margin:0;">Europe</h2>
      </div>
    </div>
    <div class="dest-grid">
      <?php
      $europe = [
        ['img'=>'https://storage.googleapis.com/a1aa/image/IZk8bOUGmZ2lqfKMaRJFeTddfm8t6V8NL6dBZVA3810.jpg','name'=>'Santorini','tags'=>'Islands • Sunsets • Food'],
        ['img'=>'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=800&q=80','name'=>'Paris','tags'=>'Art • Culture • Cuisine'],
        ['img'=>'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800&q=80','name'=>'Barcelona','tags'=>'Architecture • Beach • Food'],
      ];
      foreach($europe as $i=>$d): ?>
      <div class="dest-card reveal" style="transition-delay:<?=$i*0.08?>s">
        <img src="<?=$d['img']?>" alt="<?=$d['name']?>"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name"><?=$d['name']?></div>
          <div class="dest-card-tags"><?=$d['tags']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- MIDDLE EAST -->
<section class="region-section" id="middle-east" style="background:var(--cream);">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">06</span>
      <div>
        <span class="section-eyebrow">Region</span>
        <h2 class="section-title" style="margin:0;">Middle East</h2>
      </div>
    </div>
    <div class="dest-grid">
      <div class="dest-card reveal">
        <img src="https://images.unsplash.com/photo-1512632578888-169bbbc64f33?w=800&q=80" alt="Jordan"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name">Jordan</div>
          <div class="dest-card-tags">Petra • Wadi Rum • Dead Sea</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- OCEANIA -->
<section class="region-section" id="oceania" style="background:#fff;">
  <div class="container">
    <div class="region-header reveal">
      <span class="region-number">07</span>
      <div>
        <span class="section-eyebrow">Region</span>
        <h2 class="section-title" style="margin:0;">Oceania</h2>
      </div>
    </div>
    <div class="dest-grid">
      <div class="dest-card reveal">
        <img src="https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?w=800&q=80" alt="Australia"/>
        <div class="dest-card-overlay"></div>
        <div class="dest-card-info">
          <div class="dest-card-name">Australia</div>
          <div class="dest-card-tags">Outback • Reef • Cities</div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
