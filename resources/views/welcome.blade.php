@extends("template")

@section("main")
    <section class="w-25 mt-10">
        @if ( session()->has("message"))
        <div class=" fixed-bottom  fixed alert alert-info alert-dismissible fade show" role="alert">
            {{ session("message") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @else

        @endif
    </section>
@endsection
