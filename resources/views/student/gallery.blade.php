<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        
        .gallery-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 5rem 0;
            color: white;
            text-align: center;
        }
        
        .gallery-hero h1 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .gallery-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .gallery-section {
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
        
        .gallery-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            border-bottom: 2px solid var(--secondary-bg);
            padding-bottom: 1rem;
        }
        
        .gallery-tab {
            padding: 10px 25px;
            margin: 0 10px;
            background: none;
            border: none;
            font-weight: 600;
            color: var(--dark-text);
            border-radius: 30px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .gallery-tab.active {
            background-color: var(--primary-accent);
            color: white;
        }
        
        .gallery-tab:hover:not(.active) {
            background-color: var(--light-bg);
        }
        
        .gallery-container {
            columns: 3;
            column-gap: 15px;
        }
        
        .gallery-item {
            break-inside: avoid;
            margin-bottom: 15px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .gallery-item img,
        .gallery-item video {
            width: 100%;
            height: auto;
            display: block;
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover img,
        .gallery-item:hover video {
            transform: scale(1.05);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 20px 15px 15px;
            color: white;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover .gallery-actions {
            opacity: 1;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: var(--dark-text);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            transition: all 0.3s ease;
            border: none;
        }
        
        .action-btn:hover {
            background: var(--primary-accent);
            color: white;
            transform: scale(1.1);
        }
        
        .diagonal-item {
            transform: rotate(5deg);
            margin: 30px 0;
        }
        
        .diagonal-item:nth-child(even) {
            transform: rotate(-5deg);
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--dark-text) 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }
        
        .btn-close {
            filter: invert(1);
        }
        
        .modal-body {
            padding: 0;
        }
        
        .modal-media {
            width: 100%;
            max-height: 70vh;
            object-fit: contain;
        }
        
        .modal-footer {
            display: flex;
            justify-content: center;
            padding: 1rem;
        }
        
        .btn-download {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .btn-download i {
            margin-right: 8px;
        }
        
        .btn-download:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
        }

        .favourite-btn {
    background-color: rgba(255, 255, 255, 0.818);
    border: none;
    padding: 6px 10px;
    margin-left: 10px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 1rem; 
    color: #333; 
}

.favourite-btn i {
    transition: color 0.3s ease, transform 0.3s ease;
}

.favourite-btn:hover i {
    color: #e74c3c; 
    transform: scale(1.2); 
}

.favourite-btn.active i {
    color: #e74c3c;
}
        
        @media (max-width: 992px) {
            .gallery-container {
                columns: 2;
            }
        }
        
        @media (max-width: 768px) {
            .gallery-hero h1 {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .gallery-container {
                columns: 1;
            }
            
            .diagonal-item {
                transform: rotate(3deg);
            }
            
            .diagonal-item:nth-child(even) {
                transform: rotate(-3deg);
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

    @if(session('successMessage'))
    <div class="alert alert-success" class="alert alert-success position-absolute start-0 mt-5" style="z-index: 1000;">
        {{ session('successMessage') }}
    </div>
@endif

@if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif

    <section class="gallery-hero hero-container">
        <div class="container">
            <h1>EventSphere Gallery</h1>
            <p>Relive the best moments from our events through photos and videos</p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <h2 class="section-title">Event Memories</h2>

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">

                <div class="d-flex gap-2">
                    <select id="categoryFilter" class="form-select form-select-sm" style="min-width: 150px; border-radius: 8px; border: 1px solid #ccc; padding: 5px 10px;">
                        <option value="all">All Categories</option>
                        @foreach($events->pluck('category')->unique() as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    
                    <select id="yearFilter" class="form-select form-select-sm" style="min-width: 120px; border-radius: 8px; border: 1px solid #ccc; padding: 5px 10px;">
                        <option value="all">All Years</option>
                        @foreach(range(1,4) as $year)
                            <option value="{{ $year }}">{{ $year }} Year</option>
                        @endforeach
                    </select>
                </div>

                <div style="flex-grow: 1; max-width: 300px; margin-left: auto;">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search events..." style="border-radius: 8px; border: 1px solid #ccc; padding: 5px 10px;">
                </div>

            </div>


            
            <div class="gallery-tabs">
                <button class="gallery-tab active" data-filter="all">All Media</button>
                <button class="gallery-tab" data-filter="image">Images</button>
                <button class="gallery-tab" data-filter="video">Videos</button>
            </div>
            
            <div class="gallery-container">
                @forelse($events as $event)
                    <div class="gallery-item {{ $loop->iteration % 2 == 0 ? 'diagonal-item' : '' }}" 
                        data-type="{{ $event->media_type }}"
                        data-category="{{ $event->category }}"
                        data-year="{{ $event->eligible_years }}">
                        
                        @if($event->media_type === 'image')
                            <img src="{{ asset($event->media_file) }}" 
                                alt="{{ $event->title }}" 
                                class="img-fluid w-100" 
                                style="height: 200px; object-fit: cover;">
                        @elseif($event->media_type === 'video')
                            <video class="img-fluid w-100" 
                                style="height: 200px; object-fit: cover;" 
                                controls 
                                @if($event->thumbnail) poster="{{ asset($event->thumbnail) }}" @endif>
                                <source src="{{ asset($event->media_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                        <div class="gallery-overlay">
                            <h5>{{ $event->title }}</h5>
                            <p>{{ Str::limit($event->description, 60) }}</p>
                        </div>

                        <div class="gallery-actions">
                            <button class="action-btn" data-bs-toggle="modal" data-bs-target="#mediaModal"
                                    data-src="{{ asset($event->media_file) }}"

                                    data-type="{{ $event->media_type }}">
                                <i class="bi {{ $event->media_type === 'image' ? 'bi-arrows-fullscreen' : 'bi-play-fill' }}"></i>
                            </button>

                            <button class="action-btn download-btn" data-src="{{ $event->media_type === 'image' ? asset('images/events/'.$event->media_file) : asset('videos/events/'.$event->media_file) }}">
                                <i class="bi bi-download"></i>
                            </button>

                            <form action="{{ route('favourites.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="media_file" value="{{ $event->media_file }}">
                                <input type="hidden" name="media_type" value="{{ $event->media_type }}">
                                <input type="hidden" name="media_title" value="{{ $event->title }}">
                                <button type="submit" class="favourite-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p class="text-center text-muted">No media available.</p>
                @endforelse
            </div>

        </div>
    </section>

    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaModalLabel">Event Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="modal-media img-fluid" id="modalImage" src="" alt="" style="display: none;">
                    <div class="ratio ratio-16x9" id="modalVideo" style="display: none;">
                        <iframe src="" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-download" id="modalDownload">
                        <i class="bi bi-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

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
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }else if(errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000);
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.gallery-item');
    const categoryFilter = document.getElementById('categoryFilter');
    const yearFilter = document.getElementById('yearFilter');
    const searchInput = document.getElementById('searchInput');

    function filterGallery() {
        const category = categoryFilter.value.toLowerCase();
        const year = yearFilter.value.toLowerCase();
        const search = searchInput.value.toLowerCase();

        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category').toLowerCase();
            const itemYears = item.getAttribute('data-year').split(','); // multiple eligible years
            const title = item.querySelector('.gallery-overlay h5').textContent.toLowerCase();
            const desc = item.querySelector('.gallery-overlay p').textContent.toLowerCase();

            const categoryMatch = (category === 'all') || (itemCategory === category);
            const yearMatch = (year === 'all') || (itemYears.includes(year));
            const searchMatch = title.includes(search) || desc.includes(search);

            if (categoryMatch && yearMatch && searchMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    categoryFilter.addEventListener('change', filterGallery);
    yearFilter.addEventListener('change', filterGallery);
    searchInput.addEventListener('input', filterGallery);
});

        
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.gallery-tab');
            const items = document.querySelectorAll('.gallery-item');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    const filter = tab.getAttribute('data-filter');
                    
                    items.forEach(item => {
                        if (filter === 'all') {
                            item.style.display = 'block';
                        } else {
                            if (item.getAttribute('data-type') === filter) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        }
                    });
                });
            });
            
            const mediaModal = document.getElementById('mediaModal');
            mediaModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const mediaSrc = button.getAttribute('data-src');
                const mediaType = button.getAttribute('data-type');
                
                const modalImage = document.getElementById('modalImage');
                const modalVideo = document.getElementById('modalVideo');
                const modalDownload = document.getElementById('modalDownload');
                
                if (mediaType === 'image') {
                    modalImage.style.display = 'block';
                    modalVideo.style.display = 'none';
                    modalImage.src = mediaSrc;
                    modalDownload.setAttribute('data-src', mediaSrc);
                } else if (mediaType === 'video') {
                    modalImage.style.display = 'none';
                    modalVideo.style.display = 'block';
                    modalVideo.querySelector('iframe').src = mediaSrc;
                    modalDownload.setAttribute('data-src', mediaSrc);
                }
                
                const item = button.closest('.gallery-item');
                if (item) {
                    const title = item.querySelector('.gallery-overlay h5');
                    if (title) {
                        document.getElementById('mediaModalLabel').textContent = title.textContent;
                    }
                }
            });
            
            mediaModal.addEventListener('hidden.bs.modal', function() {
                const modalVideo = document.getElementById('modalVideo');
                modalVideo.querySelector('iframe').src = '';
            });
            
            const downloadButtons = document.querySelectorAll('.download-btn');
            downloadButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const src = this.getAttribute('data-src');
                    if (src) {
                        const a = document.createElement('a');
                        a.href = src;
                        a.download = '';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                });
            });
            
            document.getElementById('modalDownload').addEventListener('click', function() {
                const src = this.getAttribute('data-src');
                if (src) {
                    const a = document.createElement('a');
                    a.href = src;
                    a.download = '';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            });
        });
    </script>
</body>
</html>