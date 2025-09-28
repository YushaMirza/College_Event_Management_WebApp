<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - About Us</title>
    @include('student.layouts.links')
    <style>
        :root {
            --light-bg: #F0F3FA;
            --secondary-bg: #D5DEEF;
            --soft-accent: #8AAEE0;
            --light-blue: #B1C9EF;
            --primary-accent: #638ECB;
            --dark-text: #395886;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            background-color: #fff;
        }

        .about-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        .about-hero h1 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .about-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin: 4rem 0 3rem;
            color: var(--dark-text);
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: var(--primary-accent);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .about-content {
            padding: 5rem 0;
        }
        
        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            height: 100%;
            border-left: 4px solid var(--primary-accent);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-accent);
            margin-bottom: 1.5rem;
        }
        
        .team-section {
            background-color: var(--light-bg);
            padding: 5rem 0;
        }
        
        .team-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            margin-bottom: 2rem;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .team-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        
        .team-info {
            padding: 1.5rem;
        }
        
        .team-name {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }
        
        .team-role {
            color: var(--primary-accent);
            font-weight: 500;
            margin-bottom: 1rem;
        }
                .stats-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--dark-text) 100%);
            color: white;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .about-hero h1 {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
    @if(auth()->check() && auth()->user()->department === 'admin')
  	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  	@include('student.layouts.header_css')
  @else
  	@include('student.layouts.header_css')
  @endif
  
    @include('student.layouts.footer_css')
</head>
<body>
    @include('student.layouts.header')

    <section class="about-hero hero-container">
        <div class="container">
            <h1>About EventSphere</h1>
            <p>Discover the story behind our platform and how we're transforming college event management</p>
        </div>
    </section>

    <section class="about-content">
        <div class="container">
            <h2 class="section-title">Our Story</h2>
            
            <div class="row mb-5">
                <div class="col-lg-6">
                    <p class="about-text">
                        EventSphere was founded in 2020 with a simple mission: to make college event management seamless, 
                        efficient, and enjoyable for everyone involved. What started as a small project has now grown into 
                        a comprehensive platform serving thousands of students across multiple campuses.
                    </p>
                    <p class="about-text">
                        Our team of passionate developers and designers work tirelessly to create an experience that 
                        simplifies event discovery, registration, and management while fostering campus community engagement.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                         alt="EventSphere Team" class="img-fluid rounded-3">
                </div>
            </div>
            
            <h2 class="section-title">What We Offer</h2>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-search feature-icon"></i>
                        <h3>Event Discovery</h3>
                        <p>Find events that match your interests with our advanced filtering and recommendation system.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-ticket-perforated feature-icon"></i>
                        <h3>Easy Registration</h3>
                        <p>Register for events with just a few clicks and receive confirmation instantly.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-bell feature-icon"></i>
                        <h3>Smart Reminders</h3>
                        <p>Never miss an event with our timely notifications and calendar integration.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-graph-up feature-icon"></i>
                        <h3>Analytics</h3>
                        <p>Event organizers can track attendance and engagement metrics for better planning.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-chat-dots feature-icon"></i>
                        <h3>Community Building</h3>
                        <p>Connect with other attendees and build your network through our platform.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <i class="bi bi-award feature-icon"></i>
                        <h3>Recognition</h3>
                        <p>Earn digital certificates and badges for your participation in events.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number" id="eventCount">500+</div>
                        <div class="stat-label">Events Hosted</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number" id="userCount">15,000+</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number" id="collegeCount">25+</div>
                        <div class="stat-label">Partner Colleges</div>
                    </div>
                </div>
                                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number" id="satisfactionRate">98%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Our Team</h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="team-card">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" 
                             alt="Team Member" class="team-img">
                        <div class="team-info">
                            <h4 class="team-name">Sarah Johnson</h4>
                            <div class="team-role">CEO & Founder</div>
                            <p>With 10+ years in edtech, Sarah leads our vision to transform campus event management.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="team-card">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80" 
                             alt="Team Member" class="team-img">
                        <div class="team-info">
                            <h4 class="team-name">Michael Chen</h4>
                            <div class="team-role">CTO</div>
                            <p>Michael oversees our technical architecture and leads our development team.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="team-card">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=761&q=80" 
                             alt="Team Member" class="team-img">
                        <div class="team-info">
                            <h4 class="team-name">Priya Patel</h4>
                            <div class="team-role">Head of Design</div>
                            <p>Priya ensures our platform is not only functional but also beautiful and intuitive.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('student.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>

    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
        
        function animateValue(id, start, end, duration) {
            let obj = document.getElementById(id);
            let range = end - start;
            let current = start;
            let increment = end > start ? 1 : -1;
            let stepTime = Math.abs(Math.floor(duration / range));
            let timer = setInterval(function() {
                current += increment;
                obj.innerHTML = current + (id === 'satisfactionRate' ? '%' : '+');
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                animateValue('eventCount', 0, 500, 2000);
                animateValue('userCount', 0, 15000, 2000);
                animateValue('collegeCount', 0, 25, 2000);
                animateValue('satisfactionRate', 0, 98, 2000);
            }, 500);
        });
    </script>
</body>
</html>