<div id="app">
    <div class="row no-gutters">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Gestion Des Clients
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <a href="{{ route("admin.client.index") }}" class="btn btn-primary">Gere Les clients</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Gestion des Produits
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <a href="{{ route("admin.produit.index") }}" class=" btn-success btn block btn-block">Gerer les produits</a>
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @endpush
    @push('scripts')
        <script>
            const vm = new Vue({
                el: "#app",
                data:{
                    client:{
                        items:[
                            {
                                text:"Ajouter",
                                class:"btn-success"
                            },
                            {
                                text:"modifier",
                                class:"btn-info"
                            }
                        ]
                    },
                    msg: "dede",
                },
                mounted() {},

            })
        </script>
    @endpush
