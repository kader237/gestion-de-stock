@extends("admin.template")

@section("main")
    <h3>Enregistrez une entrees</h3>
    <hr>
    <form action="{{ route("admin.entres.store") }}" class="border bg-gradient p-4 shadow" method="POST">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
                <div>
                    {{ $error }}</div>
            @endforeach

        </div>
        @endif
        @csrf
        <div class="my-4">
            <label for="Nom du produit" class="form-label">Nom Du Produit (quantite)</label>
            <select name="produit_id" id="produit_id" class="form-select">
                @foreach ($produit as $item)
                    <option value="{{ $item->id }}">{{ $item->nom }} (  {{ $item->quantite }} ) </option>
                @endforeach
            </select>
        </div>

        <div class="my-4">
            <label for="quantite">Quantite</label>
            <input type="number" class="form-control" placeholder="Quantite" name="quantite">
        </div>

        <button type="submit" class="btn btn-success">Enregistrez</button>
    </form>
@endsection
