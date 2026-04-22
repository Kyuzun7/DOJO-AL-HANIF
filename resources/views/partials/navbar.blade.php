<nav class="sticky-navbar">
    <div class="navbar-container">
        <!-- Let side: Hamburger & Title -->
        <div class="navbar-left">
            <button class="hamburger-btn" aria-label="Menu" onclick="toggleSidebarMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="brand-logo">DOJO AL-HANIF</a>
        </div>
        
        <!-- Right side: Federation Logos -->
        <div class="navbar-right">
            <div class="fed-logo"><img src="{{ asset('img/forki.png') }}" alt="FORKI"></div>
            <div class="fed-logo"><img src="{{ asset('img/ksk.png') }}" alt="Kei Shin Kan"></div>
            <div class="fed-logo"><img src="{{ asset('img/dojo.png') }}" alt="Dojo Al Hanif" style="transform: scale(1.25);"></div>
        </div>
    </div>
</nav>

<!-- Sidebar Menu Modal -->
<div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebarMenu()"></div>
<div id="sidebarMenu" class="sidebar-menu">
    <div class="sidebar-header">
        <h3 style="color: #b31b1b; margin: 0; font-family: 'Montserrat', sans-serif;">MENU</h3>
        <button class="close-sidebar-btn" onclick="toggleSidebarMenu()"><i class="fas fa-times"></i></button>
    </div>
    <div class="sidebar-content">
        <a href="/" class="sidebar-link"><i class="fas fa-home"></i> Beranda</a>
        <a href="/profil-anggota" class="sidebar-link"><i class="fas fa-users"></i> Profil Anggota</a>
        <a href="/daftar" class="sidebar-link"><i class="fas fa-user-plus"></i> Pendaftaran Online</a>
        @auth
            <a href="/dashboard" class="sidebar-link"><i class="fas fa-columns"></i> Dashboard Admin</a>
        @endauth
    </div>
</div>

<style>
    /* Sidebar CSS */
    .sidebar-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1050;
        display: none;
        backdrop-filter: blur(2px);
    }
    .sidebar-overlay.active {
        display: block;
    }
    .sidebar-menu {
        position: fixed;
        top: -500px; 
        left: 20px; 
        width: calc(100% - 40px);
        max-width: 320px; 
        height: auto;
        background: #fff;
        z-index: 1100;
        transition: top 0.4s ease-in-out;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .sidebar-menu.active {
        top: 85px;
    }
    .sidebar-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }
    .close-sidebar-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #333;
        cursor: pointer;
    }
    .sidebar-content {
        padding: 20px 0;
        display: flex;
        flex-direction: column;
    }
    .sidebar-link {
        padding: 15px 25px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        transition: background 0.2s;
    }
    .sidebar-link i {
        width: 30px;
        color: #b31b1b;
    }
    .sidebar-link:hover {
        background: #f8f9fa;
        color: #b31b1b;
    }
</style>

<script>
    function toggleSidebarMenu() {
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (sidebar && overlay) {
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            } else {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            }
        }
    }
</script>
