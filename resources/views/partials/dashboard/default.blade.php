<h5 class="mt-1 text-decoration-underline  text-muted text-center text-uppercase font-weight-bold">
    Votre Dashboard
</h5>

<div class="d-flex">
    <div class="card">
        <div class="card-header">
            Vos Informations :
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Nom : {{ auth()->user()->name }}
                </p>
                <p>
                    Ville : {{ auth()->user()->ville }}
                </p>
                <p>
                    Numero de Telephone : {{ auth()->user()->tel }}
                </p>
                <p>
                    Comptes cree le : {{ auth()->user()->created_at }}
                </p>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="d-flex">

    <div class="card">
        <div class="card-header">
            Vos Statistiques
        </div>
        <div class="card-body">
            <p>
                Nombres de produits Total Commander : <span class="p-2 badge bg-dark">{{ $data->nb_commandes }}</span>
            </p>
            <p>
                Prix Total depense: <span class="badge bg-dark p-2">{{ $data->total_price }}</span>
            </p>
            <p>

            </p>
        </div>
    </div>
</div>
<hr>
<canvas id="myChart"></canvas>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
        integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script>
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        async function getData() {
            try {
                const response = await axios.get("/api/commande/1/stat", {
                    params: {
                        user_id: 1
                    }
                })
                console.log(response)
            } catch (error) {
                console.error(error)
            }
        }
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre',
                    'Octobre', 'Novembre', 'Decembre'
                ],
                datasets: [{
                    label: 'Total depense',
                    data: {{ (json_encode(array_values($tab_month))) }},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
        });
    </script>
@endpush
