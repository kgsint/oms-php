<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <div class="flex-fill"></div>

    <navbar class="nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle = "dropdown">
                <i class="fas fa-user-circle"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" class="dropdown-item">Profile</a>
                </li>
                <li>
                    <button form="logout-form" class="dropdown-item">Logout</button>
                </li>

                <form action="/logout" method="POST" id="logout-form"></form>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class=" nav-link">
                <i class="fas fa-cog"></i>
            </a>
        </li>
    </navbar>
   </nav>