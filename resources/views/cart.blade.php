@extends('template')

@section('main')
    <h2>Votre Panier</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <td>#</td>
            <td>Nom du Produit</td>
            <td>Quantite</td>
            <td>Prix Unitaire</td>
            <td>Prix Total</td>
            <td>Images </td>
            <td>Actions</td>

        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->nom }}</td>
                    <td>{{ $item->qte }}</td>
                    <td>{{ $item->pu }}</td>
                    <td>{{ $item->pt }}</td>
                    <td> <img src="{{ asset('storage/' . $item->img1) }}" class="img img-thumbnail img-fluid" width="200">
                    </td>
                    <td>
                        <form action="{{ route('produit.cart.delete', ['id' => $item->id]) }}" method="post"> @csrf <button
                                type="submit" class="btn btn-danger">Delete</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>

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
