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

<li class="sidebar-item active">
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
        <h1 class="h3 mb-3"><strong>Clients</strong></h1>
        <br>
        @if(session('success'))
        <div class="text-danger">
            {{ session('success') }}
        </div>
        @endif
        <br>
        <br>
        <div style="overflow-x: auto;">
            <table id="myTable" class="table table-striped table-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Adresse mail</th>
                        <th scope="col">Etat</th>
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
                        @if($c -> state == 1)
                            Actif
                        @else
                            Non actif
                        @endif
                        </td>
                        <td class="d-flex ">
                            <a href="" type="button" class="btn btn-success custom-btn" data-toggle="modal" data-target="#editClient{{$c->id}}">
                                Modifier</a>

                            &nbsp;&nbsp;&nbsp;
                            @if($c -> state == 1)
                                <form action="{{ route('admins.desactiverClient', $c->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir Desactiver ce client?');" style="display:inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning custom-btn">Desactiver</button>
                                </form>
                            @else
                                <form action="{{ route('admins.activerClient', $c->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary custom-btn">Ativer</button>
                                </form>
                            @endif
                            &nbsp;&nbsp;&nbsp;
                            <form action="{{ route('clients.destroy', $c->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir Supprimer ce client?');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger custom-btn">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <!-- modal  -->
    @foreach( $clients as $c)
    <div class="modal" id="editClient{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('clients.update', ['client' => $c->id]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nom</label>
                            <br>

                            <input class="form-control" id="nom" name="nom" type="text" value="{{ $c -> nom }}">
                        </div>
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <br>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Prenom</label>
                            <br>

                            <input class="form-control" type="text" id="prenom" name="prenom" value="{{ $c -> prenom }}">
                        </div>
                        @error('prenom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Adresse</label>
                            <br>

                            <input class="form-control" id="adresse" name="adresse" type="text" value="{{ $c -> adresse }}">
                        </div>
                        @error('adresse')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Telephone</label>
                            <br>

                            <input class="form-control" id="tel" name="tel" type="text" value="{{ $c -> tel }}">
                        </div>
                        @error('tel')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <br>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Adresse mail</label>
                            <br>

                            <input class="form-control" id="email" name="email" type="text" value="{{ $c -> email }}">
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Numero carte d'identite</label>
                            <br>

                            <input class="form-control" id="numeroCI" name="numeroCI" type="text" value="{{ $c -> numeroCI }}">
                        </div>
                        @error('numeroCI')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


</main>


@endsection