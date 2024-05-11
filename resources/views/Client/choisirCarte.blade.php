@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/choose.css') }}" rel="stylesheet">
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
<li class="sidebar-item active">
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
    <h1 class="h3 mb-3"><strong>Choisir</strong> le type de carte</h1>
    <br>
    <br>
    <div class="container" style="font-weight: 500; ">
        <!-- Visa - selectable -->
        <div class="row">

            <div class="col-md-4 credit-card visa selectable">
                <a href="{{ route('client.genererCarte',['choix' => 'visa']) }}" style="text-decoration: none;">
                    <div class="div">
                        <p class="credit-card-last4 text-white">
                            4242
                        </p>
                        <br><br><br>
                        <p class="credit-card-expiry text-white">
                            08/25
                        </p>
                    </div>

                </a>
            </div>

            <!-- Mastercard - selectable -->
            <div class="col-md-4 credit-card mastercard selectable">
                <a href="{{ route('client.genererCarte',['choix' => 'masterCard']) }}" style="text-decoration: none;">
                    <div>
                        <p class="credit-card-last4 text-white">
                            8210
                        </p><br><br><br>
                        <p class="credit-card-expiry text-white">
                            10/22
                        </p>
                    </div>
                </a>
            </div>


            <!-- Amex - selectable -->
            <div class="col-md-4 credit-card amex selectable">
                <a href="{{ route('client.genererCarte',['choix' => 'americanExpress']) }}" style="text-decoration: none;">
                    <div>
                        <p class="credit-card-last4 text-white">
                            8431
                        </p>
                        <br><br><br>
                        <p class="credit-card-expiry text-white">
                            01/24
                        </p>
                    </div>
                </a>
            </div>

        </div>

    </div>

</main>



@endsection