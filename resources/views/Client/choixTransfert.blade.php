@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/steps.css') }}" rel="stylesheet">
@endsection
@section('sidebar')

<!-- changer en clients.edit avec l'id du client -->
<li class="sidebar-item ">
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

        <h1 class="h3 mb-3"><strong>Tranfert</strong> D'argent</h1>

        <br>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        <br>
        <br>
        <div class="containerxd">
            <div class="cardxd">
                <a href="{{ route('transactions.memeBanque') }}">
                    <h2>Transfert vers un compte de la banque</h2>
                    <br>
                    <span class="arrow">&#10132;</span>
                </a>
            </div>

            <div class="cardxd">
                <a href="{{ route('transactions.banqueDifferente') }}">
                    <h2>Transfert vers un compte d'une banque Differente</h2>
                    <br>
                    <span class="arrow">&#10132;</span>
                </a>
            </div>

            <div class="cardxd">
                
                <a href="{{ route('transactions.compteEpargne') }}">
                    <h2>Transfert vers le compte épargne</h2>
                    <span class="arrow">&#10132;</span>
                </a>
            </div>
        </div>

</main>



@endsection

