<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asahi Medic Clinic</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Variables */
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #f72585;
            --dark-color: #212121;
            --light-color: #f8f9fa;
            --gray-color: #6c757d;
        }

        /* Basic Styles */
        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        a:hover {
            color: var(--secondary-color);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .section {
            padding: 80px 0;
        }

        .text-center {
            text-align: center;
        }

        /* Header Styles */
        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            padding: 20px 0;
            z-index: 100;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        header.scrolled {
            padding: 10px 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            list-style: none;
            font: 400;
            align-items: center
        }

        .nav-links li {
            margin-left: 70px;
        }

        .nav-links a {
            color: var(--dark-color);
            font-weight: 500;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: var(--dark-color);
            margin: 5px;
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero {
            padding-top: 180px;
            padding-bottom: 100px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e6e9f0 100%);
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-text {
            width: 50%;
        }

        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: var(--gray-color);
        }

        .hero-image {
            width: 45%;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .hero-buttons .btn {
            margin-right: 15px;
        }

        /* Features Section */
        .features {
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .section-title p {
            color: var(--gray-color);
            max-width: 700px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: rgba(67, 97, 238, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .feature-icon i {
            color: var(--primary-color);
            font-size: 24px;
        }

        .feature-card h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .feature-card p {
            color: var(--gray-color);
            margin-bottom: 15px;
        }

        /* Testimonials Section */
        .testimonials {
            background-color: #f5f7fa;
            position: relative;
            overflow: hidden;
        }

        .testimonial-slider {
            display: flex;
            width: 300%;
            transition: transform 0.5s ease;
        }

        .testimonial-slide {
            width: 33.333%;
            padding: 0 15px;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .testimonial-text {
            font-size: 1.1rem;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }

        .author-info h4 {
            margin-bottom: 5px;
        }

        .author-info p {
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        .slider-controls {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .slider-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .slider-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            text-align: center;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta p {
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta .btn {
            background-color: white;
            color: var(--primary-color);
        }

        .cta .btn:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #b3b3b3;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            margin-top: 15px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            margin-right: 10px;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #b3b3b3;
            font-size: 0.9rem;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            padding: 40px;
            position: relative;
            transform: translateY(50px);
            transition: all 0.3s ease;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-text,
            .hero-image {
                width: 100%;
            }

            .hero-image {
                margin-top: 40px;
            }

            .hamburger {
                display: block;
            }

            .nav-links {
                position: absolute;
                right: 0;
                top: 80px;
                background-color: white;
                width: 100%;
                flex-direction: column;
                align-items: center;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                clip-path: circle(0px at 90% -10%);
                transition: all 0.5s ease-out;
                pointer-events: none;
            }

            .nav-links.active {
                clip-path: circle(1000px at 90% -10%);
                pointer-events: all;
            }

            .nav-links li {
                margin: 15px 0;
            }
        }

        @media (max-width: 576px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="container nav-container">
            <a href="#" class="logo">Asahi Medical Clinic<span style="color:var(--accent-color)">.</span></a>

            <div class="hamburger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#" class="btn btn-outline">Get Started</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Discover trusted solutions for your health and wellness</h1>
                <p>Explore a wide range of reliable and professionally recommended health services and wellness products
                    designed to help you feel your best.
                    Whether you're looking to improve your physical fitness, manage stress, boost your immunity, or find
                    expert medical advice,
                    our platform connects you with trusted resources to support your journey toward a healthier
                    lifestyle.</p>
                <div class="hero-buttons">
                    <a href={{ route('login') }} class="btn btn-primary ">Login</a>
                    <a href={{ route('register') }} class="btn btn-outline">Register</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://i.pinimg.com/736x/ee/db/28/eedb285489032642733b6cfaef94bdd5.jpg" alt="Hero Image"
                    width="75%">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section features">
        <div class="container">
            <div class="section-title">
                <h2>Our Amazing Features</h2>
                <p>Discover how our platform can help you achieve your business goals with our innovative features.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i>⚡</i>
                    </div>
                    <h3>Fast Respons</h3>
                    <p>Our platform is optimized for fast respons to ensure you get the best experience possible.</p>
                    <a href="#">Learn more →</a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i>🔒</i>
                    </div>
                    <h3>Secure & Reliable </h3>
                    <p>Your data is our priority with enterprise-grade protection and 99.9% uptime.</p>
                    <a href="#">Learn more →</a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i>📱</i>
                    </div>
                    <h3>Fully Responsive</h3>
                    <p>Access your dashboard from any device with our mobile-friendly interface.</p>
                    <a href="#">Learn more →</a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i>📊</i>
                    </div>
                    <h3>Advanced Health Screenings and Diagnostics</h3>
                    <p>Health check-ups and diagnostic services to detect health issues early,
                        such as blood tests, cholesterol checks and heart health assessments.</p>
                    <a href="#">Learn more →</a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i>🔄</i>
                    </div>
                    <h3>Seamless Integration</h3>
                    <p>Connect with your favorite tools and services with our easy integration system.</p>
                    <a href="#">Learn more →</a>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i>💬</i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated team is always ready to help you with any questions or issues.</p>
                    <a href="#">Learn more →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Clients Say</h2>
                <p>Don't just take our word for it. See what our satisfied customers have to say about our platform.</p>
            </div>

            <div class="testimonial-slider" id="testimonialSlider">
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"I am always impressed with the quality of service at this clinic.
                            The staff is friendly and professional, and the doctors take their time to listen to
                            concerns and provide thorough explanations. I feel well cared for every time I visit."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="https://i.pinimg.com/736x/57/7b/e7/577be7cdd9aca716f21878adb9de7bde.jpg"
                                    alt="Akemi">
                            </div>
                            <div class="author-info">
                                <h4>Akemi Mia</h4>
                                <p>Data Analyst, Younger Song</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"This clinic provides a wide range of healthcare services. From
                            general consultations to specialized treatments, I know I can always rely on them for
                            comprehensive care. The doctors are very knowledgeable and up-to-date on the latest medical
                            practices."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="https://i.pinimg.com/736x/c6/14/8d/c6148d5212b20e22c41a949db4b315c6.jpg"
                                    alt="Mimuse">
                            </div>
                            <div class="author-info">
                                <h4>Mimuse</h4>
                                <p>CEO, Nerdunit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"The follow-up care after my treatment was exceptional. The clinic
                            ensured I had all the information I needed for my recovery, and they checked in to see how I
                            was doing. It really shows they care about their patients' long-term well-being."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="https://i.pinimg.com/736x/12/03/9f/12039fea6176ff9677f21b4dc0741feb.jpg"
                                    alt="Emily Rodriguez">
                            </div>
                            <div class="author-info">
                                <h4>Mimoka</h4>
                                <p>Marketing Director, Wacko Area</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-controls">
                <button class="slider-btn prev-btn">←</button>
                <button class="slider-btn next-btn">→</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-column">
                    <h3>Asahi Medical Clinic<span style="color:var(--accent-color)">.</span></h3>
                    <p>Asahi Medical Clinic is a modern health clinic dedicated to providing high-quality medical care
                        for individuals and families. We offer a wide range of healthcare services. With a team of
                        experienced doctors and
                        friendly staff, Asahi Medical Clinic ensures every patient receives professional treatment in a
                        comfortable and supportive environment. Your health is our priority, and we are here to help you
                        live a healthier life.</p>
                    <div class="social-links">
                        <a href="#"><i>F</i></a>
                        <a href="#"><i>T</i></a>
                        <a href="#"><i>L</i></a>
                        <a href="#"><i>I</i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Company</h3>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Resources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Support Center</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">GDPR</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 Asahi Medical Clinic. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Header Scroll Effect
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Testimonial Slider
        const slider = document.getElementById('testimonialSlider');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        let slideIndex = 0;

        function showSlide(index) {
            if (index > 2) slideIndex = 0;
            if (index < 0) slideIndex = 2;

            slider.style.transform = `translateX(-${slideIndex * 33.333}%)`;
        }

        prevBtn.addEventListener('click', () => {
            slideIndex--;
            showSlide(slideIndex);
        });

        nextBtn.addEventListener('click', () => {
            slideIndex++;
            showSlide(slideIndex);
        });

        // Auto slide
        setInterval(() => {
            slideIndex++;
            showSlide(slideIndex);
        }, 5000);

        // Modal
        const modal = document.getElementById('modal');
        const openModalBtns = document.querySelectorAll('.open-modal');
        const closeModal = document.querySelector('.close-modal');

        openModalBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.add('active');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Form Submission
        const form = document.getElementById('signupForm');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const company = document.getElementById('company').value;

            if (!name || !email || !company) {
                alert('Please fill out all fields');
                return;
            }

            // Here you would normally send the data to your server
            // For demo purposes, we'll just show an alert
            alert(`Thank you, ${name}! Your trial account has been created. We've sent confirmation details to ${email}.`);

            // Reset form and close modal
            form.reset();
            modal.classList.remove('active');
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                if (this.getAttribute('href') === '#') return;

                const target = document.querySelector(this.getAttribute('href'));

                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (navLinks.classList.contains('active')) {
                        navLinks.classList.remove('active');
                    }
                }
            });
        });

        // Animation on Scroll
        const cards = document.querySelectorAll('.feature-card');

        function checkScroll() {
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < window.innerHeight - 100) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }

        // Set initial state for animation
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
        });

        window.addEventListener('scroll', checkScroll);
        window.addEventListener('load', checkScroll);
    </script>
</body>

</html>