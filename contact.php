<?php
$active_page = 'contact';
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = @new mysqli($host,$user,$pass,$db);

$success = $error = '';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['name'],$_POST['email'],$_POST['subject'],$_POST['message'])) {
  $name    = trim($_POST['name']);
  $email   = trim($_POST['email']);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);
  if ($name && filter_var($email,FILTER_VALIDATE_EMAIL) && $subject && $message) {
    if ($conn && !$conn->connect_error) {
      $stmt = $conn->prepare("INSERT INTO contact_messages (name,email,subject,message,created_at) VALUES (?,?,?,?,NOW())");
      if ($stmt) {
        $stmt->bind_param('ssss',$name,$email,$subject,$message);
        $success = $stmt->execute() ? "Thank you, {$name}! Your message has been sent." : "Send failed. Please try again.";
        $stmt->close();
      } else { $error = "Database error. Please try again later."; }
    } else { $error = "Database unavailable. Please try again later."; }
  } else { $error = "Please fill all fields with valid information."; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact – Traveling Dreams & Destinations</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    .contact-grid {
      display:grid; grid-template-columns:1fr 1.6fr; gap:5rem; align-items:start;
    }
    @media(max-width:900px){ .contact-grid{grid-template-columns:1fr;gap:3rem;} }

    .info-item { display:flex; gap:1.5rem; align-items:flex-start; margin-bottom:2.5rem; }
    .info-icon {
      width:48px; height:48px; min-width:48px;
      background:var(--cream2); display:flex; align-items:center; justify-content:center;
      color:var(--gold); font-size:1rem;
    }
    .info-item h4 { font-size:0.72rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--text-light); margin-bottom:0.3rem; }
    .info-item p { font-size:1rem; color:var(--text); }

    .alert-success {
      padding:1rem 1.25rem; background:#d4edda; border:1px solid #c3e6cb;
      color:#155724; font-size:0.92rem; margin-bottom:1.5rem;
    }
    .alert-error {
      padding:1rem 1.25rem; background:#f8d7da; border:1px solid #f5c6cb;
      color:#721c24; font-size:0.92rem; margin-bottom:1.5rem;
    }

    /* Instagram grid */
    .insta-grid {
      display:grid; grid-template-columns:repeat(6,1fr); gap:4px;
    }
    @media(max-width:768px){ .insta-grid{grid-template-columns:repeat(3,1fr);} }
    .insta-item { position:relative; overflow:hidden; aspect-ratio:1; }
    .insta-item img { width:100%;height:100%;object-fit:cover;transition:transform 0.4s; }
    .insta-item:hover img { transform:scale(1.1); }
    .insta-overlay {
      position:absolute;inset:0;background:rgba(201,168,76,0.3);
      display:flex;align-items:center;justify-content:center;
      opacity:0;transition:opacity 0.3s;
    }
    .insta-item:hover .insta-overlay { opacity:1; }
    .insta-overlay i { color:#fff; font-size:1.5rem; }
  </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- PAGE HERO VIDEO -->
<div class="page-hero" style="height:65vh;">
  <video autoplay muted loop playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;">
    <source src="https://cdn.pixabay.com/video/2022/08/05/128062-736990968_large.mp4" type="video/mp4">
    <source src="https://cdn.pixabay.com/video/2020/05/23/40836-424698052_large.mp4" type="video/mp4">
    <source src="https://videos.pexels.com/video-files/2169913/2169913-uhd_2560_1440_30fps.mp4" type="video/mp4">
  </video>
  <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1600&q=80"
    alt="Contact hero"
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:-1;"/>
  <div class="page-hero-overlay" style="background:linear-gradient(to bottom,rgba(0,0,0,0.2),rgba(0,0,0,0.72));"></div>
  <div class="page-hero-content" style="padding:0 1.5rem;">
    <h1>Get In Touch</h1>
    <p>Travel questions, collaborations, or just saying hi</p>
    <div class="breadcrumb"><a href="index.php">Home</a><span>/</span><span>Contact</span></div>
  </div>
</div>

<!-- CONTACT MAIN -->
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="contact-grid">
      <!-- INFO -->
      <div class="reveal">
        <span class="section-eyebrow">Reach Out</span>
        <h2 class="section-title">Let's <em>Talk Travel</em></h2>
        <div class="divider"></div>
        <p style="color:var(--text-light);line-height:1.8;margin-bottom:3rem;">
          Have a travel question, want to collaborate, or simply want to share your own travel story? I'd love to hear from you. I try to respond to every message.
        </p>

        <div class="info-item">
          <div class="info-icon"><i class="far fa-envelope"></i></div>
          <div>
            <h4>Email</h4>
            <p>muhammadyahyaiqbal1@gmail.com</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon"><i class="fas fa-phone"></i></div>
          <div>
            <h4>Phone / WhatsApp</h4>
            <p>+92 322 3302319</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div>
            <h4>Based In</h4>
            <p>Karachi, Pakistan</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon"><i class="far fa-clock"></i></div>
          <div>
            <h4>Response Time</h4>
            <p>Usually within 24–48 hours</p>
          </div>
        </div>

        <div style="margin-top:2.5rem;">
          <p style="font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-bottom:1rem;">Follow Along</p>
          <div style="display:flex;gap:0.75rem;">
            <a href="#" style="width:40px;height:40px;border:1.5px solid #ddd;display:flex;align-items:center;justify-content:center;color:var(--text-light);text-decoration:none;font-size:0.9rem;transition:all 0.2s;"
              onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
              onmouseout="this.style.borderColor='#ddd';this.style.color='var(--text-light)'">
              <i class="fab fa-instagram"></i></a>
            <a href="#" style="width:40px;height:40px;border:1.5px solid #ddd;display:flex;align-items:center;justify-content:center;color:var(--text-light);text-decoration:none;font-size:0.9rem;transition:all 0.2s;"
              onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
              onmouseout="this.style.borderColor='#ddd';this.style.color='var(--text-light)'">
              <i class="fab fa-youtube"></i></a>
            <a href="#" style="width:40px;height:40px;border:1.5px solid #ddd;display:flex;align-items:center;justify-content:center;color:var(--text-light);text-decoration:none;font-size:0.9rem;transition:all 0.2s;"
              onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
              onmouseout="this.style.borderColor='#ddd';this.style.color='var(--text-light)'">
              <i class="fab fa-pinterest-p"></i></a>
            <a href="#" style="width:40px;height:40px;border:1.5px solid #ddd;display:flex;align-items:center;justify-content:center;color:var(--text-light);text-decoration:none;font-size:0.9rem;transition:all 0.2s;"
              onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
              onmouseout="this.style.borderColor='#ddd';this.style.color='var(--text-light)'">
              <i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>

      <!-- FORM -->
      <div class="reveal" style="transition-delay:0.15s">
        <?php if($success): ?>
          <div class="alert-success"><i class="fas fa-check-circle" style="margin-right:0.5rem;"></i><?= htmlspecialchars($success) ?></div>
        <?php elseif($error): ?>
          <div class="alert-error"><i class="fas fa-exclamation-circle" style="margin-right:0.5rem;"></i><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
            <div class="form-group">
              <label class="form-label">Your Name *</label>
              <input class="form-input" type="text" name="name" placeholder="John Doe" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label class="form-label">Email Address *</label>
              <input class="form-input" type="email" name="email" placeholder="john@email.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Subject *</label>
            <input class="form-input" type="text" name="subject" placeholder="Travel question, collab inquiry, etc." required value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label class="form-label">Message *</label>
            <textarea class="form-textarea" name="message" placeholder="Tell me what's on your mind..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-dark" style="width:100%;justify-content:center;">
            Send Message <i class="fas fa-paper-plane" style="font-size:0.8rem;"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- INSTAGRAM STRIP -->
<section style="background:var(--dark);padding:3rem 0 0;">
  <div style="text-align:center;padding-bottom:1.5rem;">
    <span style="font-size:0.7rem;letter-spacing:0.3em;text-transform:uppercase;color:var(--gold);">
      <i class="fab fa-instagram" style="margin-right:0.5rem;"></i>Follow on Instagram @travelingdreams
    </span>
  </div>
  <div class="insta-grid">
    <div class="insta-item"><img src="https://media.istockphoto.com/id/610041376/photo/beautiful-sunrise-over-the-sea.jpg?s=612x612&w=0&k=20&c=R3Tcc6HKc1ixPrBc7qXvXFCicm8jLMMlT99MfmchLNA=" alt="Sunrise"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
    <div class="insta-item"><img src="https://media.istockphoto.com/id/520839324/photo/wild-elephant.jpg?s=612x612&w=0&k=20&c=jnDbuC5oqdaH_OCVsBGa19A5sCx7EVKj94DdVA6Xe0g=" alt="Elephant"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
    <div class="insta-item"><img src="https://i.dawn.com/large/2015/12/567d1a1cc9595.jpg" alt="Valley"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
    <div class="insta-item"><img src="https://storage.googleapis.com/a1aa/image/wkMFkTXj71WsuSAnTUwv0Cdlv-aXr8u3J1gwqSc901s.jpg" alt="Bali"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
    <div class="insta-item"><img src="https://storage.googleapis.com/a1aa/image/EmjPsrEipRwvUzB1Ji-CXVUK8HGI1CkPWnWtx4w4a_I.jpg" alt="Egypt"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
    <div class="insta-item"><img src="https://i.dawn.com/large/2015/12/567d1f92177ca.jpg" alt="Volcano"/><div class="insta-overlay"><i class="fab fa-instagram"></i></div></div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
