@extends("admin.template")

@section("main")
    <h2 class="text-center">Listes des sorties</h2>
    <hr>
    <div class="text-right mb-3">
        @if (!auth()->user()->isChef())

        <a href="{{ route("admin.sorties.create") }}" class="btn btn-success">Enregistrer une Sorties</a>
                @endif
    </div>
    <div class="table-responsive  clearfix">
        <table class="table table-active table-bordered table-hover">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom Du produit</th>
                    <th>Date de la sortie</th>
                    <th>Enregistrer Par</th>
                    <th>Quantite Ajoute</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sorties as $item )
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
