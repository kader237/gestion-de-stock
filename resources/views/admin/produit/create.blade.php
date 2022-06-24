@extends("admin.template")

@section("main")
    <form action="{{route("admin.produit.store")}}" class="border px-4 mt-2 pb-2" enctype="multipart/form-data" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
            </div>
        @endif
        <div class="my-4">
            <label for="nom">Nom du produit </label>
            <input type="text" class="form-control" name="nom" placeholder="entrez le nom du produit">
        </div>
        <div class="my-4">
            <label for="quantite">Quantite du produit </label>
            <input type="number" class="form-control" name="quantite" placeholder="entrez la quantite du produit">
        </div>
        <div class="my-4">
            <label for="prix">Prix du produit </label>
            <input type="text" class="form-control" name="prix" placeholder="entrez le prix du produit">
        </div>
        <div class="my-4">
            <label for="nom">Image du produit </label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="my-4">
            <label for="nom">Deuxieme Image du  produit </label>
            <input type="file" name="image1" class="form-control" placeholder="entrez le nom du produit">
        </div>
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
@endsection
