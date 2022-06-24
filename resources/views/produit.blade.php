@extends('template')

@section('main')
    <h2 class="text-center text-uppercase bg-white text-dark">Listes de Nos produits</h2>
    <div class="row">

        @foreach ($produit as $item)
            <div class="col col-lg-4">
                <div class="card">
                    <div class=" d-flex justify-content-between card-header">
                        <span>{{ $item->nom }}</span>
                        <span class="badge bg-success"> {{ $item->prix }} FCFA </span>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $item->image) }}" class="img card-img img-fluid" alt="">
                    </div>
                    <div class="card-footer">
                        <p>

                            Quantite Disponible: <em class="badge bg-dark">{{ $item->quantite }}</em>
                        </p>
                        <p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item->id }}">
                                Commander
                            </button>
                            <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route("produit.commander",["id"=>$item->id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Produit  a commander : <span class="badge bg-dark"> {{ $item->nom }} </span></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="">
                                                <label for="nb_produit" class="control-label">Quantite du Produit </label>
                                                <input max="{{ $item->quantite-1 }}" name="quantite" required min="1" step="1" maxlength="{{ $item->quantite-1 }}" size="1" type="number" data-price="{{ $item->prix }}" value="1" class="pu form-control">
                                            </div>
                                            <div class="mt-2">
                                                <label for="pu">Prix Unitaire</label>
                                                <input type="text" readonly value="{{ $item->prix }}" class="form-control">

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">fermer</button>
                                            <button type="submit" class="btn btn-primary" >Valider</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        </p>

                    </div>
                    <!-- Button trigger modal -->


                </div>
            </div>
        @endforeach
    </div>
@endsection

