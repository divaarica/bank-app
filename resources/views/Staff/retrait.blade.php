@extends('layoutAdmin')
@section('asset')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="{{ asset('Admin/css/form.css') }}" rel="stylesheet">
@endsection
@section('sidebar')
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('admins.index')}}">
        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
    </a>
</li>

<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('admins.create')}}">
        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
    </a>
</li>

<li class="sidebar-header">
    Staff
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('guichetiers.create')}}">
        <i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('guichetiers.index')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste du staff</span>
    </a>
</li>

<li class="sidebar-header">
    Client
</li>

<li class="sidebar-itemx">
    <a class="sidebar-link" href="{{route('admins.clientCreate')}}">
        <i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link" href="{{route('admins.clients')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste des clients<span>
    </a>
</li>

<li class="sidebar-header">
    Comptes
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('admins.comptes')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Tout les comptes<span>
                <!-- mettre un bouton pour fire un depot sur un comtpte et bouton retrait et bouton suuprimer -->
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('comptes.openClose')}}">
        <i class="align-middle fa fa-money"></i> <span class="align-middle">Ouvrir un compte<span>
                <!-- faire le stps, genre etapes, il choisis d'abord le type de comte ensuite le client et
			si le client n'a pas encore se type de compte on continue la creation
		 -->
    </a>
</li>

<li class="sidebar-header">
    Categorie
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('categories.packs')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Packs<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('categories.types')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Type de compte<span>
    </a>
</li>
<li class="sidebar-header">
    Transactions
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('transfert.etapeUn')}}">
        <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Faire un Tranfert<span>
    </a>
</li>
<li class="sidebar-item active">
    <a class="sidebar-link" href="{{route('transactions.depotRetrait')}}">
        <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Faire un Depot / Retrait<span>
    </a>
</li>
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('transactions.liste')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Listes des Transactions<span>
    </a>
</li>
<br><br><br>
@endsection
@section('content')
<main class="content">
    <a href="{{route('transactions.depotRetrait')}}" type="button" class="btn btn btn-danger ms-3 text-light" style="font-size: 17px;"> <i class="fa fa-arrow-left"></i> Retour</a>
    <br>
    <br>
    @if(session('success'))
    <div class="text-danger ms-3">
        {{ session('success') }}
    </div>
    @endif
    <br>
    <div class="container">
        <header>Faire un retrait</header>

        <form action="{{ route('transactions.doRetrait', ['compte' => $cpt->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form first">
                <div class="details personal">
                    <span class="title">Details Compte</span>

                    <div class="fields">
                        <div class="input-field">
                            <label for="numeroCompte">Numéro du compte :</label>
                            <input type="text" class="form-control" id="numeroCompte" name="numeroCompte" value="{{ $cpt->numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="codeTransaction">Type de compte :</label>
                            <input type="text" class="form-control" id="typeCompte" name="typeCompte" value="{{ $cpt-> type -> libelle }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="codeTransaction">pack :</label>
                            <input type="text" class="form-control" id="typeCompte" name="typeCompte" value="{{ $cpt-> pack -> libelle }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="nomClient"> Propritaire compte :</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" value="{{ $cpt->client->nom }} {{ $cpt->client->prenom }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="numeroClient">Numéro du client :</label>
                            <input type="text" class="form-control" id="numeroClient" name="numeroClient" value="{{ $cpt->client->numero }}" readonly>
                        </div>

                        <div class="input-field">
                            <label for="nomClient">Balance :</label>
                            <input type="text" class="form-control" id="nomClient" name="nomClient" value="{{ $cpt->balance }} F" readonly>
                        </div>


                    </div>
                </div>
                <div class="details personal">
                    <br>
                    <span class="title">Code</span>
                    <div class="input-field">
                        <label for="codeTransaction">Code de la future transaction :</label>
                        <input type="text" class="form-control" id="codeTransaction" name="codeTransaction" value="{{ $codeTrans }}" readonly>
                    </div>
                    <br>
                    <span class="title">Retrait</span>
                    <div class="input-field">
                        <label for="montantRetrait">Montant à retirer :</label>
                        <input type="number" class="form-control" id="montantRetrait" name="montantRetrait">
                    </div>

                    <br>
                    <button class="btn btn-lg btn-success" type="submit">
                        <span class="btnText">Retirer</span>
                    </button>
                </div>
            </div>

        </form>
    </div>


</main>


@endsection