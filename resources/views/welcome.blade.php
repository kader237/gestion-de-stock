@extends('template')

@section('main')
        <div class="cover-container d-flex  h-100 p-3 mx-auto flex-column">
            @if (session()->has('message'))
            <section class="w-25 mt-10">
                <div class=" fixed-bottom  fixed alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach (session()->get('message') as $msg)
                        <div>
                            {{ $msg }}
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <main role="main" class="inner cover">
                <h1 class="cover-heading">Application de Gestion de Stock.</h1>
                <p class="lead">Bienvenue sur notre application qui permet de gerer les stock <br> et d'effectuer une commande en local</p>
                <p class="lead">
                    <a href="#" class="btn btn-lg btn-secondary">Gstock</a>
                </p>
            </main>

            <footer class="mastfoot mt-auto">
                <div class="inner">
                    <p>Designed by <a href="https://getbootstrap.com/">abdoul</a></p>
                </div>
            </footer>
        </div>
@endsection

@push("styles")
    <style>
        /*
 * Globals
 */

/* Links */
a,
a:focus,
a:hover {
  color: #fff;
}

/* Custom default button */
.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus {
  color: #333;
  text-shadow: none; /* Prevent inheritance from `body` */
  background-color: #fff;
  border: .05rem solid #fff;
}


/*
 * Base structure
 */

html,
body {
  height: 100%;
  background-color: #333;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-pack: center;
  -webkit-box-pack: center;
  justify-content: center;
  color: #fff;
  text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
  box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
}

.cover-container {
    max-width: 42em;
}

#navbar{
    background-color: rgba(0,0,100,.6) !important;
}
#main-container{
background-repeat: no-repeat;
    background-size: contain;
    background-origin: center center;
    background-position: center center;
    background-image: url("/cover.jpg");

}
/*
 * Header
 */
.masthead {
  margin-bottom: 2rem;
}

.masthead-brand {
  margin-bottom: 0;
}

.nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
  color: rgba(255, 255, 255, .5);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(255, 255, 255, .25);
}
main{
    margin-top: 20px;
    text-shadow: 1px 1px 4px #ccc;
    line-height: 50px;
}
.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-masthead .active {
  color: #fff;
  border-bottom-color: #fff;
}

@media (min-width: 48em) {
  .masthead-brand {
    float: left;
  }
  .nav-masthead {
    float: right;
  }
}


/*
 * Cover
 */
.cover {
  padding: 0 1.5rem;
}
.cover .btn-lg {
  padding: .75rem 1.25rem;
  font-weight: 700;
}


/*
 * Footer
 */
.mastfoot {
  color: rgba(255, 255, 255, .5);
}
    </style>

@endpush
