
<div class="container pt-3 px-2">
<nav class="navbar">
    <div class="container-fluid">
        <ul class="nav nav-pills ml-auto">
           <a class="nav-link mx-2 border-white border <?php echo ($_SERVER['REQUEST_URI'] != '/'      ) ? "text-white" : "active bg-white text-black";?>" href="./">Přehled kvízů</a>
           <a class="nav-link mx-2 border-white border <?php echo ($_SERVER['REQUEST_URI'] != '/about' ) ? "text-white" : "active bg-white text-black";?>" href="./about">Informace o stránce</a>
        </ul>

        <div class="nav nav-pills justify-content-end">
            <div class="nav-item dropdown">
                <button class="btn btn-link nav-link dropdown-toggle text-white border-white border" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i> <span>Účet<span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li><a class="dropdown-item" href="./homepage">Váš účet</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./login">Přihlášení</a></li>
                    <li><a class="dropdown-item" href="./register">Registrace</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./">Odhlášení</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
</div>
<hr>