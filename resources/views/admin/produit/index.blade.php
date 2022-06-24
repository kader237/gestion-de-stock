@extends("admin.template")

@section("main")
    <a href="{{ route('admin.produit.create') }}" class="btn btn-success mt-4 float-end mb-4 d-block w-25 right"> creer un nouveau produit</a>
<table class="table table-bordered">
        <h2 class="table-caption text-center">Liste des produits</h2>
        <thead>
            <tr>
                <th>N</th>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Prix Unitaire</th>
                <th>Date</th>
                <th colspan="2">
                    Images
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produit as $item)
                <tr>
                    <td> {{ $loop->index + 1 }} </td>
                    <td> {{$item->nom}} </td>
                    <td> {{$item->quantite}} </td>
                    <td> {{$item->prix}} </td>
                    <td> {{$item->created_at->toDateString()}} </td>
                    <td>
                        <img src="{{ asset('storage/'.$item->image) }}" width="120" class="img img-fluid"/>
                    </td>
                    <td>
                        <img src="{{ asset('storage/'.$item->image1) }}" width="120" class="img img-fluid"/>

                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.produit.edit',['id'=>$item->id])}}" class="btn btn-info">Modifier</a>
                            <form action="{{route('admin.produit.delete',['id'=>$item->id])}}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    @if (Session::has("success"))
        <script>
            $(function() {
                toastr.success(Session::get("success"), 'Success', {positionClass: "toast-top-full-width", escapeHtml:true});
            });
        </script>
    @endif
@endsection

