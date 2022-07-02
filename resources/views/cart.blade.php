@extends('template')

@section('main')
    <h2>Votre Panier </h2>

    <div id="app">
        @verbatim
            {{ msg }}
        @endverbatim
        <div class="row">
            @foreach ($items as $item)
                <div class="col col-4">
                    <div class="card ">
                        <div class="card-header">
                            <span class="badge bg-dark"> #{{ $loop->index + 1 }}</span>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $item->img1) }}" class="img-card img-fluid " width="100"
                                style="max-width: 200px">
                            <div>
                                <span class="badge bg-info"> Nom: {{ $item->nom }}</span>
                                <span class="badge bg-dark">Quantite: {{ $item->qte }}</span>
                                <span class="badge bg-dark">Prix Unitaire: {{ $item->pu }}</span>
                                <span class="badge bg-dark">Prix a payer: {{ $item->pt }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('produit.cart.delete', ['id' => $item->id]) }}" method="post"> @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
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
                        <form method="POST" action="{{ route('produit.buy') }}">
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
                                    <label for="mode_payement" class="form-label mb-2">Mode de paiement : <span
                                            class="badge bg-dark p-1"> @{{ item }} </span> </label>
                                    <select name="mode_paiement" v-model="item" class="form-select" id="mode_payement">
                                        <option value="orange money">Orange Money</option>
                                        <option value="mtn money">MTN Mobile Money</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <br>
                                <Transition name="slide-fade">
                                    <div class="mb-2" v-if="showableNumberMoney">
                                        <label for="number_money" class="form-label">Votre Numero Mobile money</label>
                                        <input type="tel" name="number_money" class="form-control">
                                    </div>
                                </Transition>
                                <div>
                                    <label class="control-label">Nombre de produit commander</label>
                                    <input type="text" name="nombre_produit" class="form-control" readonly
                                        value="{{ count(array_keys(session('cart'))) }}">

                                </div>
                                <br>
                                <div>
                                    <label class="control-label">Prix Total a payer</label>
                                    <input type="text" name="prix_total" class="form-control" readonly
                                        value="{{ $pt }} FCFA">
                                    <br><br>
                                    <button type="submit" class="btn btn-success">payer la facture</button>
                                </div>
                            </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('styles')
        <style>
            .slide-fade-enter-active {
                transition: all 0.3s ease-out;
            }

            .slide-fade-leave-active {
                transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
            }

            .slide-fade-enter-from,
            .slide-fade-leave-to {
                transform: translateX(20px);
                opacity: 0;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @endpush
    @push('scripts')
        <script>
            const vm = new Vue({
                el: "#app",
                data() {
                    return {
                        showableNumberMoney: false,
                        msg: "dede",
                        items: [
                            "Orange Money",
                            "Mtn Money",
                            "Cash"
                        ],
                        item: null,
                    }
                },
                mounted() {},
                watch: {
                    item(elt) {
                        if (elt == "orange money" || elt == "mtn money") {
                            this.showableNumberMoney = true
                        } else {
                            this.showableNumberMoney = false

                        }
                    }
                }
            })
        </script>
    @endpush
@endsection
