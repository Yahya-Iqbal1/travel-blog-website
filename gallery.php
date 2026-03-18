<?php
$active_page = 'gallery';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gallery – Traveling Dreams & Destinations</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    /* Masonry gallery */
    .masonry {
      columns: 4;
      column-gap: 8px;
      padding: 0;
    }
    @media(max-width:1100px){ .masonry{ columns:3; } }
    @media(max-width:700px){ .masonry{ columns:2; } }
    @media(max-width:420px){ .masonry{ columns:1; } }

    .masonry-item {
      break-inside: avoid;
      margin-bottom: 8px;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }

    .masonry-item img {
      width: 100%; display: block;
      transition: transform 0.5s ease;
    }
    .masonry-item:hover img { transform: scale(1.06); }

    .masonry-overlay {
      position: absolute; inset: 0;
      background: rgba(0,0,0,0);
      display: flex; align-items: center; justify-content: center;
      transition: background 0.3s;
    }
    .masonry-item:hover .masonry-overlay {
      background: rgba(0,0,0,0.35);
    }
    .masonry-overlay i {
      color: #fff; font-size: 1.75rem;
      opacity: 0; transform: scale(0.8);
      transition: all 0.3s;
    }
    .masonry-item:hover .masonry-overlay i {
      opacity: 1; transform: scale(1);
    }

    /* Lightbox */
    #lightbox {
      display: none;
      position: fixed; inset: 0; z-index: 9999;
      background: rgba(0,0,0,0.93);
      align-items: center; justify-content: center;
    }
    #lightbox.open { display: flex; }
    #lightbox img {
      max-width: 90vw; max-height: 88vh;
      object-fit: contain; display: block;
      box-shadow: 0 0 80px rgba(0,0,0,0.8);
    }
    #lb-close {
      position: absolute; top: 1.5rem; right: 1.75rem;
      color: #fff; font-size: 2rem; cursor: pointer;
      background: none; border: none; line-height: 1;
      transition: color 0.2s;
    }
    #lb-close:hover { color: var(--gold); }
    #lb-prev, #lb-next {
      position: absolute; top: 50%; transform: translateY(-50%);
      background: rgba(255,255,255,0.1);
      border: none; color: #fff; font-size: 1.5rem;
      width: 50px; height: 50px; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.2s;
    }
    #lb-prev:hover, #lb-next:hover { background: rgba(201,168,76,0.4); }
    #lb-prev { left: 1rem; }
    #lb-next { right: 1rem; }
    #lb-caption {
      position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
      color: rgba(255,255,255,0.6); font-size: 0.8rem;
      letter-spacing: 0.15em; text-transform: uppercase;
    }

    /* Filter */
    .gal-filters { display:flex; gap:0.5rem; flex-wrap:wrap; justify-content:center; }
    .gal-filter {
      padding:0.4rem 1.1rem; font-size:0.7rem; font-weight:600;
      letter-spacing:0.12em; text-transform:uppercase;
      border:1.5px solid #d0cbc0; background:transparent;
      color:var(--text-light); cursor:pointer; transition:all 0.2s;
    }
    .gal-filter:hover, .gal-filter.active { background:var(--dark); color:#fff; border-color:var(--dark); }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- PAGE HERO VIDEO -->
<div style="position:relative;height:60vh;min-height:380px;overflow:hidden;">
  <video autoplay muted loop playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
    <source src="https://cdn.pixabay.com/video/2022/10/08/134302-760122650_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2023/04/30/161071-822582138_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
  </video>
  <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1600&q=80"
    alt="Gallery hero"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,0.2),rgba(0,0,0,0.7));"></div>
  <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;color:#fff;text-align:center;padding:1.5rem;">
    <span style="font-size:0.7rem;letter-spacing:0.35em;text-transform:uppercase;color:var(--gold);margin-bottom:1rem;">Visual Journey</span>
    <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2.8rem,7vw,5rem);font-weight:900;">Gallery</h1>
    <p style="margin-top:1rem;font-size:1rem;color:rgba(255,255,255,0.75);">Moments captured from around the world</p>
    <div class="breadcrumb" style="margin-top:1rem;"><a href="index.php">Home</a><span>/</span><span>Gallery</span></div>
  </div>
</div>

<!-- FILTERS -->
<section style="background:#fff;padding:2rem 0;border-bottom:1px solid var(--cream2);">
  <div class="container">
    <div class="gal-filters">
      <button class="gal-filter active" data-filter="all">All</button>
      <button class="gal-filter" data-filter="pakistan">Pakistan</button>
      <button class="gal-filter" data-filter="nature">Nature</button>
      <button class="gal-filter" data-filter="culture">Culture</button>
      <button class="gal-filter" data-filter="wildlife">Wildlife</button>
    </div>
  </div>
</section>

