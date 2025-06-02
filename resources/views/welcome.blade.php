<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeosin Salon | Layanan Kecantikan Profesional ke Rumah</title>
    <meta name="description"
        content="Layanan kecantikan profesional datang ke rumah Anda. Perawatan wajah, spa, manicure-pedicure, dan berbagai treatment kecantikan lainnya.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #ff2d75;
            --primary-dark: #d81b60;
            --secondary: #ff8fab;
            --light: #fff0f5;
            --dark: #333;
            --gray: #777;
            --white: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .logo span {
            color: var(--primary-dark);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-nav {
            padding: 8px 20px;
            background-color: var(--primary);
            color: var(--white);
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn-nav:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 120px 2rem 4rem;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--light) 0%, var(--white) 100%);
        }

        .hero-content {
            flex: 1 1 400px;
            max-width: 600px;
            padding: 1rem;
            animation: fadeInLeft 1s ease;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
            line-height: 1.2;
        }

        .hero-content h1 span {
            color: var(--primary);
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: var(--gray);
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: var(--white);
            background-color: var(--primary);
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(216, 27, 96, 0.3);
            cursor: pointer;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(216, 27, 96, 0.4);
        }

        .btn i {
            margin-left: 8px;
        }

        .hero-image {
            flex: 1 1 400px;
            max-width: 500px;
            padding: 1rem;
            position: relative;
            animation: fadeInRight 1s ease;
        }

        .hero-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transition: transform 0.5s ease;
        }

        .hero-image:hover img {
            transform: scale(1.03);
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background-color: var(--white);
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .section-subtitle {
            color: var(--gray);
            margin-bottom: 50px;
            font-size: 1.1rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .service-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .service-desc {
            color: var(--gray);
            font-size: 0.95rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 80px 0;
            background-color: var(--light);
            text-align: center;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: var(--gray);
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .author-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .author-info h4 {
            color: var(--dark);
            margin-bottom: 5px;
        }

        .author-info p {
            color: var(--gray);
            font-size: 0.8rem;
        }

        /* CTA Section */
        .cta {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            text-align: center;
        }

        .cta h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        .cta p {
            margin-bottom: 30px;
            font-size: 1.1rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-light {
            background-color: var(--white);
            color: var(--primary);
        }

        .btn-light:hover {
            background-color: var(--light);
            color: var(--primary-dark);
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--white);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .social-links {
            display: flex;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin-right: 10px;
            color: var(--white);
            transition: all 0.3s;
        }

        .social-links a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #aaa;
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                padding-top: 40px;
                transition: left 0.3s ease;
            }

            .nav-links.active {
                left: 0;
            }

            .nav-links li {
                margin: 15px 0;
            }

            .hero {
                flex-direction: column-reverse;
                text-align: center;
                padding-top: 100px;
            }

            .hero-content,
            .hero-image {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .btn {
                padding: 0.7rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">Yeosin<span>Salon</span></a>
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#testimonials">Testimoni</a></li>
                    <li><a href="main/register" class="btn">Login</a></li>
                </ul>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-wrapper">
                <div class="hero-content">
                    <h1>Kecantikan Profesional <span>Datang ke Rumah Anda</span></h1>
                    <p>Nikmati berbagai layanan kecantikan berkualitas salon dengan kenyamanan rumah Anda sendiri.
                        Perawatan wajah, spa, manicure-pedicure, dan banyak lagi dengan terapis profesional kami.</p>
                    <a href="main/login" class="btn">Pesan Sekarang <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="hero-image">
                    <img src="image/hero.jpg" alt="Beauty treatment at home">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">Berbagai perawatan kecantikan profesional yang bisa Anda dapatkan di rumah</p>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3 class="service-title">Facial Treatment</h3>
                    <p class="service-desc">Perawatan wajah profesional dengan produk berkualitas untuk kulit bersih,
                        cerah, dan sehat.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-hand-sparkles"></i>
                    </div>
                    <h3 class="service-title">Manicure & Pedicure</h3>
                    <p class="service-desc">Perawatan kuku tangan dan kaki lengkap dengan pilihan warna cat kuku
                        premium.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3 class="service-title">Hair Treatment</h3>
                    <p class="service-desc">Perawatan rambut mulai dari creambath, smoothing, hingga coloring oleh
                        stylist profesional.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3 class="service-title">Body Treatment</h3>
                    <p class="service-desc">Pijat tubuh, body scrub, dan perawatan lainnya untuk relaksasi dan
                        kecantikan kulit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <h2 class="section-title">Apa Kata Mereka</h2>
            <p class="section-subtitle">Testimoni dari pelanggan puas Yeosin Salon</p>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Sangat praktis! Saya bisa dapat facial treatment di rumah sambil
                        menemani anak. Terapisnya profesional."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah" class="author-img">
                        <div class="author-info">
                            <h4>Sarah Wijaya</h4>
                            <p>Tegal</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Manicure pedicure di rumah sangat nyaman. Tidak perlu antri dan
                        peralatannya steril. Sudah langganan 6 bulan terakhir."</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dewi" class="author-img">
                        <div class="author-info">
                            <h4>Dewi Lestari</h4>
                            <p>Tegal</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Hair treatment di rumah sangat menghemat waktu saya. Hasilnya tidak
                        kalah dengan salon premium. Recommended banget!"</p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Rina" class="author-img">
                        <div class="author-info">
                            <h4>Rina Hartono</h4>
                            <p>Tegal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Siap Menerima Perawatan di Rumah?</h2>
            <p>Daftar sekarang dan dapatkan promo spesial untuk perawatan pertama Anda. Nikmati kenyamanan salon di
                rumah Anda sendiri.</p>
            <a href="main/register" class="btn btn-light">Daftar Sekarang <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Yeosin Salon</h3>
                    <p>Layanan kecantikan profesional datang ke rumah Anda. Memberikan pengalaman salon premium dengan
                        kenyamanan rumah.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Layanan</h3>
                    <ul class="footer-links">
                        <li><a href="#">Facial Treatment</a></li>
                        <li><a href="#">Manicure Pedicure</a></li>
                        <li><a href="#">Hair Treatment</a></li>
                        <li><a href="#">Body Treatment</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Perusahaan</h3>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Kontak</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-phone-alt"></i> 0812-3456-7890</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> info@Yeosinsalon.com</a></li>
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Tegal, Indonesia</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Yeosin Salon. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add shadow to header on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>

</html>
