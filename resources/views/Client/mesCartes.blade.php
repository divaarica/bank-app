@extends('layoutAdmin')
@section('asset')
<link href="{{ asset('Admin/css/mesCartes.css') }}" rel="stylesheet">
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
<li class="sidebar-item ">
    <a class="sidebar-link" href="{{route('client.cartes')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Generer une cartes<span>
                <!-- mettre un bouton pour fire un depot sur un comtpte et bouton retrait et bouton suuprimer -->
    </a>
</li>
<li class="sidebar-item active ">
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
    <h1 class="h3 mb-3"><strong>Mes</strong>Cartes</h1>
    <br>
    @if(session('success'))
    <div class="text-danger">
        {{ session('message') }}
    </div>
    @endif
    <br>
    <div class="container ">
        <div class="row justify-content-center">
            @foreach($cartes as $carte)
            <div class="card col-md-6 ">
                <div class="card-inner">
                    <div class="front">
                        @if($carte -> type == 'visa')
                        <img src="{{ asset('Admin/img/map.png') }}" class="map-img">
                        <div class="row2">
                            <img src="{{ asset('Admin/img/chip.png') }}" width="30px">
                            <img src="{{ asset('Admin/img/visa.png') }}" width="30px">
                        </div>
                        @elseif($carte -> type == 'masterCard')
                        <img src="{{ asset('Admin/img/bg.png') }}" class="map-img">
                        <div class="row2">
                            <img src="{{ asset('Admin/img/chip.png') }}" width="30px">
                            <img src="{{ asset('Admin/img/logo.png') }}" width="30px">
                        </div>
                        @else
                        <img src="{{ asset('Admin/img/ae3.jpg') }}" class="map-img">
                        <div class="row2">
                            <img src="{{ asset('Admin/img/chip.png') }}" width="30px">
                            <img src="{{ asset('Admin/img/americanExpress.png') }}" width="30px">
                        </div>
                        @endif

                        <div class="row2 card-no">
                            <p>{{$carte -> numero}}</p>
                        </div>
                        <div class="row2 name">
                            <p>{{$carte -> client -> nom}} {{$carte -> client -> nom}}</p>
                            <p>{{$carte -> date_expiration}}</p>
                        </div>
                    </div>
                    <div class="back">
                        @if($carte -> type == 'visa')
                        <img src="{{ asset('Admin/img/map.png') }}" class="map-img">
                        <div class="bar"></div>
                        <div class="row2 card-cvv">
                            <div>
                                <img src="{{ asset('Admin/img/pattern.png') }}">

                            </div>
                            <p>{{$carte -> cvv}}</p>

                        </div>
                        <div class="row2 signature">
                            <p>CUSTOMER SIGNATURE</p>
                            <img src="{{ asset('Admin/img/visa.png') }}" width="40px">
                        </div>
                        @elseif($carte -> type == 'masterCard')
                        <img src="{{ asset('Admin/img/bg.png') }}" class="map-img">
                        <div class="bar"></div>
                        <div class="row2 card-cvv">
                            <div>
                                <img src="{{ asset('Admin/img/pattern.png') }}">
                            </div>
                            <p>824</p>
                        </div>
                        <div class="row2 signature">
                            <p>CUSTOMER SIGNATURE</p>
                            <img src="{{ asset('Admin/img/logo.png') }}" width="40px">
                        </div>
                        @else
                        <img src="{{ asset('Admin/img/ae3.jpg') }}" class="map-img">
                        <div class="bar"></div>
                        <div class="row2 card-cvv">
                            <div>
                                <img src="{{ asset('Admin/img/pattern.png') }}">
                            </div>
                            <p>824</p>
                        </div>
                        <div class="row2 signature">
                            <p>CUSTOMER SIGNATURE</p>
                            <img src="{{ asset('Admin/img/americanExpress.png') }}" width="60px">
                        </div>
                        @endif


                    </div>
                </div>
                <form action="{{ route('cartes.destroy', $carte->id) }}" method="post">
                @csrf
                @method('DELETE')
                <br>

                <button class="btn btn-sm btn-dark" type="submit">Supprimer</button>
                <br>

            </form>
            </div>
            
            @endforeach



        </div>
    </div>

</main>



@endsection