@extends('layoutAdmin')
@section('asset')
<style>
    table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
  .modal-medium .modal-dialog {
    max-width: 60%; /* Vous pouvez ajuster cette valeur selon vos besoins */
}
</style>
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
<li class="sidebar-item active">
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
        <h1 class="h3 mb-3"><strong>Gestion des comptes</strong></h1>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        <br />
        <br>
        <div style="overflow-x:auto;">
            <table id="myTable" class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Numero Comptes</th>
                        <!-- <th scope="col">Numero Client</th> -->
                        <th scope="col">Titulaire</th>
                        <th scope="col">Type</th>
                        <th scope="col">Pack</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Date d'ouverture</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $comptes as $c)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $c -> numero }}</td>
                        <td>{{ $c -> client -> nom }} {{ $c -> client -> prenom}}</td>
                        <td>{{ $c -> type -> libelle }}</td>
                        <td>{{ $c -> pack -> libelle }}</td>
                        <td>{{ $c -> balance }}</td>
                        <td>{{ $c -> created_at }}</td>
                        <td class="d-flex ">
                            <a href="" type="button" class="btn btn-light border-success custom-btn" data-toggle="modal" data-target="#voirRib{{$c-> rib -> id}}">
                                Voir RIB</a> &nbsp;&nbsp;&nbsp;

                            <a href="" type="button" class="btn btn-success custom-btn" data-toggle="modal" data-target="#editCompte{{$c->id}}">
                                Modifier</a> &nbsp;&nbsp;&nbsp;

                            @if($c -> state == 1)
                            <form action="{{ route('admins.desactiverCompte', $c->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir Desactiver ce compte?');" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning custom-btn">Desactiver</button>
                            </form>
                            @else
                            @if($c -> client -> state == 1)
                            <form action="{{ route('admins.activerCompte', $c->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary custom-btn">Ativer</button>
                            </form>
                            @else
                            <button type="button" class="btn btn-primary custom-btn" disabled>
                                Ativer</button>
                            @endif

                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <!-- modal  -->
    @foreach( $comptes as $c)
    <div class="modal fade " id="editCompte{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le Compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comptes.update', ['compte' => $c->id]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Pack</label>
                            <br>
                            <select name="id_pack" class="form-control">
                                @foreach($packs as $p)
                                <option value="{{ $p -> id }}" @if( $p -> id == $c -> pack -> id) selected @endif>
                                    {{ $p -> libelle }}
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
    @endforeach

    <!-- modal  -->
    @foreach( $comptes as $c)
    <div class="modal fade" id="voirRib{{$c->rib->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voir RIB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 style="text-align: center;">Relevé d'Identité Bancaire (RIB)</h3>
                    <table>
                        <tr>
                            <th>Information</th>
                            <th>Valeur</th>
                        </tr>
                        <tr>
                            <td><strong>Titulaire</strong></td>
                            <td>{{ $c -> client -> nom }} {{ $c -> client -> prenom }}</td>
                        </tr>
                        <tr>
                            <td><strong>IBAN</strong></td>
                            <td>{{ $c->rib -> iban}}</td>
                        </tr>
                        <tr>
                            <td><strong>BIC</strong></td>
                            <td>{{ $c->rib -> bic }}</td>
                        </tr>
                        <tr>
                            <td><strong>Code Banque</strong></td>
                            <td>{{ $c->rib -> codeBanque }}</td>
                        </tr>
                        <tr>
                            <td><strong>Code Agence</strong></td>
                            <td>{{ $c->rib -> codeGuichet }}</td>
                        </tr>
                        <tr>
                            <td><strong>Numéro de compte</strong></td>
                            <td>{{ $c -> numero }}</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    


</main>


@endsection