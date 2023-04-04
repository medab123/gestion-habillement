@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="tailleurModal" tabindex="-1" aria-labelledby="tailleurModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tailleurForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tailleurModalLabel">Créer un nouveau
 Tailleur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a tailleur -->
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control form-control-sm" id="nameInput" name="name"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="lname" class="form-label">Prenom</label>
                                <input type="text" class="form-control form-control-sm" id="lnameInput" name="lname"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Telephone</label>
                                <input type="text" class="form-control form-control-sm" id="telInput" name="tel"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label ">Address</label>
                                <input type="text" class="form-control form-control-sm" id="adresseInput" name="adresse"
                                    required>
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
    <div class="card">
        <div class="card-header">
            List des Tailleurs
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#tailleurModal">Ajouter un tailleur </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Tel</th>
                    
                            <th>Addresse</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($tailleurs as $tailleur)
                            <tr>
                                <td>{{ $tailleur->id }}</td>
                                <td class="name">{{ $tailleur->name }}</td>
                                <td class="lname">{{ $tailleur->lname }}</td>
                                <td class="tel">{{ $tailleur->tele }}</td>
                                <td class="adresse">{{ $tailleur->adresse }}</td>
                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $tailleur->id }},this)"><i
                                            class="fas fa-edit"></i>
                                        <button class="btn btn-sm text-danger"
                                            onclick="deleteTailleur({{ $tailleur->id }},this)"><i
                                                class="fa-solid fa-trash"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('tailleurModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#tailleurForm').trigger("reset");
        })
        const edit = (id, btn) => {
            var name = $(btn).parent().parent().children(".name").html()
            var lname = $(btn).parent().parent().children(".lname").html()
            var tel = $(btn).parent().parent().children(".tel").html()
            var tail = $(btn).parent().parent().children(".tail").html()
            var adresse = $(btn).parent().parent().children(".adresse").html()
            $("#nameInput").val(name);
            $("#lnameInput").val(lname);
            $("#telInput").val(tel);
            $("#adresseInput").val(adresse);
            $("#tailleurModal").modal("show");
            $("#tailleurForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteTailleur = (id, btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);

            $.get("{{ url('tailleurs/delete') }}" + "/" + id).then(() => {
                $(btn).parent().parent().remove()
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#tailleurForm').submit(function(e) {
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
                url: '{{ route('tailleurs.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    alert(response.message);
                    $('#tailleurModal').modal('hide');

                    // reset the form fields
                    $('#tailleurForm input, #tailleurForm select').val('');

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
