@component('mail::message')
# Payement de la Facture D'un Montant de {{  $commande->pt }}
## le {{ $commande->date_commande }}

Hello cher client(e)
<br>
nous Vous remercions pour l'achat des produits que vous avez effectuer sur notre plateforme
par <strong>{{ $commande->mode_paiement }}</strong>

@component('mail::button', ['url' => "{{ $stream }}"])
    Telecharger Sa Facture
@endcomponent

@component("mail::subcopy")
    by AbdoulCadri
@endcomponent

Nous VOus Remercions,<br>
{{ config('app.name') }}
@endcomponent
