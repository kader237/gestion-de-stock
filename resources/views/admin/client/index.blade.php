@extends('admin.template')

@section('main')
    <table class="table table-bordered">
        <h2 class="table-caption text-center">Liste des CLients</h2>
        <thead>
            <tr>
                <th>N</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Ville</th>
                <th>Numero De Telephone</th>
                <th>Email</th>
                <th> Type</th>
                @if (!auth()->user()->isChef())

                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td> {{ $loop->index + 1 }} </td>
                    <td> {{ $item->name }} </td>
                    <td> {{ $item->prenom }} </td>
                    <td> {{ $item->ville }} </td>
                    <td> {{ $item->tel }} </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td> <span class="badge p-2 bg-secondary">{{ $item->admin ? $item->admin->type : 'client' }}</span> </td>
                    @if (!auth()->user()->isChef())
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.client.edit', ['id' => $item->id]) }}" class="btn btn-info">Modifier</a>
                            <form action="{{ route('admin.client.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>

    <hr>
    @if (!auth()->user()->isChef())

    <div class="mb-4 text-right">
        <a class="btn btn-secondary" href="{{ route("admin.admin.create") }}">Ajouter Un Administrateur</a>
    </div>
    @endif
    <table class="table table-bordered">
        <h2 class="table-caption text-center">Liste des Administrateurs</h2>
        <thead>
            <tr>
                <th>N</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Ville</th>
                <th>Numero De Telephone</th>
                <th>Email</th>
                <th>Type</th>
                @if (!auth()->user()->isChef())
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($admin as $item)
                <tr>

                    <td> <span class="badge bg-warning">{{ $item->admin->user_id == auth()->user()->id?"(moi meme)":$loop->index + 1  }}</span> </td>
                    <td> {{ $item->name }} </td>
                    <td> {{ $item->prenom }} </td>
                    <td> {{ $item->ville }} </td>
                    <td> {{ $item->tel }} </td>
                    <td>
                        {{ $item->email }}
                    </td>

                    <td> <span class="badge p-2 bg-secondary">{{ $item->admin ? $item->admin->type : 'client' }}</span> </td>
                    @if (!auth()->user()->isChef())

                    <td>
                        <div class="btn-group btn-sm btn-sm">
                            @if ($item->isMagasinier())
                            <a href="{{ route('admin.client.edit', ['id' => $item->id]) }}" class="btn btn-info">Modifier</a>
                            <form action="{{ route('admin.client.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            @else
                                <span class="badge bg-danger">aucune action possible</span>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

@if (session()->has("message.success"))
    <div class="alert alert-success">
        {{  session()->get('message.success');  }}
    </div>
@endif
    @endsection
