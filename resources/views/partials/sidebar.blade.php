<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">SHop Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2 "><a class="nav-link @if (Route::is("home"))
                    active border rounded
                @endif " aria-current="page" href="{{ route("home") }}">Acceuil</a></li>
                <li class="mx-2 nav-item @if(Route::is('produit.index')) active border @endif "><a class="nav-link" href="{{route('produit.index')}}">Produit</a></li>
                <li class="mx-2 nav-item @if(Route::is('produit.cart.*')) active border @endif "><a class="nav-link" href="{{route('produit.cart.index')}}">Panier</a></li>

                <li class="mx-2 nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Comptes</a>
                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                        <li>
                            @auth
                            <form method="post" action="{{ route("logout") }}" class="text-center" >
                                @csrf
                                <button class="btn btn-danger " type="submit">Se deconnecter</button>
                            </form>
                            @endauth
                            @guest
                                <a href="{{ route("register") }}" class="btn btn-info mb-4 w-75 mx-auto">S'inscrire</a>
                                <a href="{{ route("login") }}" class="btn btn-success w-75" type="submit">Se connecter</a>
                            @endguest
                    </li>

                    </ul>
                </li>
                <li class="nav-item @if(Route::is('dashboard')) active border @endif"><a class="nav-link" href="{{ route("dashboard") }}">Dashboard</a></li>
            </ul>
        </div>
    </div>
</nav>
