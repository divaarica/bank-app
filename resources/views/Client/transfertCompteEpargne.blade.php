@extends('layoutAdmin')
@section('sidebar')

<!-- changer en clients.edit avec l'id du client -->
<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('clients.index')}}">
        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
    </a>
</li>

<li class="sidebar-header">
    Mes Comptes(s)
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.compteCourant')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Compte Courant<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.compteEpargne')}}">
        <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Compte Epargne<span>
    </a>
</li>

<li class="sidebar-header">
    Transactions
</li>

<li class="sidebar-item active">
    <a class="sidebar-link" href="{{route('transactions.choixTransfert')}}">
        <i class="align-middle fa fa-users"></i><span class="align-middle">Tranfert</span>
    </a>
</li>



<!-- <li class="sidebar-item ">
	<a class="sidebar-link" href="{{route('clients.index')}}">
		<i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Contacts Favoris<span>
	</a>
</li> -->

<li class="sidebar-header">
    Carte(s)
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.cartes')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Generer une cartes<span>
                <!-- mettre un bouton pour fire un depot sur un comtpte et bouton retrait et bouton suuprimer -->
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.mesCartes')}}">
        <i class="align-middle fa fa-money"></i> <span class="align-middle">Mes cartes<span>
                <!-- faire le stps, genre etapes, il choisis d'abord le type de comte ensuite le client et
			si le client n'a pas encore se type de compte on continue la creation
		 -->
    </a>
</li>

<br><br><br>
@endsection
@section('content')

<main class="content">
    <div class="container-fluid p-0">

        @if($ifCompteCourant)
        @if($ifCompteEpargne)
        <h1 class="h3 mb-3"><strong>Tranfert</strong> D'argent</h1>
        <br><br>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        <br><br>
        @endif
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; ">
            <i class="fa fa-user" style="font-size: 60px; margin-bottom: 20px;"></i>
            <form action="{{ route('transactions.doTransfertEpargne', [ 'compteEpargne' => $compteEpargne ->id,  'compteCourant' =>$compteCourant ->id ]) }}" method="post" style="display: flex; flex-direction: column; align-items: center;">
                @csrf
                @method('PUT')
                <label for="account_number" style="margin-bottom: 10px;">Veuillez le numéro Montant a transferer </label>
                <br>
                <input type="text" id="montantDepot" name="montantDepot" required style="width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;">
                @error('montantDepot')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <br>
                <button type="submit" class="btn btn-sm btn-primary" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Valider</button>
            </form>
        </div>
        @else
        <h1>Vous n'avez pas de compte Epargne</h1>
        @endif
        @else
        <h1>Vous n'avez pas de comptes Courant</h1>
        @endif

</main>


@endsection