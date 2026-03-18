# Traveling Dreams & Destinations ✈️🌍

> *A full-stack travel blog built as 1st Year Final Project*
> *Explore. Dream. Discover.*

---

## 🌐 Live Demo

> Run locally using XAMPP (setup instructions below)

---

## 💡 What is this?

A fully functional full-stack travel blog website where users can explore destinations, read travel blogs, view a photo gallery, subscribe to a newsletter, and send contact messages. Built with PHP & MySQL backend and a beautiful custom frontend.

---

## ✨ Features

### 🏠 Home Page
- **Video Hero Section** — Auto-playing background travel video
- **Featured Destinations** — 3-column grid of top travel spots
- **Destination Mosaic** — Interactive image grid with hover effects
- **Stats Bar** — Animated statistics display
- **Skills Ticker** — Scrolling animated banner
- **About Strip** — Split layout with image and text

### 📝 Blog Page
- Travel blog posts listing
- Clean editorial layout with Playfair Display typography

### 🗺️ Destinations Page
- Destinations organized by region
- Hover animations on destination cards

### 🖼️ Gallery Page
- **Masonry photo gallery** with lightbox effect
- Smooth image transitions

### 👤 About Page
- Personal travel story and introduction

### 📬 Contact Page
- **Contact Form** — Name, email, subject & message
- Form data saved to MySQL database
- Input validation with error messages
- **Newsletter Subscription** — Email subscription system
- Instagram-style social grid

### 🔐 Admin Dashboard
- View all contact messages
- Manage newsletter subscribers
- Protected with login credentials

---

## 🛠️ Tech Stack

| Technology | Purpose |
|-----------|---------|
| HTML5 | Page structure |
| CSS3 | Custom styling & animations |
| JavaScript | Interactive UI elements |
| PHP 7+ | Backend logic & form handling |
| MySQL | Database for messages & subscribers |
| mysqli | PHP database connection |
| Font Awesome | Icons |
| Google Fonts | Playfair Display & DM Sans typography |

---

## 📁 Project Structure

```
travel_blog/
│
├── index.php              # Home page
├── blog.php               # Blog listing page
├── destinations.php       # Destinations by region
├── gallery.php            # Photo gallery with lightbox
├── about.php              # About page
├── contact.php            # Contact form + newsletter
├── admin_dashboard.php    # Admin panel
├── travel_blog.sql        # Database setup file
│
├── assets/
│   ├── style.css          # Global stylesheet
│   └── logo.png           # Site logo
│
└── includes/
    ├── navbar.php         # Shared navigation bar
    └── footer.php         # Shared footer + newsletter
```

### Database Tables
| Table | Purpose |
|-------|---------|
| contact_messages | Stores contact form submissions |
| newsletter_subscribers | Stores newsletter emails |

---

## 🚀 How to Run Locally (XAMPP)

**Step 1: Database Setup**
1. Open **XAMPP** → Start **Apache** & **MySQL**
2. Go to **http://localhost/phpmyadmin**
3. Click **Import** → Choose `travel_blog.sql` → Click **Go**

**Step 2: Run the Project**
1. Copy this folder into `C:/xampp/htdocs/travel_blog/`
2. Visit: **http://localhost/travel_blog/index.php**

**Step 3: Admin Panel**
- URL: `http://localhost/travel_blog/admin_dashboard.php`
- Username: `admin`
- Password: `yahya`

---

## 👨‍💻 Developer

**M. Yahya Iqbal**
Software Engineering Student — Aligarh Institute of Technology, Karachi
📧 muhammadyahyaiqbal1@gmail.com
🔗 [LinkedIn](https://linkedin.com/in/yahya-iqbal) | [GitHub](https://github.com/Yahya-Iqbal1) | [Portfolio](https://yahya-iqbal.netlify.app)

---

> *"The world is a book, and those who do not travel read only one page."*
