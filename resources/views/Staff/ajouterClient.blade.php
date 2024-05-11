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

<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('guichetiers.index')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Liste du staff</span>
    </a>
</li>

<li class="sidebar-header">
    Client
</li>

<li class="sidebar-item active">
    <a class="sidebar-link" href="{{route('admins.clientCreate')}}">
        <i class="align-middle fa fa-users"></i> <span class="align-middle">Ajouter</span>
    </a>
</li>

<li class="sidebar-item ">
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
<li class="sidebar-item ">
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

    <div class="containerxd">
        <header>Nouveau Client</header>
        <br>
        <br>
        @if(session('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="form first">
                <div class="details personal">
                    <span class="title">Details personels</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Nom</label>
                            <input name="nom" id="nom" type="text">
                            @error('nom')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="input-field">
                            <label>Prenom</label>
                            <input name="prenom" id="prenom" type="text">
                            @error('prenom')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="input-field">
                            <label>Adresse</label>
                            <input name="adresse" id="adresse" type="text">
                            @error('adresse')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="input-field">
                            <label>Numero de Telephone</label>
                            <input name="tel" id="tel" type="number">
                            @error('tel')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="input-field">
                            <label>Adresse mail</label>
                            <input name="email" id="email" type="email">
                            @error('email')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="input-field">
                            <label>Numero de carte d'identite</label>
                            <input type="number" name="numeroCI" id="numeroCI">
                            @error('numeroCI')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- <div class="input-field">
                            <label>Gender</label>
                            <select >
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div> -->


                    </div>
                </div>
                <div class="details ID">
                    <span class="title">Ouverture de compte(s)</span>

                    <div class="fields">
                        <input type="radio" id="compteCourant" name="id_type" value="1" checked>
                        <label for="compteCourant">Compte Courant</label><br><br>

                        <input type="radio" id="compteEpargne" name="id_type" value="2">
                        <label for="compteEpargne">Compte Épargne</label><br><br>

                        <input type="radio" id="lesDeux" name="id_type" value="3">
                        <label for="lesDeux">Tous</label><br><br>


                    </div>
                    <br>
                    <span class="title">Abonnement</span>
                    <div class="fields">
                        @foreach( $types as $type)
                        <label>
                            <input type="radio" name="id_pack" value="{{ $type -> id }}" checked> {{ $type -> libelle }}
                        </label><br><br>
                        @endforeach


                    </div>

                    <br>
                    <button class="btn btn-lg btn-primary" type="submit">
                        <span class="btnText">Valider</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

</main>


@endsection
