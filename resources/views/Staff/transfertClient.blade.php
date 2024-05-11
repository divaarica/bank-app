@extends('layoutAdmin')
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
<li class="sidebar-item active">
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
    <!-- <a href="{{route('transfert.etapeDeux',['client1' => 'Client1'])}}" type="button" class="btn btn btn-danger ms-3 text-light" style="font-size: 17px;"> <i class="fa fa-arrow-left"></i> Retour</a> -->
    <br>
    <br>
    <div class="container p-3" style="background-color: white;">
        <header>Faire un transfert (Seul les comptes Courants peuvent etre emetteur )</header>
        @if( $etape == 1)
        <br>
        <div class="text-danger">
            <h1>Etape 1 : Choisir le Client Emetteur</h1>
        </div>
        @endif
        @if($etape == 2)
        <br>
        <div class="text-danger">
            <h1>Etape une : Choisir le Client Destinataire</h1>
        </div>
        @endif
        <br>
        <br>
        @if(session('success'))
        <div class="text-danger ms-3">
            {{ session('success') }}
        </div>
        @endif
        <br><br>
        
        <table id="myTable" class="table table-striped table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Adresse mail</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $clients as $c)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $c ->nom }}</td>
                    <td>{{ $c ->prenom }}</td>
                    <td>{{ $c ->adresse }}</td>
                    <td>{{ $c ->tel }}</td>
                    <td>{{ $c ->email }}</td>
                    <td>
                        @if($etape == 1)
                        <a href="{{ route('transfert.etapeDeux', ['client1' => $c ->id ]) }}" type="button" class="btn btn-info">
                            Choisir
                        </a>
                        @else
                        <a href="{{ route('transfert.etapeTrois', ['client1' => $client1, 'client2' => $c->id]) }}" type="button" class="btn btn-info">
                            Choisir
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</main>
@endsection