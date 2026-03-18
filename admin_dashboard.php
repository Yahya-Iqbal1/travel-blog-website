<?php
session_start();

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'yahya');

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_dashboard.php");
    exit;
}

$login_error = '';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['username'],$_POST['password'])) {
    if ($_POST['username']===ADMIN_USER && $_POST['password']===ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $login_error = "Invalid username or password.";
    }
}

if (empty($_SESSION['admin_logged_in'])):
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Admin Login – Travel Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'DM Sans',sans-serif;background:#0d0d0d;min-height:100vh;display:flex;align-items:center;justify-content:center;}
    .login-box{background:#1a1a1a;padding:3rem 2.5rem;width:100%;max-width:400px;border:1px solid rgba(201,168,76,0.2);}
    .login-logo{text-align:center;margin-bottom:2.5rem;}
    .login-logo h1{font-family:'Playfair Display',serif;color:#c9a84c;font-size:1.5rem;}
    .login-logo p{color:rgba(255,255,255,0.4);font-size:0.8rem;letter-spacing:0.1em;margin-top:0.3rem;text-transform:uppercase;}
    .form-label{display:block;font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:0.5rem;}
    .form-input{width:100%;padding:0.875rem 1rem;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.1);color:#fff;font-family:'DM Sans',sans-serif;font-size:0.95rem;outline:none;transition:border-color 0.2s;margin-bottom:1.25rem;}
    .form-input:focus{border-color:#c9a84c;}
    .btn-login{width:100%;padding:1rem;background:#c9a84c;color:#0d0d0d;border:none;font-family:'DM Sans',sans-serif;font-size:0.8rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;cursor:pointer;transition:background 0.2s;}
    .btn-login:hover{background:#e8c97a;}
    .error{background:rgba(220,53,69,0.15);border:1px solid rgba(220,53,69,0.3);color:#e08080;padding:0.75rem 1rem;font-size:0.88rem;margin-bottom:1.5rem;}
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <h1>Admin Panel</h1>
      <p>Traveling Dreams & Destinations</p>
    </div>
    <?php if($login_error): ?>
      <div class="error"><i class="fas fa-exclamation-circle" style="margin-right:0.4rem;"></i><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>
    <form method="post">
      <label class="form-label">Username</label>
      <input class="form-input" type="text" name="username" autocomplete="username" required/>
      <label class="form-label">Password</label>
      <input class="form-input" type="password" name="password" autocomplete="current-password" required/>
      <button class="btn-login" type="submit">Login <i class="fas fa-arrow-right" style="margin-left:0.4rem;"></i></button>
    </form>
  </div>
</body>
</html>
<?php exit; endif; ?>

<?php
$host='localhost'; $user='root'; $pass=''; $db='travel_blog';
$conn = new mysqli($host,$user,$pass,$db);
if ($conn->connect_error) die('Database connection failed: '.$conn->connect_error);

$subscribers=[];
$res = $conn->query("SELECT id,email,subscribed_at FROM newsletter_subscribers ORDER BY subscribed_at DESC");
if($res) while($r=$res->fetch_assoc()) $subscribers[]=$r;

$messages=[];
$res = $conn->query("SELECT id,name,email,subject,message,created_at FROM contact_messages ORDER BY created_at DESC");
if($res) while($r=$res->fetch_assoc()) $messages[]=$r;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Admin Dashboard – Travel Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    :root{--gold:#c9a84c;--dark:#0d0d0d;--dark2:#1a1a1a;--dark3:#242424;}
    body{font-family:'DM Sans',sans-serif;background:#f5f0e8;color:#2c2c2c;min-height:100vh;}

    /* Sidebar */
    .sidebar{position:fixed;left:0;top:0;bottom:0;width:260px;background:var(--dark);padding:2rem 0;z-index:100;}
    .sidebar-brand{padding:0 1.75rem 2rem;border-bottom:1px solid rgba(255,255,255,0.08);}
    .sidebar-brand h1{font-family:'Playfair Display',serif;color:var(--gold);font-size:1.1rem;line-height:1.3;}
    .sidebar-brand p{color:rgba(255,255,255,0.35);font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;margin-top:0.3rem;}
    .sidebar-nav{padding:1.5rem 0;}
    .sidebar-nav a{display:flex;align-items:center;gap:0.75rem;padding:0.75rem 1.75rem;color:rgba(255,255,255,0.55);text-decoration:none;font-size:0.88rem;font-weight:500;transition:all 0.2s;}
    .sidebar-nav a:hover,.sidebar-nav a.active{color:#fff;background:rgba(201,168,76,0.1);}
    .sidebar-nav a i{width:18px;text-align:center;color:var(--gold);}
    .sidebar-footer{position:absolute;bottom:0;left:0;right:0;padding:1.25rem 1.75rem;border-top:1px solid rgba(255,255,255,0.08);}
    .sidebar-footer a{color:rgba(255,255,255,0.4);text-decoration:none;font-size:0.82rem;display:flex;align-items:center;gap:0.5rem;transition:color 0.2s;}
    .sidebar-footer a:hover{color:#e08080;}

    /* Main */
    .main{margin-left:260px;padding:2.5rem 2.5rem;}

    /* Top bar */
    .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem;}
    .topbar h2{font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;}
    .topbar-meta{font-size:0.8rem;color:#888;margin-top:0.2rem;}

    /* Stat cards */
    .stat-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;margin-bottom:2.5rem;}
    .stat-card{background:#fff;padding:1.5rem;border-top:3px solid var(--gold);}
    .stat-card-num{font-family:'Playfair Display',serif;font-size:2.25rem;font-weight:900;color:var(--dark);}
    .stat-card-label{font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:#888;margin-top:0.3rem;}
    .stat-card-icon{float:right;width:40px;height:40px;background:#f5f0e8;display:flex;align-items:center;justify-content:center;color:var(--gold);}

    /* Section card */
    .data-card{background:#fff;margin-bottom:2rem;box-shadow:0 2px 12px rgba(0,0,0,0.06);}
    .data-card-header{padding:1.25rem 1.75rem;border-bottom:1px solid #f0ebe0;display:flex;align-items:center;justify-content:space-between;}
    .data-card-header h3{font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;}
    .badge{padding:0.25rem 0.75rem;font-size:0.7rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;background:#f5f0e8;color:var(--gold);}

    /* Table */
    table{width:100%;border-collapse:collapse;font-size:0.88rem;}
    th{padding:0.75rem 1.75rem;text-align:left;font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:#888;border-bottom:1px solid #f0ebe0;font-weight:600;}
    td{padding:1rem 1.75rem;border-bottom:1px solid #f9f6f0;vertical-align:top;}
    tr:last-child td{border:none;}
    tr:hover td{background:#faf8f4;}
    .td-email{color:#555;font-size:0.85rem;}
    .td-date{color:#aaa;font-size:0.8rem;}
    .td-msg{color:#555;font-size:0.85rem;max-width:300px;}

    .empty-state{padding:3rem;text-align:center;color:#bbb;font-size:0.9rem;}
    .empty-state i{font-size:2rem;display:block;margin-bottom:0.75rem;color:#ddd;}

    @media(max-width:1024px){
      .stat-cards{grid-template-columns:repeat(2,1fr);}
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="sidebar-brand">
    <h1>Traveling Dreams<br>&amp; Destinations</h1>
    <p>Admin Panel</p>
  </div>
  <nav class="sidebar-nav">
    <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#subscribers"><i class="fas fa-envelope"></i> Subscribers</a>
    <a href="#messages"><i class="fas fa-comment-alt"></i> Messages</a>
    <a href="index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
  </nav>
  <div class="sidebar-footer">
    <a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="topbar">
    <div>
      <h2>Dashboard</h2>
      <div class="topbar-meta">Welcome back, Admin &nbsp;·&nbsp; <?= date('l, F j, Y') ?></div>
    </div>
    <a href="?logout=1" style="font-size:0.78rem;color:#e08080;text-decoration:none;display:flex;align-items:center;gap:0.4rem;">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
  </div>

  <!-- STAT CARDS -->
  <div class="stat-cards">
    <div class="stat-card">
      <div class="stat-card-icon"><i class="fas fa-envelope"></i></div>
      <div class="stat-card-num"><?= count($subscribers) ?></div>
      <div class="stat-card-label">Subscribers</div>
    </div>
    <div class="stat-card">
      <div class="stat-card-icon"><i class="fas fa-comment-alt"></i></div>
      <div class="stat-card-num"><?= count($messages) ?></div>
      <div class="stat-card-label">Messages</div>
    </div>
    <div class="stat-card">
      <div class="stat-card-icon"><i class="fas fa-globe"></i></div>
      <div class="stat-card-num">6</div>
      <div class="stat-card-label">Pages</div>
    </div>
    <div class="stat-card">
      <div class="stat-card-icon"><i class="fas fa-images"></i></div>
      <div class="stat-card-num">16</div>
      <div class="stat-card-label">Gallery Photos</div>
    </div>
  </div>

  <!-- NEWSLETTER SUBSCRIBERS -->
  <div class="data-card" id="subscribers">
    <div class="data-card-header">
      <h3>Newsletter Subscribers</h3>
      <span class="badge"><?= count($subscribers) ?> total</span>
    </div>
    <?php if(empty($subscribers)): ?>
      <div class="empty-state"><i class="far fa-envelope"></i>No subscribers yet.</div>
    <?php else: ?>
    <div style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Email Address</th>
            <th>Subscribed At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($subscribers as $i=>$s): ?>
          <tr>
            <td style="color:#bbb;width:50px;"><?= $s['id'] ?></td>
            <td class="td-email"><?= htmlspecialchars($s['email']) ?></td>
            <td class="td-date"><?= htmlspecialchars($s['subscribed_at']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>

  <!-- CONTACT MESSAGES -->
  <div class="data-card" id="messages">
    <div class="data-card-header">
      <h3>Contact Messages</h3>
      <span class="badge"><?= count($messages) ?> total</span>
    </div>
    <?php if(empty($messages)): ?>
      <div class="empty-state"><i class="far fa-comment-alt"></i>No messages yet.</div>
    <?php else: ?>
    <div style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($messages as $m): ?>
          <tr>
            <td style="color:#bbb;width:50px;"><?= $m['id'] ?></td>
            <td style="font-weight:600;"><?= htmlspecialchars($m['name']) ?></td>
            <td class="td-email"><?= htmlspecialchars($m['email']) ?></td>
            <td style="font-size:0.85rem;color:#444;"><?= htmlspecialchars($m['subject']) ?></td>
            <td class="td-msg"><?= nl2br(htmlspecialchars(mb_strimwidth($m['message'],0,120,'…'))) ?></td>
            <td class="td-date"><?= htmlspecialchars($m['created_at']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>

</div><!-- /main -->

</body>
</html>
