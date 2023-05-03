@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->
    <div class="modal fade bd-example-modal-lg p-3" id="livraisonModal" tabindex="-1"
        aria-labelledby="livraisonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="livraisonForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="livraisonModalLabel">Modifier Livraison</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a livraison -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
                            <input type="hidden" name="id" value="{{ $livraisonItems[0]->livraison->id }}">

                            <div class="col-4">
                                <label for="name" class="form-label">Tailleur</label>
                                <select class="form-control form-control-sm" id="tailleur_idInput" name="tailleur_id"
                                    required>
                                    <option value="">Choisir une tailleur</option>
                                    @foreach ($tailleurs as $tailleur)
                                        <option value="{{ $tailleur->id }}">{{ $tailleur->name }} {{ $tailleur->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="lname" class="form-label">Commande</label>
                                <select class="form-control form-control-sm" name="commande_id" id="commandeInput" required>
                                    <option value="">Choisir une Commande</option>
                                    @foreach ($commandes as $commande)
                                        <option value="{{ $commande->id }}">{{ $commande->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="lname" class="form-label">Date de Livrison</label>
                                <input type="date" class="form-control form-control-sm" name="date_livrison" id="date_livraisonInput" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg p-3" id="livraisonItemModal" tabindex="-1"
        aria-labelledby="livraisonItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="livraisonItemForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="livraisonItemModalLabel">Créer un nouveau
                            Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a livraison -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
                            <div class="col-4">
                                <label for="name" class="form-label">Tailleur</label>
                                <select class="form-control form-control-sm" disabled>
                                    <option value=""></option>
                                    @foreach ($tailleurs as $tailleur)
                                        <option value="{{ $tailleur->id }}"
                                            {{ $livraisonItems[0]->livraison?->tailleur_id == $tailleur->id ? 'selected' : '' }}>
                                            {{ $tailleur->name }} {{ $tailleur->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="name" class="form-label">Code Commande</label>
                                <select class="form-control form-control-sm" disabled>
                                    <option value="{{ $livraisonItems[0]->livraison?->commande_id }}">{{ $livraisonItems[0]->livraison?->commande_id }}</option>

                                </select>
                            </div>
                            <div class="col-4">
                                <label for="lname" class="form-label">Date de livraison</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="date_livraison" disabled
                                    value="{{ $livraisonItems[0]->livraison?->date_livrison }}">
                            </div>
                        </div>
                        <div class="livraisonArticles mt-3">
                            <div id="article0" class="row  border border-success rounded p-2">
                                <input type="hidden" name="livraison_id" value="{{$livraisonItems[0]->livraison?->id}}">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Vetement</label>
                                    <select class="form-control form-control-sm" name="vetement_id" required
                                        id="vetementInput">
                                        <option value=""></option>
                                        @foreach ($vetements as $vetement)
                                            <option value="{{ $vetement->id }}">{{ $vetement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Couleur </label>
                                    <select class="form-control form-control-sm" name="couleur_id" required
                                        id="couleurInput">
                                        <option value=""></option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Taille </label>
                                    <input type="number" class="form-control form-control-sm" name="taille" required
                                        id="tailleInput">
                                </div>
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Qte </label>
                                    <input type="number" class="form-control form-control-sm" name="qte" required
                                        id="qteInput">
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        <div class="card-header">
            Livraison Info
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Num Commande</th>
                            <th>Tailleur</th>
                            <th>Date de livraison</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $livraisonItems[0]->livraison->id }}</td>
                            <td class="commande">{{ $livraisonItems[0]->livraison->commande_id }}</td>
                            <td class="tailleur">{{ $livraisonItems[0]->livraison->tailleur->name }} {{ $livraisonItems[0]->livraison->tailleur->lname }}</td>
                            <td class="date_livraison">{{ $livraisonItems[0]->livraison->date_livrison }}</td>
                            <td>
                                <button class="btn btn-sm text-success"
                                    onclick="editLivraison({{ $livraisonItems[0]->livraison->id }},this)"><i
                                        class="fas fa-edit"></i>
                                </button>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Livraison Articles
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#livraisonItemModal">Ajouter un Article </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Vetement</th>
                            <th>Couleur</th>
                            <th>Qte</th>
                            <th>Taille</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($livraisonItems as $livraisonItem)
                            <tr>
                                <td class="id">{{ $livraisonItem->id }}</td>
                                <td class="vetement">{{ $livraisonItem->vetement?->name }}
                                    {{ $livraisonItem->tailleur?->lname }}</td>
                                <td class="couleur">{{ $livraisonItem->couleur?->name }}</td>
                                <td class="qte">{{ $livraisonItem->qte }}</td>
                                <td class="taille">{{ $livraisonItem->taille }}</td>

                                <td>
                                    <button class="btn btn-sm text-success"
                                        onclick="editlivraisonItem({{ $livraisonItem->id }},this)"><i
                                            class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm text-danger"
                                        onclick="deleteLivraisonItem({{ $livraisonItem->id }},this)"><i
                                            class="fa-solid fa-trash"></i>
                                    </button>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('livraisonItemModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#livraisonItemForm').trigger("reset");
        })
        const editLivraison = (id, btn) => {
            var tailleur = $(btn).parent().parent().children(".tailleur").html()
            var commande = $(btn).parent().parent().children(".commande").html()
            var date_livraison = $(btn).parent().parent().children(".date_livraison").html()
            console.log(tailleur,date_livraison);
            $("#tailleur_idInput").find("option:contains('" + $.trim(tailleur) + "')").prop("selected", true);
            $("#commandeInput").find("option:contains('" + $.trim(commande) + "')").prop("selected", true);
            $("#date_livraisonInput").val(date_livraison);
            $("#livraisonModal").modal("show");
        }
        const editlivraisonItem = (id, btn) => {

            var vetement = $(btn).parent().parent().children(".vetement").html()
            var couleur = $(btn).parent().parent().children(".couleur").html()
            var qte = $(btn).parent().parent().children(".qte").html()
            var taille = $(btn).parent().parent().children(".taille").html()
            $("#vetementInput").find("option:contains('" + $.trim(vetement) + "')").prop("selected", true);
            $("#couleurInput").find("option:contains('" + couleur + "')").prop("selected", true);
            $("#qteInput").val(qte);
            $("#tailleInput").val(taille);
            $("#livraisonItemModal").modal("show");
            $("#livraisonItemForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(vetement, couleur, qte, taille);
        }
        const deleteLivraison = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('livraisons/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        const deleteLivraisonItem = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('livraisons/article/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#livraisonForm').submit(function(e) {
            e.preventDefault(); // prevent the form from submitting normally

            // get the form data
            var formData = $(this).serialize();

            // display a loading indicator
            $('.modal-footer button[type="submit"]').html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...'
            ).attr('disabled', true);

            // send the AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('livraisons.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#livraisonModal').modal('hide');

                    // reset the form fields
                    $('#livraisonForm input, #livraisonForm select').val('');

                    // reload the page to show the updated data
                    location.reload();
                },
                error: function(response) {
                    // display an error message and re-enable the submit button
                    alert('Error: ' + response.responseJSON.message);
                    $('.modal-footer button[type="submit"]').html('Save changes').attr('disabled',
                        false);
                }
            });
        });
        $('#livraisonItemForm').submit(function(e) {
            e.preventDefault(); // prevent the form from submitting normally

            // get the form data
            var formData = $(this).serialize();

            // display a loading indicator
            $('.modal-footer button[type="submit"]').html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...'
            ).attr('disabled', true);

            // send the AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('livraisons.article.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#livraisonItemModal').modal('hide');

                    // reset the form fields
                    $('#livraisonItemForm input, #livraisonItemForm select').val('');

                    // reload the page to show the updated data
                    location.reload();
                },
                error: function(response) {
                    // display an error message and re-enable the submit button
                    alert('Error: ' + response.responseJSON.message);
                    $('.modal-footer button[type="submit"]').html('Save changes').attr('disabled',
                        false);
                }
            });
        });
    </script>
@endsection
