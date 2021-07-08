<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User</title>
        <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
                integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
                crossorigin="anonymous"
                referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
        <section>
            <div class="container" style="padding: 1rem">
                <div class="col-span-2 sm:col-span-1 flex justify-between sm:justify-start items-stretch space-x-3">
                    <div class="w-3/5">
                      <input type="text" class="form-control border-gray rounded-0" id="searchDevices" placeholder="Input word to search">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 8px; margin-bottom: 3px">
                      <span><i class="fas fa-search"></i></span> Search
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="tableID">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
       $(document).ready( function() {
            console.log('Hello there');
        var table =  $('#tableID').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                dom: 'lrtip',
                lengthChange: false,
                ajax: "{{ route('new.user') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                "language": {
                        "sEmptyTable":     "មិនមានទិន្នន័យក្នុងតារាងនេះទេ",
                        "sInfo":           "បង្ហាញជួរទី _START_ ដល់ទី _END_ ក្នុងចំណោម _TOTAL_ ",
                        "sInfoEmpty":      "បង្ហាញជួរទី 0 ដល់ទី 0 ក្នុងចំណោម 0 ជួរ",
                        "sInfoFiltered":   "",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "បង្ហាញ _MENU_ ជួរ",
                        "sLoadingRecords": "កំពុងផ្ទុក...",
                        "sProcessing":     "កំពុងដំណើរការ...",
                        "sSearch":         "ស្វែងរក:",
                        "sZeroRecords":    "មិនមានទិន្នន័យត្រូវតាមលក្ខខណ្ឌស្វែងរកទេ",
                        "oPaginate": {
                            "sFirst":    "ដំបូងគេ",
                            "sLast":     "ចុងក្រោយ",
                            "sNext":     "បន្ទាប់",
                            "sPrevious": "ក្រោយ"
                        },
                        "oAria": {
                            "sSortAscending":  ": ចុចដើម្បីរៀបជួរឈរនេះតាមលំដាប់ឡើង",
                            "sSortDescending": ": ចុចដើម្បីរៀបជួរឈរនេះតាមលំដាប់ចុះ"
                        }
                },
            });

            $('#searchDevices').on( 'keyup', function () {
                console.log("on key up work"+this.value);
                table.search(this.value).draw();
            });
        });
    </script>
</html>
