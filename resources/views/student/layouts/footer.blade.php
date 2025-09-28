<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5" data-aos="fade-up">
                <h4 class="footer-title"><i class="bi bi-calendar-event"></i> EventSphere</h4>
                <p>Your one-stop platform for discovering and managing college events. Never miss out on opportunities to learn, connect, and have fun!</p>
                <div class="mt-4">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('events')}}">Events</a></li>
                    <li><a href="{{route('gallery')}}">Gallery</a></li>
                    <li><a href="{{route('about')}}">About Us</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-5" data-aos="fade-up" data-aos-delay="200">
                <h5 class="footer-title">Resources</h5>
                <ul class="footer-links">
                    <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                    <li><a href="{{route('faqs')}}">FAQ</a></li>
                    <li><a href="#">Sitemap</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-4 mb-5" data-aos="fade-up" data-aos-delay="300">
                <h5 class="footer-title">Stay Updated</h5>
                <p>Subscribe to our newsletter to receive updates about upcoming events.</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Your email address" aria-label="Your email address" aria-describedby="button-subscribe">
                    <button class="btn btn-primary" style="height: 50px;" type="button" id="button-subscribe">Subscribe</button>
                </div>
            </div>
        </div>
        
        <div class="text-center copyright">
            <p>&copy; 2023 EventSphere. All rights reserved.</p>
        </div>
    </div>
</footer>