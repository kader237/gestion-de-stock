<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Facture de {{ auth()->user()->name }}</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        main{
            padding-top: 20px;
            height: 90%;
            background: #ccc;
            width: 100%;
            line-height: 40px;
        }
        main table{
            margin: 4px auto;
            width: 80%;
        }
        main table th{
            font-weight: bold;
        }
        caption{
            text-decoration: underline;
            font-family: cursive;
            font-weight: bold;
            size: 14px;
            margin-bottom: 10px;
        }
         th,td {
            text-align: center;
            padding: 2px;
           border: 1px solid black;
            border-collapse: collapse;
        }
        .info{
            width: 50%;
            border: 2px solid black;
            margin: auto;
            padding: 4px 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <div class="info">
            Nom Du Proprietaire : {{ auth()->user()->name . ' ' . auth()->user()->prenom }}
        <p>
            Date de l'achat : {{ $commande->date_commande }}
        </p>

        <p>
            Mode de Payement : {{ $commande->mode_paiement }}
        </p>

        @if (isset($commande->numero))
            <p>
                Numero de paiement : {{ $commande->numero }}
            </p>
        @endif
        <h3>Prix Total : {{ $commande->pt }}</h3>

        </div>
        <table >
            <caption>Listes des produits commander</caption>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom </th>
                    <th>Prix Unitaire</th>
                    <th>
                        Quantite
                    </th>
                    <th>
                        Prix Total
                    </th>
                </tr>
            <tbody>
                @foreach ($commande->produits as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->nom }}</td>
                        <td>{{ $item->prix }}</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ $item->pt }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <hr>
            </tfoot>
            </thead>
        </table>
        </p>
        <hr>
        <p>
            <em>nous vous remercions</em>
        </p>
    </main>
</body>

</html>
