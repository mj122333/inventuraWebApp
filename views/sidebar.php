<div class="d-lg-flex d-none flex-column flex-shrink-0 text-black border-end border-1" id="sidebar" style="width: 200px;">
    <div class="p-3">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-black text-decoration-none">
            <span class="fs-4 text-main fw-bold"><?= translate_route($route) ?></span>
        </a>
        <hr>
    </div>

    <style>
        /* ul li:hover {
            background-color: #FFF7F0;
        } */
    </style>

    <ul class="nav flex-column mb-auto fw-bold">
        <li class="nav-item">
            <a href="<?php echo DS . APPFOLDER . DS ?>" class="<?php echo $route == "home" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                <i class="bi bi-house"></i>
                Početna
            </a>
        </li>
        
        <li class="nav-item">
            <a href="<?php echo DS . APPFOLDER . DS ?>profile" class="<?php echo $route == "profile" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                <i class="bi bi-person"></i>
                Profil
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo DS . APPFOLDER . DS ?>scan" class="<?php echo $route == "scan" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                <i class="bi bi-upc-scan"></i>
                Sken
            </a>
        </li>

        <?php if ($_SESSION["role"] == "admin") { ?>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija" class="<?php echo $sub_route == "evidencija" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-check-circle"></i>
                    Evidencija
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice" class="<?php echo $sub_route == "ucionice" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-book"></i>
                    Učionice i tipovi
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/profesori" class="<?php echo $sub_route == "profesori" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-people"></i>
                    Profesori
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/proizvodi" class="<?php echo $sub_route == "proizvodi" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-box-seam"></i>
                    Proizvodi
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/usporedba" class="<?php echo $sub_route == "usporedba" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-arrow-left-right"></i>
                    Usporedba
                </a>
            </li>

            <li>
                <a href="<?php echo DS . APPFOLDER . DS ?>admin/stanje" class="<?php echo $sub_route == "stanje" ? "bg-secondary border-right-primary text-primary" : "text-muted"  ?> nav-link sidebar-link">
                    <i class="bi bi-database-check"></i>
                    Stanje
                </a>
            </li>


        <?php } ?>
    </ul>



    <di class="p-3">
        <hr>
        <div>
            <strong class="text-main"><?= $_SESSION["username"] ?></strong>
        </div>

        <div class="d-flex">
            <i id="lightIcon" class="bi bi-sun-fill pe-2 text-primary"></i>
            <div class="form-check form-switch">
                <input id="themeButton" onchange="toggleTheme()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            </div>
            <i id="darkIcon" class="bi bi-moon-fill"></i>
        </div>
    </di>



    <script>
        $(document).ready(function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme == "dark") {
                $('#themeButton').prop('checked', initialTheme === 'dark');
                $(".darkTableToggle").addClass("table-dark");

                $("#lightIcon").removeClass("text-primary");
                $("#darkIcon").addClass("text-primary");
            }
        });

        function toggleTheme() {
            if ($("#themeButton").is(":checked")) {
                // dark theme
                $("body").attr('data-bs-theme', 'dark');
                $(".darkTableToggle").addClass("table-dark");

                $("#lightIcon").removeClass("text-primary");
                $("#darkIcon").addClass("text-primary");

                localStorage.setItem('theme', "dark");
            } else {
                // light theme
                $("body").attr('data-bs-theme', 'light');
                $(".darkTableToggle").removeClass("table-dark");

                $("#darkIcon").removeClass("text-primary");
                $("#lightIcon").addClass("text-primary");

                localStorage.setItem('theme', "light");
            }

        }
    </script>
</div>