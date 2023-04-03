@extends('layouts.app')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="vetementModal" tabindex="-1" aria-labelledby="vetementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="vetementForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vetementModalLabel">Créer un nouveau
                            Vetement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input fields for creating or updating a vetement -->
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label ">Name</label>
                            <input type="text" class="form-control form-control-sm" id="nameInput" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label ">Type</label>
                            <select class="form-control form-control-sm" name="type_id" id="typeInput">
                                <option value="">choisir un type ..</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Type de vetement 
            <button class="btn btn-sm btn-success float-end text-white" data-bs-toggle="modal"
                data-bs-target="#vetementModal">Ajouter un type de vetement </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th style="width: 100px">Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($vetements as $vetement)
                            <tr>
                                <td>{{ $vetement->id }}</td>
                                <td class="name">{{ $vetement->name }}</td>
                                <td class="type">{{ $vetement->type?->name }}</td>
                                <td>
                                    <button class="btn btn-sm text-success" onclick="edit({{ $vetement->id }},this)"><i
                                            class="fas fa-edit"></i>
                                        <button class="btn btn-sm text-danger" onclick="deleteVetement({{ $vetement->id }},this)"><i class="fa-solid fa-trash"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('vetementModal')
        myModalEl.addEventListener('hide.bs.modal', function(event) {
            $("#hiddenId").remove();
            $('#vetementForm').trigger("reset");
        })
        const edit = (id, btn) => {
            var name = $(btn).parent().parent().children(".name").html()
            var type = $(btn).parent().parent().children(".type").html()

            $("#nameInput").val(name);
            $("#typeInput").find("option:contains('" + type + "')").prop("selected", true);
            $("#vetementModal").modal("show");
            $("#vetementForm").append("<input id='hiddenId' type='hidden' name='id' value='" + id + "'>")
            console.log(id, name);
        }
        const deleteVetement = (id,btn) => {
            $(btn).html(
                '<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>'
            ).attr('disabled', true);
            
            $.get("{{ url('vetements/delete') }}"+"/"+id).then((data)=>{
                $(btn).parent().parent().remove();
                alert(data.message);
            }).always(function(data) {
                alert(data.message);
            });
        }
        $('#vetementForm').submit(function(e) {
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
                url: '{{ route('vetements.save') }}',
                data: formData,
                success: function(response) {
                    // display a success message and close the modal
                    //alert(response.message);
                    $('#vetementModal').modal('hide');

                    // reset the form fields
                    $('#vetementForm input, #vetementForm select').val('');

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
