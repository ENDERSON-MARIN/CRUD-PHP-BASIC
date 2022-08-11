<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- DATATABLES -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"
    />

    <!-- BOOTSTRAP ICONS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/styles.css" />

    <!-- SWEET ALERT2 CSS -->
    <link
      rel="stylesheet"
      href="./assets/plugins/SweetAlert/dist/sweetalert2.min.css"
    />

    <title>Test PHP Basic</title>
  </head>
  <body>
    <div class="container bg-white">
      <h1 class="text-center" style="color: rgba(0, 96, 138)">
        TEST PHP BASIC
      </h1>

      <div class="row">
        <div class="col-2 offset-10">
          <div class="text-center">
            <!-- Button trigger modal -->
            <button
              type="button"
              class="btn btn-primary w-100"
              data-bs-toggle="modal"
              data-bs-target="#modalForm"
              id="btn-create"
            >
              <i class="bi bi-plus-circle-fill"></i> Create New
            </button>
          </div>
        </div>
      </div>

      <br />
      <br />

      <div class="table-responsive">
        <table id="person_data" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Names</th>
              <th>Surnames</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Image</th>
              <th>Create Date</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modalForm"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100 text-center" id="exampleModalLabel">
              FORM
            </h4>

            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="POST" id="person_form" enctype="multipart/form-data">
              <div class="modal-content">
                <strong><label for="names">Names</label></strong>
                <input
                  type="text"
                  name="names"
                  id="names"
                  class="form-control"
                  placeholder="Enter names"
                  required
                />
                <br />
                <strong><label for="surnames">Surnames</label></strong>
                <input
                  type="text"
                  name="surnames"
                  id="surnames"
                  class="form-control"
                  placeholder="Enter surnames"
                  required
                />
                <br />
                <strong><label for="email">Email</label></strong>
                <input
                  type="email"
                  name="email"
                  id="email"
                  class="form-control"
                  placeholder="Enter email"
                />
                <br />
                <strong><label for="phone">Phone</label></strong>
                <input
                  type="text"
                  name="phone"
                  id="phone"
                  class="form-control"
                  placeholder="Enter phone"
                />
                <br />
                <strong><label for="image">Image</label></strong>
                <input
                  type="file"
                  name="person_image"
                  id="person_image"
                  class="form-control"
                  placeholder="Select Image"
                />
                <span id="upload_image"></span>
                <br />

                <div class="modal-footer">
                  <input type="hidden" name="person_id" id="person_id" />
                  <input
                    type="hidden"
                    name="operation_type"
                    id="operation_type"
                  />
                  <input
                    type="submit"
                    name="action_type"
                    id="action_type"
                    class="btn btn-success w-100"
                    value="Send Form"
                  />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>

    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"
    ></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

    <!-- SWEET ALERT2 JS -->
    <script
      type="text/javascript"
      src="./assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"
    ></script>

    <script type="text/javascript">
      $(document).ready(function () {
        $("#btn-create").click(function () {
          $("#person_form")[0].reset();
          $("#exampleModalLabel").text("Create Person Form");
          $("#action_type").val("Create");
          $("#operation_type").val("Create");
          $("#upload_image").html("");
        });

        var dataTable = $("#person_data").DataTable({
          processing: true,
          serverSide: true,
          order: [],
          ajax: {
            url: "getAll.php",
            type: "POST",
          },
          columnsDefs: [
            {
              targets: [0, 3, 4],
              orderable: false,
            },
          ],
        });

        /*************************************CREATE***************************************/
        $(document).on("submit", "#modalForm", function (e) {
          e.preventDefault();
          var names = $("#names").val();
          var surnames = $("#surnames").val();
          var email = $("#email").val();
          var phone = $("#phone").val();
          var img_extension = $("#person_image")
            .val()
            .split(".")
            .pop()
            .toLowerCase();

          if (img_extension != "") {
            if (
              jQuery.inArray(img_extension, ["gif", "png", "jpg", "jpeg"]) == -1
            ) {
              Swal.fire({
                icon: "error",
                title: "Image fotmat invalid!",
                text: "Please check and try again!",
                confirmButtonColor: "green",
                confirmButtonText: "Ok!",
                showCancelButton: false,
                cancelButtonColor: "#d33",
                timer: 3000,
              });
              $("#person_image").val("");
              return false;
            }
          }

          if (names != "" && surnames != "" && email != "") {
            $.ajax({
              url: "create.php",
              method: "POST",
              data: new FormData(document.getElementById("person_form")),
              contentType: false,
              processData: false,
              success: function (data) {
                Swal.fire({
                  icon: "success",
                  title: "Saved!",
                  text: "Info saved successfully!",
                  confirmButtonColor: "green",
                  confirmButtonText: "Ok!",
                  showCancelButton: false,
                  cancelButtonColor: "#d33",
                  timer: 3000,
                });
                $("#person_form")[0].reset();
                $("#modalForm").modal("hide");
                dataTable.ajax.reload();
              },
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Fields are required!",
              text: "Please check and try again!",
              confirmButtonColor: "green",
              confirmButtonText: "Ok!",
              showCancelButton: false,
              cancelButtonColor: "#d33",
              timer: 3000,
            });
          }
        });
        /*************************************EDIT***************************************/
        $(document).on("click", ".edit", function () {
          var person_id = $(this).attr("id");
          $.ajax({
            url: "getOne.php",
            method: "POST",
            data: { person_id: person_id },
            dataType: "json",
            success: function (data) {
              //console.log(data);
              $("#modalForm").modal("show");
              $("#exampleModalLabel").text("Edit Person Form");
              $("#names").val(data.names);
              $("#surnames").val(data.surnames);
              $("#email").val(data.email);
              $("#phone").val(data.phone);
              $("#person_id").val(person_id);
              $("#upload_image").html(data.person_image);
              $("#action_type").val("Edit");
              $("#operation_type").val("Edit");
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            },
          });
        });
        /*************************************DELETE***************************************/
        $(document).on("click", ".delete", function () {
          var person_id = $(this).attr("id");
          Swal.fire({
            title: `Are you sure delete record id=${person_id}?`,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "green",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "delete.php",
                method: "POST",
                data: { person_id: person_id },
                success: function (data) {
                  Swal.fire({
                    icon: "success",
                    title: "Deleted!",
                    text: "Record deleted successfully!!",
                    confirmButtonColor: "green",
                    confirmButtonText: "Ok!",
                    showCancelButton: false,
                    cancelButtonColor: "#d33",
                    timer: 3000,
                  });
                  dataTable.ajax.reload();
                },
              });
            }
          });
        });
      });
    </script>
  </body>
</html>
