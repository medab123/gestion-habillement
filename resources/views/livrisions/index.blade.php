@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg p-3" id="livraisonModal" tabindex="-1" aria-labelledby="livraisonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="livraisonForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="livraisonModalLabel">Créer un nouveau
                            Livraison</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a livraison -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
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
                                <select class="form-control form-control-sm" name="commande_id" required>
                                    <option value="">Choisir une Commande</option>
                                    @foreach ($commandes as $commande)
                                        <option value="{{ $commande->id }}">{{ $commande->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="lname" class="form-label">Date de Livrison</label>
                                <input type="date" class="form-control form-control-sm" name="date_livrison" required>

                            </div>
                        </div>
                        <div class="livraisonArticles mt-3">
                            <div id="article0" class="row  border border-success rounded p-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Vetement</label>
                                    <select class="form-control form-control-sm" name="vetement_id[]" required>
                                        <option value="">Choisir une vetement</option>
                                        @foreach ($vetements as $vetement)
                                            <option value="{{ $vetement->id }}">{{ $vetement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Couleur </label>
                                    <select class="form-control form-control-sm" name="couleur_id[]" required>
                                        <option value="">Choisir une Couleur</option>
                                        @foreach ($couleurs as $couleur)
                                            <option value="{{ $couleur->id }}">{{ $couleur->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Taille </label>
                                    <input type="number" class="form-control form-control-sm" name="taille[]" placeholder="Taille .." required>
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label">Qte </label>
                                    <input type="number" class="form-control form-control-sm" name="qte[]" placeholder="Qte .." required>
                                </div>
                                <div class="col-md-1 btn-delete">
                                    <button type="button" onclick="deleteArticle(this)"
                                        class=" text-white  btn btn-danger btn-sm mt-4">Delete</button>
                                </div>

                            </div>
                        </div>
                        <div class="row text-center">
                            <button type="button" onclick="addArticle()"
                                class=" col-12  btn btn-success btn-sm text-white float-end my-3 ">Add</button>

                        </div>
                        <script>
                            const addArticle = () => {
                                $(".livraisonArticles").append('<div class="row  border border-success rounded p-2 mt-2">' + $("#article0")
                                    .html() + "</div>")
                            }
                            const deleteArticle = (btn) => {
                                if ($(btn).parent().parent().attr("id") == "article0") return
                                $(btn).parent().parent().remove();
                            }
                            //$("#article0").children(".btn-delete").children("button").attr("disabled","true")
                        </script>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Livraisons
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#livraisonModal">Ajouter un livraison </button>
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
                        @foreach ($livraisons as $livraison)
                            <tr>
                                <td>{{ $livraison->id }}</td>
                                <td class="name">{{ $livraison->commande_id }}</td>

                                <td class="name">{{ $livraison->tailleur?->name }} {{ $livraison->tailleur?->lname }}</td>
                                <td class="lname">{{ $livraison->date_livrison }}</td>

                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $livraison->id }},this)"><i
                                            class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm text-danger"
                                        onclick="deleteLivraison({{ $livraison->id }},this)"><i
                                            class="fa-solid fa-trash"></i>
                                    </button>
                                    <a class="btn btn-sm text-primary" href="{{ route("livraisons.index")."/".$livraison->id }}"><i
                                            class="fas fa-eye"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('livraisonModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#livraisonForm').trigger("reset");
        })
        const edit = (id, btn) => {
            var name = $(btn).parent().parent().children(".name").html()
            var lname = $(btn).parent().parent().children(".lname").html()
            var tel = $(btn).parent().parent().children(".tel").html()
            var functionName = $(btn).parent().parent().children(".functionName").html()
            var tail = $(btn).parent().parent().children(".tail").html()
            var adresse = $(btn).parent().parent().children(".adresse").html()
            $("#nameInput").val(name);
            $("#lnameInput").val(lname);
            $("#telInput").val(tel);
            $("#function_idInput").find("option:contains('" + functionName + "')").prop("selected", true);
            $("#adresseInput").val(adresse);
            $("#livraisonModal").modal("show");
            $("#livraisonForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
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
    </script>
@endsection
