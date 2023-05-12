@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->
    <div class="modal fade bd-example-modal-lg p-3" id="commandeModal" tabindex="-1"
        aria-labelledby="commandeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="commandeForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commandeModalLabel">Modifier Commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a commande -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
                            <div class="col-6">
                                <input type="hidden" name="id" value="{{ $commandeItems[0]->commande->id }}">
                                <label for="name" class="form-label">Tailleur</label>
                                <select class="form-control form-control-sm"  id="tailleurInput" name="tailleur_id">
                                    <option value=""></option>
                                    @foreach ($tailleurs as $tailleur)
                                        <option value="{{ $tailleur->id }}"
                                            {{ $commandeItems[0]->commande?->tailleur_id == $tailleur->id ? 'selected' : '' }}>
                                            {{ $tailleur->name }} {{ $tailleur->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="lname" class="form-label">Date de commande</label>
                                <input type="date" class="form-control form-control-sm" id="date_commandeInput"
                                    name="date_commande"  value="{{ $commandeItems[0]->commande?->date_commande }}">
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
    <div class="modal fade bd-example-modal-lg p-3" id="commandeItemModal" tabindex="-1"
        aria-labelledby="commandeItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="commandeItemForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commandeItemModalLabel">Créer un nouveau
                            Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a commande -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
                            <div class="col-6">
                                <label for="name" class="form-label">Tailleur</label>
                                <select class="form-control form-control-sm" disabled>
                                    <option value=""></option>
                                    @foreach ($tailleurs as $tailleur)
                                        <option value="{{ $tailleur->id }}"
                                            {{ $commandeItems[0]->commande?->tailleur_id == $tailleur->id ? 'selected' : '' }}>
                                            {{ $tailleur->name }} {{ $tailleur->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="lname" class="form-label">Date de commande</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="date_commande" disabled
                                    value="{{ $commandeItems[0]->commande?->date_commande }}">
                            </div>
                        </div>
                        <div class="commandeArticles mt-3">
                            <div id="article0" class="row  border border-success rounded p-2">
                                <input type="hidden" name="commande_id" value="{{$commandeItems[0]->commande?->id}}">
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
            Commande Info
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tailleur</th>
                            <th>Date de commande</th>
                            <th style="width: 60px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $commandeItems[0]->commande->id }}</td>
                            <td class="tailleur">{{ $commandeItems[0]->commande->tailleur->name }}
                                {{ $commandeItems[0]->commande->tailleur->lname }}</td>
                            <td class="date_commande">{{ $commandeItems[0]->commande->date_commande }}</td>
                            <td>
                                <button class="btn btn-sm text-success"
                                    onclick="editCommande({{ $commandeItems[0]->commande->id }},this)"><i
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
            Commande Articles
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#commandeItemModal">Ajouter un Article </button>
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
                        @foreach ($commandeItems as $commandeItem)
                            <tr>
                                <td class="id">{{ $commandeItem->id }}</td>
                                <td class="vetement">{{ $commandeItem->vetement?->name }}
                                    {{ $commandeItem->tailleur?->lname }}</td>
                                <td class="couleur">{{ $commandeItem->couleur?->name }}</td>
                                <td class="qte">{{ $commandeItem->qte }}</td>
                                <td class="taille">{{ $commandeItem->taille }}</td>

                                <td>
                                    <button class="btn btn-sm text-success"
                                        onclick="editcommandeItem({{ $commandeItem->id }},this)"><i
                                            class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm text-danger"
                                        onclick="deleteCommandeItem({{ $commandeItem->id }},this)"><i
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
        var myModalEl = document.getElementById('commandeItemModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#commandeItemForm').trigger("reset");
        })
        const editCommande = (id, btn) => {
            var tailleur = $(btn).parent().parent().children(".tailleur").html()
            var date_commande = $(btn).parent().parent().children(".date_commande").html()
            console.log(tailleur,date_commande);
            $("#tailleurInput").find("option:contains('" + $.trim(tailleur) + "')").prop("selected", true);
            $("#date_commandeInput").val(date_commande);
            $("#commandeModal").modal("show");
        }
        const editcommandeItem = (id, btn) => {

            var vetement = $(btn).parent().parent().children(".vetement").html()
            var couleur = $(btn).parent().parent().children(".couleur").html()
            var qte = $(btn).parent().parent().children(".qte").html()
            var taille = $(btn).parent().parent().children(".taille").html()
            $("#vetementInput").find("option:contains('" + $.trim(vetement) + "')").prop("selected", true);
            $("#couleurInput").find("option:contains('" + couleur + "')").prop("selected", true);
            $("#qteInput").val(qte);
            $("#tailleInput").val(taille);
            $("#commandeItemModal").modal("show");
            $("#commandeItemForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(vetement, couleur, qte, taille);
        }
        const deleteCommande = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('commandes/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        const deleteCommandeItem = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('commandes/article/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#commandeForm').submit(function(e) {
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
                url: '{{ route('commandes.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#commandeModal').modal('hide');

                    // reset the form fields
                    $('#commandeForm input, #commandeForm select').val('');

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
        $('#commandeItemForm').submit(function(e) {
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
                url: '{{ route('commandes.article.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#commandeItemModal').modal('hide');

                    // reset the form fields
                    $('#commandeItemForm input, #commandeItemForm select').val('');

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
