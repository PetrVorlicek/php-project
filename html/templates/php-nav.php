<div class="container pt-5">
    <nav>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a href="/" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/') echo "active"; ?>" >Úvod</a></li>
            <li class="nav-item"><a href="/about" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/about') echo "active"; ?>">O nás</a></li>
            <li class="nav-item"><a href="/register" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/register') echo "active"; ?>">Registrace</a></li>
            <li class="nav-item"><a href="/login" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/login') echo "active"; ?>">Login</a></li>
        </ul>
    </nav>
</div>