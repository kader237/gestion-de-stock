@extends("template")

@section("main")

        @if (auth()->user()->isAdminExist())
        <h2 class="text-right label bg-error p-4">
            Vous etes connecter en tant que <b class="badge bg-dark text-uppercase p-2"> {{ auth()->user()->admin->type }} </b>
        </h2>

        <hr>
        @includeWhen(auth()->user()->isAdmin(), 'partials.dashboard.admin', ['some' => 'data'])
        @includeWhen(auth()->user()->isMagasinier(), 'partials.dashboard.magasinier', ['some' => 'data'])
        @includeWhen(auth()->user()->isChef(), 'partials.dashboard.chef', ['some' => 'data'])
    @else
        @includeIf('partials.dashboard.default', ['some' => 'data'])
    @endif

@endsection
