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
<li class="sidebar-item active">
    <a class="sidebar-link" href="{{route('transactions.liste')}}">
        <i class="align-middle fa fa-list-ul"></i> <span class="align-middle">Listes des Transactions<span>
    </a>
</li>
<br><br><br>
@endsection
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Transactions</strong></h1>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <div style="overflow-x:auto;">
            <table id="myTable" class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code transaction</th>
                        <th scope="col">Type </th>
                        <th scope="col">De </th>
                        <th scope="col">Vers </th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $trans as $t)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $t-> code }}</td>
                        <td>{{ $t-> type_transaction -> libelle }}</td>
                        @if($t -> id_compte_emetteur != 1)
                        <td>{{ $t-> emetteur -> nom }} {{ $t-> emetteur-> nom }}</td>
                        @else
                        <td>Agence</td>
                        @endif
                        <td>{{ $t-> recepteur -> nom }} {{ $t-> recepteur-> nom }}</td>
                        <td>{{ $t-> montant }}</td>
                        <td>{{ $t-> created_at }}</td>
                        <td class="d-flex ">
                            <form action="{{ route('transactions.rollback', $t-> id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette transaction? ?');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-info custom-btn"> Rollback</button>
                            </form>&nbsp;&nbsp;&nbsp;

                            <form action="{{ route('transactions.destroy', $t-> id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction? ?');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger custom-btn"> Supprimer</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>


</main>


@endsection