@extends("admin.template")

@section("main")
    <form action="{{route("admin.client.update",["id"=>$user->id])}}" class="border px-4 mt-2 pb-2" enctype="multipart/form-data" method="post">
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
            <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="entrez le nouveau nom">
        </div>
        <div class="my-4">
            <label for="prenom">Prenom </label>
            <input type="text" class="form-control" name="prenom" value="{{ $user->prenom }}" placeholder="entrer nouveau prenom">
        </div>
        <div class="my-4">
            <label for="prenom">Numero de Telephone </label>
            <input type="tel" class="form-control" name="tel" value="{{ $user->tel }}" placeholder="entrer nouveau numero">
        </div>
        <div class="my-4">
            <label for="prix">VillE </label>
            <input type="text" class="form-control" name="ville" value="{{ $user->ville }}" placeholder="entrez la nouvelle ville">
        </div>
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
@endsection
