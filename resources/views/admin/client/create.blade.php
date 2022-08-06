@extends("admin.template")

@section("main")
    <form action="{{route("admin.client.store")}}" class="border px-4 mt-2 pb-2" enctype="multipart/form-data" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
            </div>
        @endif
        <div class="my-4">
            <label for="nom">Nom du Client </label>
            <input type="text" class="form-control" name="nom" placeholder="entrez le nom du produit">
        </div>
        <div class="my-4">
            <label for="quantite">Prenom </label>
            <input type="number" class="form-control" name="quantite" placeholder="entrez la quantite du produit">
        </div>
        <div class="my-4">
            <label for="prix">VILLE </label>
            <input type="text" class="form-control" name="prix" placeholder="entrez le prix du produit">
        </div>
        <div class="my-4">
            <label for="nom">Email </label>
            <input type="email" class="form-control" name="image">
        </div>

        <div class="my-4">
            <label for="nom">Password </label>
            <input type="file" name="password" class="form-control" placeholder="entrez le nom du produit">
        </div>
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
@endsection
