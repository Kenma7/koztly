// resources/js/sidebar.js

console.log('🔄 Sidebar JavaScript loaded!');

// Simple sidebar toggle function
function toggleSidebar() {
    console.log('🎯 Toggle sidebar function called');
    
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    
    console.log('Elements:', {sidebar, mainContent});
    
    if (!sidebar || !mainContent) {
        console.log('❌ Some elements not found!');
        return;
    }
    
    const isMinimized = sidebar.classList.contains('minimized');
    console.log('Is minimized:', isMinimized);
    
    // Add loading state
    sidebar.style.pointerEvents = 'none';
    
    // 🔄 FIX LOGIC YANG TERBALIK
    if (isMinimized) {
        // MINIMIZE → EXPAND
        sidebar.classList.remove('minimized');
        setTimeout(() => {
            sidebar.classList.remove('w-16');
            sidebar.classList.add('w-64');
            mainContent.classList.remove('ml-16');
            mainContent.classList.add('ml-64');
        }, 50);
        console.log('✅ EXPANDED sidebar');
    } else {
        // EXPAND → MINIMIZE  
        sidebar.classList.add('minimized');
        setTimeout(() => {
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-16');
            mainContent.classList.remove('ml-64');
            mainContent.classList.add('ml-16');
        }, 200);
        console.log('✅ MINIMIZED sidebar');
    }
    
    // Remove loading state setelah animasi selesai
    setTimeout(() => {
        sidebar.style.pointerEvents = 'auto';
    }, 400);
    
    localStorage.setItem('sidebarMinimized', !isMinimized);
}

// Profile dropdown function
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profile-dropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Initialize sidebar
function initializeSidebar() {
    console.log('🚀 Initializing sidebar...');
    
    // Initialize sidebar state from localStorage
    const sidebarMinimized = localStorage.getItem('sidebarMinimized') === 'true';
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebar && mainContent) {
        if (sidebarMinimized) {
            sidebar.classList.add('minimized', 'w-16');
            sidebar.classList.remove('w-64');
            mainContent.classList.add('ml-16');
            mainContent.classList.remove('ml-64');
            console.log('🔄 Sidebar initialized as minimized');
        } else {
            sidebar.classList.remove('minimized');
            sidebar.classList.add('w-64');
            sidebar.classList.remove('w-16');
            mainContent.classList.add('ml-64');
            mainContent.classList.remove('ml-16');
            console.log('🔄 Sidebar initialized as expanded');
        }
    }
}

// Initialize navbar events
function initializeNavbar() {
    console.log('🎯 Setting up navbar event listeners...');
    
    // Add event listeners
    const navbarToggleBtn = document.getElementById('navbar-toggle-sidebar');
    const profileMenuBtn = document.getElementById('profile-menu-button');
    
    if (navbarToggleBtn) {
        navbarToggleBtn.addEventListener('click', toggleSidebar);
        console.log('🎯 Navbar toggle button event listener added');
    } else {
        console.log('❌ Navbar toggle button not found!');
    }
    
    if (profileMenuBtn) {
        profileMenuBtn.addEventListener('click', toggleProfileDropdown);
        console.log('🎯 Profile menu button event listener added');
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const profileDropdown = document.getElementById('profile-dropdown');
        const profileButton = document.getElementById('profile-menu-button');
        
        if (profileDropdown && profileButton && 
            !profileDropdown.contains(event.target) && 
            !profileButton.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
}

// Main initialization function
function initializeApp() {
    console.log('🚀 DOM loaded - initializing app');
    
    initializeSidebar();
    initializeNavbar();
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeApp);
} else {
    initializeApp();
}

// Test function
window.testSidebar = function() {
    console.log('🧪 Testing sidebar...');
    toggleSidebar();
}