@extends('layoutAdmin')
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
        <table id="myTable" class="table table-striped table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code transaction</th>
					<th scope="col">De </th>
					<th scope="col">Vers </th>
                    <th scope="col">Montant</th>
					<th scope="col">Date</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>abc</td>
                    <td>efg</td>
                    <td>hij</td>
					<td>...</td>
                    <td>...</td>
                    <td>
                    <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                           Rollback</a>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>


</main>



@endsection
