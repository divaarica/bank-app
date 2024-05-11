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
<li class="sidebar-item active ">
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
<li class="sidebar-item">
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

    @if($ifCompte)
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Client</strong> Compte Epargne</h1>

        <br>
        <button class="btn btn-lg btn-warning float-end" data-toggle="modal" data-target="#changerPack">Changer de Pack</button>
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <a href=" ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Balance</h5>
                                            </div>

                                            <div class="col-auto">
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3"> {{ $compte->balance }} FCFA</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href=" ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Numero Compte</h5>
                                            </div>

                                            <div class="col-auto">
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $compte->numero }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href=" ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Pack</h5>
                                            </div>

                                            <div class="col-auto">
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $compte->pack -> libelle }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <h1 class="h4 mb-4"><strong>Dernieres transactions</strong></h1>
        <!-- une transaction c'est juste un retrait du compte verts un depot sur un autres -->
        <div style="overflow-x:auto;">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code transaction</th>
                        <th scope="col">Type </th>
                        <th scope="col">De </th>
                        <th scope="col">Vers </th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date</th>
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

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <a href="{{route('clients.mesTransactions')}}" type="button" class="btn btn btn-primary text-light" style="font-size: 15px;"> <i class="fa fa-eye"></i> Voir toutes</a>

    </div>
    <div class="modal fade " id="changerPack" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changer le Pack du Compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comptes.update', ['compte' => $compte->id]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Pack</label>
                            <br>
                            <select name="id_pack" class="form-control">
                                @foreach($packs as $p)
                                <option value="{{ $p->id }}" @if($p->id == $compte->pack->id) selected @endif>
                                    {{ $p->libelle }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Client</strong> Compte Epargne</h1>
        <h1>VOUS NE POSSEDEZ PAS DE COMPTE EPARGNE</h1>


    </div>

    @endif
    <br><br><br>

</main>

@endsection