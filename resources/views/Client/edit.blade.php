@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/editClient.css') }}" rel="stylesheet">
@endsection
@section('sidebar')

<!-- changer en clients.edit avec l'id du client -->
<li class="sidebar-item active ">
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

<li class="sidebar-item">
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

    <button class="btn btn-primary profile-button float-end" type="button" data-toggle="modal" data-target="#changePasswordModal">Changer de mot de passe</button>
    <br>
    <div class="container-fluid p-0">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{ $user->nom }} {{ $user->prenom }}</span><span class="text-black-50">{{ $user->email }}</span><span> </span></div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edition du profil</h4>
                        </div>
                        <form action="" method="post">
                            
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nom(s)</label><input type="text" class="form-control" name="nom" value="{{ $user->nom }}"></div>
                                <div class="col-md-6"><label class="labels">Prenom(s)</label><input type="text" class="form-control" value="{{ $user->prenom }}" name="prenom"></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Adresse mail</label><input type="text" class="form-control" name="email" value="{{ $user->email }}"></div>
                                <div class="col-md-6"><label class="labels">Telephone</label><input type="text" class="form-control" name="tel" value="{{ $user->tel }}"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Adresse</label>
                                    <input type="text" class="form-control" name="adresse" value="{{ $user->adresse }}">
                                </div>

                                <div class="col-md-12"> <br><label class="labels">Numero CI</label>
                                    <input type="text" class="form-control" name="numeroCI" value="{{ $user->numeroCI }}">
                                </div>

                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Sauvegrader</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal modifier mot de passe  -->
    <div class="modal" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le mot de passe </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Ancien mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="name">Nouveau mot de passe:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</main>



@endsection