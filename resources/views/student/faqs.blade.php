<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - FAQs</title>
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
        
        .faq-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        .faq-hero h1 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .faq-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .faq-section {
            padding: 5rem 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
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
        
        .search-box {
            max-width: 600px;
            margin: 0 auto 3rem;
            position: relative;
        }
        
        .search-box input {
            padding: 15px 20px;
            border-radius: 50px;
            border: 2px solid var(--secondary-bg);
            width: 100%;
            padding-left: 50px;
            transition: all 0.3s ease;
        }
        
        .search-box input:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(99, 142, 203, 0.2);
            outline: none;
        }
        
        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-accent);
            font-size: 1.2rem;
        }
        
        .accordion-item {
            border: none;
            border-radius: 10px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .accordion-button {
            background-color: white;
            color: var(--dark-text);
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            border: none;
            box-shadow: none;
        }
        
        .accordion-button:not(.collapsed) {
            background-color: var(--primary-accent);
            color: white;
        }
        
        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }
        
        .accordion-body {
            padding: 1.5rem;
            background-color: white;
            color: #555;
        }
        
        .category-title {
            margin: 3rem 0 1.5rem;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-blue);
            color: var(--dark-text);
            font-weight: 600;
        }
        
        .contact-cta {
            background-color: var(--light-bg);
            padding: 4rem 0;
            text-align: center;
        }
        
        .contact-cta h3 {
            margin-bottom: 1.5rem;
            color: var(--dark-text);
        }
        
        .contact-cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            color: #666;
        }
        
        .btn-contact {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-contact:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            .faq-hero h1 {
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

    <section class="faq-hero hero-container">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to common questions about EventSphere and how to make the most of our platform.</p>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Common Questions</h2>
            
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search for questions...">
            </div>
            
            <h3 class="category-title">General Questions</h3>
            <div class="accordion" id="generalAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What is EventSphere?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#generalAccordion">
                        <div class="accordion-body">
                            EventSphere is a comprehensive college event management platform designed to help students discover, register for, and manage events happening on campus. We connect students with technical workshops, cultural festivals, sports tournaments, seminars, and more.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Is EventSphere free to use?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#generalAccordion">
                        <div class="accordion-body">
                            Yes, EventSphere is completely free for students to use. You can browse events, register for them, and create your own events without any charges. Some premium features for organizers may have associated costs, but basic functionality is free.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How do I create an account?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#generalAccordion">
                        <div class="accordion-body">
                            Creating an account is simple! Click on the "Register" button in the top right corner, fill in your details including your name, email address, and password. You'll receive a confirmation email to verify your account. Once verified, you can start using EventSphere.
                        </div>
                    </div>
                </div>
            </div>
            
            <h3 class="category-title">Event Registration</h3>
            <div class="accordion" id="registrationAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            How do I register for an event?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#registrationAccordion">
                        <div class="accordion-body">
                            To register for an event, simply browse through the events listed on our platform, click on the event you're interested in, and click the "Register" button. You'll receive a confirmation email with event details and any additional instructions.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Can I cancel my registration?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#registrationAccordion">
                        <div class="accordion-body">
                            Yes, you can cancel your registration for most events. Go to your profile, find the "My Events" section, locate the event you want to cancel, and click "Cancel Registration." Please note that some events may have specific cancellation policies, especially if they have limited seats.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Will I receive a reminder for events I've registered for?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#registrationAccordion">
                        <div class="accordion-body">
                            Yes, EventSphere sends automatic reminders 24 hours before the event, and another reminder 1 hour before the event starts. You can customize your notification preferences in your account settings.
                        </div>
                    </div>
                </div>
            </div>
            
            <h3 class="category-title">Creating Events</h3>
            <div class="accordion" id="creatingAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            How do I create an event on EventSphere?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#creatingAccordion">
                        <div class="accordion-body">
                            To create an event, log into your account and click on "Create Event" in the navigation menu. Fill in all the required details about your event including title, description, date, time, location, and category. Once submitted, our team will review and approve your event, usually within 24 hours.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            What types of events can I create?
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#creatingAccordion">
                        <div class="accordion-body">
                            You can create various types of college events including technical workshops, cultural festivals, sports tournaments, seminars, hackathons, webinars, and social gatherings. All events must comply with our community guidelines and be approved by our team.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Can I limit the number of participants for my event?
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#creatingAccordion">
                        <div class="accordion-body">
                            Yes, when creating your event, you can set a maximum number of participants. Once this limit is reached, the registration will close automatically, and interested participants can join a waitlist in case spots become available.
                        </div>
                    </div>
                </div>
            </div>
            
            <h3 class="category-title">Technical Issues</h3>
            <div class="accordion" id="technicalAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            What should I do if I forgot my password?
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#technicalAccordion">
                        <div class="accordion-body">
                            If you've forgotten your password, click on the "Login" button and then select "Forgot Password." Enter your email address, and we'll send you a link to reset your password. The link will expire after 24 hours for security reasons.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                            The website is not loading properly. What should I do?
                        </button>
                    </h2>
                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#technicalAccordion">
                        <div class="accordion-body">
                            If you're experiencing issues with the website, try these steps:
                            <ol>
                                <li>Refresh the page</li>
                                <li>Clear your browser cache and cookies</li>
                                <li>Try using a different browser</li>
                                <li>Check your internet connection</li>
                            </ol>
                            If the problem persists, please contact our support team with details about the issue.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                            I'm not receiving email notifications. What could be wrong?
                        </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#technicalAccordion">
                        <div class="accordion-body">
                            If you're not receiving our emails, please check:
                            <ol>
                                <li>Your spam or junk folder</li>
                                <li>That you've verified your email address</li>
                                <li>Your notification settings in your EventSphere account</li>
                                <li>That you've whitelisted emails from @eventsphere.com</li>
                            </ol>
                            If you're still having issues, contact our support team for assistance.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-cta">
        <div class="container">
            <h3>Still have questions?</h3>
            <p>Can't find the answer you're looking for? Please reach out to our friendly support team.</p>
            <a href="{{route('contact_us')}}" class="btn btn-contact">Contact Support</a>
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
        
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-box input');
            const accordionItems = document.querySelectorAll('.accordion-item');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                accordionItems.forEach(item => {
                    const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                    
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>