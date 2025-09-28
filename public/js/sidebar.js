    function toggleSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    const backdrop = document.querySelector('.sidebar-backdrop');
    sidebar.classList.toggle('open');
    document.body.classList.toggle('sidebar-open');
    if (sidebar.classList.contains('open')) {
        backdrop.style.display = 'block';
    } else {
        backdrop.style.display = 'none';
    }
}
function closeSidebar() {
    const sidebar = document.getElementById('sidebarMenu');
    const backdrop = document.querySelector('.sidebar-backdrop');
    sidebar.classList.remove('open');
    document.body.classList.remove('sidebar-open');
    backdrop.style.display = 'none';
}
// Optional: Close sidebar on navigation (mobile)
document.querySelectorAll('.sidebar-menu a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 769) closeSidebar();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarBackdrop = document.querySelector('.sidebar-backdrop');
    const isMobile = window.innerWidth < 768;
    
    // Toggle sidebar on button click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            if (isMobile) {
                document.body.classList.toggle('sidebar-open');
                sidebar.classList.toggle('open');
            } else {
                sidebar.classList.toggle('collapsed');
            }
            
            // Toggle icon between bars and times
            const icon = this.querySelector('i');
            if (icon) {
                if (sidebar.classList.contains('open') || sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

    // Close sidebar when clicking on backdrop (mobile only)
    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener('click', function() {
            document.body.classList.remove('sidebar-open');
            sidebar.classList.remove('open');
            
            // Reset icon
            const icon = document.querySelector('.sidebar-toggle i');
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Set active menu item based on current URL
    function setActiveMenuItem() {
        const currentUrl = window.location.pathname;
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        
        menuItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentUrl.includes(href)) {
                // Remove active class from all items
                menuItems.forEach(i => i.classList.remove('active'));
                // Add active class to current item
                item.classList.add('active');
            }
        });
    }

    // Call the function when the page loads
    setActiveMenuItem();

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const newIsMobile = window.innerWidth < 768;
            
            // Only update if the mobile state has changed
            if (newIsMobile !== isMobile) {
                // Reset sidebar state on breakpoint change
                if (newIsMobile) {
                    sidebar.classList.remove('collapsed');
                    sidebar.classList.remove('open');
                    document.body.classList.remove('sidebar-open');
                } else {
                    sidebar.classList.remove('open');
                    document.body.classList.remove('sidebar-open');
                }
            }
        }, 250);
    });

    // Add smooth scroll to sidebar
    const sidebarMenu = document.querySelector('.sidebar-menu');
    if (sidebarMenu) {
        sidebarMenu.addEventListener('click', function(e) {
            // Close sidebar on mobile after clicking a menu item
            if (isMobile) {
                document.body.classList.remove('sidebar-open');
                sidebar.classList.remove('open');
                
                // Reset icon
                const icon = document.querySelector('.sidebar-toggle i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }
});
