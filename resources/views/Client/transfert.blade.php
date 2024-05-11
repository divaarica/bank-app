@extends('layoutAdmin')
@section('asset')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="{{ asset('Admin/css/form.css') }}" rel="stylesheet">
@endsection
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
    <a class="sidebar-link" href="{{ route('client.mesCartes') }}">

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

    <a href="" type="button" class="btn btn btn-danger ms-3 text-light" style="font-size: 17px;"> <i class="fa fa-arrow-left"></i> Retour</a>
    <br>
    <br>
    <div class="containerxd">
        <header>Faire un depot</header>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        <br><br>
        @endif
        <form action="{{ route('transactions.dotransfertClient', ['clt1' => $client1->id, 'clt2' => $client2->id,'cpt1' => $compte1 ->id , 'cpt2' => $compte2 -> id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form first">
                <div class="details personal">
                    <span class="title">Details Comptes</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="numeroCompte">Numéro du compte de l'expediteur :</label>
                            <input type="text" class="form-control" id="numeroCompte" name="numeroCompte" value="{{ $compte1 -> numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="numeroClient">Numéro client expediteur:</label>
                            <input type="text" class="form-control" id="numeroClient" name="numeroClient" value="{{ $client1 -> numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="nomClient">Nom Client expediteur :</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" value="{{ $client1 -> nom }} {{ $client1 -> prenom }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="codeTransaction">Numéro compte destinataire :</label>
                            <input type="text" class="form-control" id="typeCompte" name="typeCompte" value="{{ $compte2 -> numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="nomClient">Numéro du client destinataire</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" value="{{ $client2 -> numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="nomClient">Nom Client destinataire :</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" value="{{ $client2 -> nom }} {{ $client2 -> prenom }}" readonly>
                        </div>


                    </div>
                </div>
                <div class="details personal">
                    <span class="title">Autres details</span>
                    <div class="input-field">
                        <label for="codeTransaction">Code de la future transaction :</label>
                        <input type="text" class="form-control" id="codeTransaction" name="codeTransaction" value="{{ $codeTrans }}" readonly>
                    </div>
                    <div class="input-field">
                        <label for="montantDepot">Montant à Transferer :</label>
                        <input type="number" class="form-control" id="montantDepot" name="montantDepot">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success text-light" style="font-size: 17px;">Valider le transfert</button>
                </div>
            </div>

        </form>
    </div>

</main>



@endsection