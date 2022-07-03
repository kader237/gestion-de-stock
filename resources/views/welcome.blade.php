@extends("template")

@section("main")
    <section class="w-25 mt-10">
        @if ( session()->has("message"))
        <div class=" fixed-bottom  fixed alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @foreach (session()->get("message") as $msg )
                <div>
                    {{ $msg }}
                </div>
            @endforeach
          </div>
        @else

        @endif
    </section>
@endsection
