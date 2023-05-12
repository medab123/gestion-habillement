@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg p-3" id="livrisonModal" tabindex="-1" aria-labelledby="livrisonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <div class="modal-content">
                <form id="livrisonForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="livrisonModalLabel">Créer un nouveau
                            Livrison</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <!-- Input fields for creating or updating a livrison -->
                        @csrf
                        <div class="row border border-primary rounded p-2">
                            <div class="col-6">
                                <label for="name" class="form-label">Tailleur</label>
                                <select class="form-control form-control-sm" id="tailleur_idInput" name="tailleur_id"
                                    required>
                                    <option value=""></option>
                                    @foreach ($tailleurs as $tailleur)
                                        <option value="{{ $tailleur->id }}">{{ $tailleur->name }} {{ $tailleur->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name" class="form-label">Vetement</label>
                                <select class="form-control form-control-sm" id="vetement_idInput" name="vetement_id"
                                    required>
                                    <option value=""></option>
                                    @foreach ($vetements as $vetement)
                                        <option value="{{ $vetement->id }}">{{ $vetement->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="livrisonArticles mt-3">
                            <div id="article0" class="row  border border-success rounded p-2">


                                <div class="col-md-3">
                                    <label for="name" class="form-label">Taille </label>
                                    <input type="number" class="form-control form-control-sm" name="taille[]" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label">Qte </label>
                                    <input type="number" class="form-control form-control-sm" name="qte[]" required>
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
                                $(".livrisonArticles").append('<div class="row  border border-success rounded p-2 mt-2">' + $("#article0")
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
            Livrisons
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#livrisonModal">Ajouter un livrison </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tailleur</th>
                            <th>Vetement</th>
                            <th style="width: 150px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($livrisons as $livrison)
                            <tr>
                                <td>{{ $livrison->id }}</td>
                                <td class="name">{{ $livrison->tailleur?->name }} {{ $livrison->tailleur?->lname }}</td>
                                <td class="lname">{{ $livrison->vetement?->name }}</td>

                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $livrison->id }},this)"><i
                                            class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm text-danger"
                                        onclick="deleteLivrison({{ $livrison->id }},this)"><i
                                            class="fa-solid fa-trash"></i>
                                    </button>
                                    <a class="btn btn-sm text-primary" href="{{ route("livrisons.index")."/".$livrison->id }}"><i
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
        var myModalEl = document.getElementById('livrisonModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#livrisonForm').trigger("reset");
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
            $("#livrisonModal").modal("show");
            $("#livrisonForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteLivrison = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('livrisons/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#livrisonForm').submit(function(e) {
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
                url: '{{ route('livrisons.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#livrisonModal').modal('hide');

                    // reset the form fields
                    $('#livrisonForm input, #livrisonForm select').val('');

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
