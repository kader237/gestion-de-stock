@extends("admin.template")

@section("main")
    <form action="{{route("admin.admin.store")}}" class="border px-4 mt-2 pb-2" enctype="multipart/form-data" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
            </div>
        @endif
        <div class="my-4">
            <label for="nom">Selectionner le client qui doit devenir administrateur </label>
            <select name="user_id" id="user_id" class="form-select">
                @foreach ($user as $item )
                <option value="{{$item->id}}"> <span class="badge bg-dark p-2"> {{ $item->name." ".$item->prenom }}</span> ({{ $item->email }}) </option>
                @endforeach
            </select>
        </div>

        <div class="my-4">
            <label for="quantite">Type de comptes  </label>
            <select name="type" id="type" class="form-select">
                <option value="chef">Chef</option>
                <option value="admin">Administrateur</option>
                <option value="magasinier">Magasinier</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Creer</button>
    </form>
@endsection