<!-- MASONRY GALLERY -->
<section class="section" style="background:var(--dark);padding:3rem 0;">
  <div class="container">
    <?php
    $photos = [
      ['src'=>'https://i.dawn.com/large/2015/12/567d1ca45aabe.jpg','alt'=>'Historical pyramid structure','cat'=>'culture'],
      ['src'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTO2usJx4qAX5znlTTfvE1e2xNfwKYBIY7lK4g13LyMk5v4Sy3in1FzDnzPcuOFUYVSf-M&usqp=CAU','alt'=>'Mountain temple','cat'=>'culture'],
      ['src'=>'https://media.istockphoto.com/id/610041376/photo/beautiful-sunrise-over-the-sea.jpg?s=612x612&w=0&k=20&c=R3Tcc6HKc1ixPrBc7qXvXFCicm8jLMMlT99MfmchLNA=','alt'=>'Sunrise over sea','cat'=>'nature'],
      ['src'=>'https://media.istockphoto.com/id/520839324/photo/wild-elephant.jpg?s=612x612&w=0&k=20&c=jnDbuC5oqdaH_OCVsBGa19A5sCx7EVKj94DdVA6Xe0g=','alt'=>'Wild elephant','cat'=>'wildlife'],
      ['src'=>'https://www.travelertrails.com/wp-content/uploads/2022/12/Hunza-River-4.jpg','alt'=>'Hunza River Pakistan','cat'=>'pakistan'],
      ['src'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Eye_Of_Lahore_%28Minar_e_Pakistan%29_evening.jpg/1024px-Eye_Of_Lahore_%28Minar_e_Pakistan%29_evening.jpg','alt'=>'Minar-e-Pakistan Lahore','cat'=>'pakistan'],
      ['src'=>'https://cdn.offtheatlas.com/wp-content/uploads/2021/09/23070948/FXH12722.jpg.webp','alt'=>'Mountain lake','cat'=>'pakistan'],
      ['src'=>'https://blog-cdn.lamudi.pk/blog/wp-content/uploads/2023/01/27065041/aryan-ghauri-5F98r2fRgJE-unsplash-1024x680.jpg','alt'=>'Pakistan landscape','cat'=>'pakistan'],
      ['src'=>'https://i.dawn.com/large/2015/12/567d1f58c1efe.jpg','alt'=>'Traditional gate','cat'=>'culture'],
      ['src'=>'https://i.dawn.com/large/2015/12/567d1f225e8e0.jpg','alt'=>'Tropical landscape','cat'=>'nature'],
      ['src'=>'https://i.dawn.com/large/2015/12/567e9d2ddc124.jpg','alt'=>'Mountain range','cat'=>'nature'],
      ['src'=>'https://i.dawn.com/large/2015/12/567d1f92177ca.jpg','alt'=>'Volcano','cat'=>'nature'],
      ['src'=>'https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg','alt'=>'Naltar Valley','cat'=>'pakistan'],
      ['src'=>'https://i.dawn.com/large/2015/12/567d1acecd90d.jpg','alt'=>'Neelum Valley','cat'=>'pakistan'],
      ['src'=>'https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg','alt'=>'Egypt pyramids','cat'=>'culture'],
      ['src'=>'https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg','alt'=>'Bali rice fields','cat'=>'nature'],
    ];
    ?>
    <div class="masonry" id="gallery-grid">
      <?php foreach($photos as $i=>$p): ?>
      <div class="masonry-item reveal" data-cat="<?=$p['cat']?>" data-index="<?=$i?>">
        <img src="<?=$p['src']?>" alt="<?=htmlspecialchars($p['alt'])?>" loading="lazy"/>
        <div class="masonry-overlay"><i class="fas fa-expand-alt"></i></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox">
  <button id="lb-close"><i class="fas fa-times"></i></button>
  <button id="lb-prev"><i class="fas fa-chevron-left"></i></button>
  <img id="lb-img" src="" alt=""/>
  <button id="lb-next"><i class="fas fa-chevron-right"></i></button>
  <div id="lb-caption"></div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
var photos = <?= json_encode($photos) ?>;
var current = 0;

// Open lightbox
document.querySelectorAll('.masonry-item').forEach(function(item){
  item.addEventListener('click', function(){
    current = parseInt(this.dataset.index);
    openLB(current);
  });
});

function openLB(i){
  document.getElementById('lb-img').src = photos[i].src;
  document.getElementById('lb-img').alt = photos[i].alt;
  document.getElementById('lb-caption').textContent = photos[i].alt;
  document.getElementById('lightbox').classList.add('open');
  document.body.style.overflow = 'hidden';
}

document.getElementById('lb-close').addEventListener('click', function(){
  document.getElementById('lightbox').classList.remove('open');
  document.body.style.overflow = '';
});

document.getElementById('lb-prev').addEventListener('click', function(){
  current = (current - 1 + photos.length) % photos.length;
  openLB(current);
});

document.getElementById('lb-next').addEventListener('click', function(){
  current = (current + 1) % photos.length;
  openLB(current);
});

document.getElementById('lightbox').addEventListener('click', function(e){
  if(e.target === this){ this.classList.remove('open'); document.body.style.overflow=''; }
});

document.addEventListener('keydown', function(e){
  var lb = document.getElementById('lightbox');
  if(!lb.classList.contains('open')) return;
  if(e.key==='ArrowRight') document.getElementById('lb-next').click();
  if(e.key==='ArrowLeft') document.getElementById('lb-prev').click();
  if(e.key==='Escape') document.getElementById('lb-close').click();
});

// Filter
document.querySelectorAll('.gal-filter').forEach(function(btn){
  btn.addEventListener('click', function(){
    document.querySelectorAll('.gal-filter').forEach(function(b){ b.classList.remove('active'); });
    this.classList.add('active');
    var filter = this.dataset.filter;
    document.querySelectorAll('.masonry-item').forEach(function(item){
      item.style.display = (filter==='all' || item.dataset.cat===filter) ? 'block' : 'none';
    });
  });
});
</script>
</body>
</html>
