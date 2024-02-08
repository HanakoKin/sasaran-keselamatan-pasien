<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">SKP RS Husada</a>
    <div class="d-flex align-items-end me-3">
        <a class="d-flex align-items-center text-white text-decoration-none" href="/logout"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right mb-1"></i>
            <span class="ms-2">Sign Out</span>
        </a>
        <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</header>
