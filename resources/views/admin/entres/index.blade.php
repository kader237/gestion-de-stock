@extends("admin.template")

@section("main")
    <h2 class="text-center">Listes des entres</h2>
    <hr>
    @if (!auth()->user()->isChef())

    <div class="text-right mb-3">
        <a href="{{ route("admin.entres.create") }}" class="btn btn-success">Enregistrer une entree</a>
    </div>
    @endif
    <div class="table-responsive  clearfix">
        <table class="table table-active table-bordered table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom DU produit</th>
                    <th>Date de l'entres</th>
                    <th>Enregistrer Par</th>
                    <th>Quantite Ajoute</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entres as $item )
                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $item->produit->nom }}</td>
                        <td>{{ $item->created_at->DiffForHumans() }}</td>
                        <td><span class="badge bg-danger">{{ $item->personnel->user->name }} ({{ $item->personnel->user->email }})</span> </td>
                        <td>{{ $item->quantite }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
