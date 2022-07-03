@component('mail::message')
# Payement de la Facture D'un Montant de {{  $commande->pt }}
## le {{ $commande->date_commande }}

Hello cher client(e)
<br>
nous Vous remercions pour l'achat des produits que vous avez effectuer sur notre plateforme
par <strong>{{ $commande->mode_paiement }}</strong>

@component('mail::button', ['url' => "{{ $stream }}"])
    Recevoir sa facture
@endcomponent

@component("mail::subcopy")
    by AbdoulCadri
@endcomponent

Nous Vous Remercions, et vous shouhaitons bonne continuations<br>
{{ config('app.name') }}
@endcomponent
