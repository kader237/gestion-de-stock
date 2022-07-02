@extends('template')

@section('main')
    <h2>Votre Panier</h2>

        <div class="row">
            @foreach ($items as $item)
                <div class="col col-4">
                    <div class="card ">
                        <div class="card-header">
                           <span class="badge bg-dark"> #{{ $loop->index + 1 }}</span>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $item->img1) }}" class="img-card img-fluid " width="100" style="max-width: 200px">
                        <div>
                            <span class="badge bg-info"> Nom: {{ $item->nom }}</span>
                        <span class="badge bg-dark" >Quantite: {{ $item->qte }}</span>
                        <span class="badge bg-dark" >Prix Unitaire: {{ $item->pu }}</span>
                        <span class="badge bg-dark">Prix a payer: {{ $item->pt }}</span>
                        </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('produit.cart.delete', ['id' => $item->id]) }}" method="post"> @csrf <button
                                    type="submit" class="btn btn-danger">Delete</button></form>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>

    <hr>
    <div>
        <div class="jumbottorn">
            <h5 class="text-muted">Paiement</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Proceder au paiement
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Formulaire pour payer les produits
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body w-100">
                            <div>

                                <label for="">Mode de paiement</label>
                                <select name="mode_paiement" class="form-select" id="">
                                    <option value="orange_money">Orange Money</option>
                                    <option value="mtn_money">MTN Mobile Money</option>
                                    <option value="cash">Cache</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <label class="control-label">Nombre de produit commander</label>
                                <input type="text" class="form-control" readonly value="{{ count(array_keys(session("cart"))) }}">

                            </div>
                            <br>
                            <div>
                                <label class="control-label">Prix Total a payer</label>
                                <input type="text" class="form-control" readonly value="{{ $pt }} FCFA">
                                <br><br>
                                <a href="#" class="btn btn-success">Imprimer la facture</a>
                            </div>
                        </div>
                </div>

                </form>
            </div>
        </div>

    </div>
@endsection
