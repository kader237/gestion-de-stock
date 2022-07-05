<div class="d-flex flex-col gap-5">
    <div class="card">
        <div class="card-header">Control des Utilisateurs</div>
        <div class="card-body">
            <a href="{{ route("admin.client.index") }}" class="btn btn-block btn-outline-primary">Visuiliser</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Control des Produits</div>
        <div class="card-body">
            <a href="{{ route("admin.produit.index") }}" class="btn btn-block btn-outline-secondary">Visuiliser</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Controles des Entres</div>
        <div class="card-body">
            <a href="{{ route("admin.entres.index") }}" class="btn btn-block btn-outline-success">Visuiliser</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Controles des Sorties
        </div>
        <div class="card-body">
            <a href="{{ route("admin.sorties.index") }}" class="btn btn-block btn-outline-danger">Visuiliser</a>
        </div>
    </div>

</div>
<hr>
