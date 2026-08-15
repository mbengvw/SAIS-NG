document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const mainWrapper = document.querySelector(".main-wrapper");
    const overlay = document.getElementById("sidebarOverlay");

    // ── Sidebar mobile: open/close ───────────────────────────
    const toggleBtn = document.getElementById("sidebarToggle");

    function isMobile() {
        return window.innerWidth < 992;
    }

    function openMobileSidebar() {
        if(sidebar) sidebar.classList.add("open");
        if(overlay) overlay.classList.add("show");
        document.body.style.overflow = "hidden";
    }
    
    function closeMobileSidebar() {
        if(sidebar) sidebar.classList.remove("open");
        if(overlay) overlay.classList.remove("show");
        document.body.style.overflow = "";
    }

    if(toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            if (isMobile()) {
                sidebar && sidebar.classList.contains("open")
                    ? closeMobileSidebar()
                    : openMobileSidebar();
            } else {
                // Desktop: toggle collapse via topbar hamburger
                toggleCollapse();
            }
        });
    }

    if(overlay) overlay.addEventListener("click", closeMobileSidebar);
    
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeMobileSidebar();
    });

    // ── Sidebar desktop: collapse ────────────────────────────
    const collapseBtn = document.getElementById("sidebarCollapseBtn");
    const collapseIcon = document.getElementById("collapseIcon");
    const STORAGE_KEY = "sidebar_collapsed";

    function applyCollapsed(collapsed) {
        if (collapsed) {
            if(sidebar) sidebar.classList.add("collapsed");
            if(mainWrapper) mainWrapper.classList.add("sidebar-collapsed");
            if(collapseIcon) {
                collapseIcon.classList.remove("fa-angle-left");
                collapseIcon.classList.add("fa-angle-right");
            }
        } else {
            if(sidebar) sidebar.classList.remove("collapsed");
            if(mainWrapper) mainWrapper.classList.remove("sidebar-collapsed");
            if(collapseIcon) {
                collapseIcon.classList.remove("fa-angle-right");
                collapseIcon.classList.add("fa-angle-left");
            }
        }
    }

    function toggleCollapse() {
        const isCollapsed = sidebar && sidebar.classList.contains("collapsed");
        const next = !isCollapsed;
        applyCollapsed(next);
        localStorage.setItem(STORAGE_KEY, next ? "1" : "0");
    }

    if(collapseBtn) collapseBtn.addEventListener("click", toggleCollapse);

    // Restore state on load (desktop only)
    if (!isMobile() && localStorage.getItem(STORAGE_KEY) === "1") {
        applyCollapsed(true);
    }

    // Reset on resize to mobile
    window.addEventListener("resize", () => {
        if (isMobile()) {
            if(sidebar) sidebar.classList.remove("collapsed");
            if(mainWrapper) mainWrapper.classList.remove("sidebar-collapsed");
        } else {
            closeMobileSidebar();
            if (localStorage.getItem(STORAGE_KEY) === "1") applyCollapsed(true);
        }
    });
});
