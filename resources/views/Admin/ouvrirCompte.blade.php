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
<li class="sidebar-item active">
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
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Ouvrir Compte(s)</strong></h1>
        <h5>NB: Seul les Clients ayant qu'un seul compte peuvent figurer dans le tableau suivant</h5>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        <br />
        <br>
        <table class="table table-striped table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero Client</th>
                    <th scope="col">Nom Client</th>
                    <th scope="col">Prenom Client</th>
                    <!-- <th scope="col">Prenom Client</th> -->
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $clients as $c)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $c ->numero}}</td>
                    <td>{{ $c ->nom }}</td>
                    <td>{{ $c ->prenom }}</td>
                    <!-- <td>{{ $c->comptes->first()->type -> libelle }}</td> -->
                    <td>
                        <div class="d-flex">
                            @if( $c->comptes->first()->type -> id == 1)
                            <form action="{{ route('comptes.openEpargne', ['client' => $c->id, 'pack' => $c->comptes->first()->pack ]) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir ouvrir un compte epargne pour ce client? ?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-info"> Ouvrir compte Epargne</button>
                            </form>
                            @else
                            <form action="{{ route('comptes.openCourant', ['client' => $c->id, 'pack' => $c->comptes->first()->pack ]) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir ouvrir un compte courant pour ce client? ?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Ouvrir compte Courant</button>
                            </form>
                            @endif
                        </div>
                        <!-- faire en sorte que si il a dja un compte epagner par exemple que ce soit fermer sinon activer comme text sur le bouton -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>


</main>


@endsection