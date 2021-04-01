$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.extend( true, $.fn.dataTable.defaults, {
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'blood', name: 'blood'},
            {data: 'lastdate', name: 'lastdate'},
            {data: 'frequency', name: 'frequency'},

            {data: 'user', name: 'user'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        destroy:true,
        language: {
           oPaginate: {
                sNext: '<i class="icofont-rounded-right"></i>',
                sPrevious: '<i class="icofont-rounded-left"></i>',
                sFirst: '<i class="icofont-rounded-double-left"></i>',
                sLast: '<i class="icofont-rounded-double-right"></i>'
            }
        } ,

        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'colvis',
                columns: [0, 1, 2,3,4,5],

                collectionLayout: "fixed two-column",
                    collectionTitle: "Select Columns to Display",
                    postfixButtons: ["colvisRestore"],
                    columnText: function(dt, idx, title) {
                        // console.log(idx != 5);
                            return idx + 1 + ": " + title;
                    }
                },
            
            {
                extend: 'pdfHtml5',
                title: 'AB Donation List',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ ':visible:not(:last-child)' ]
                },
                customize: function ( pdf ){

                    pdf.content[1].ABtable.widths = Array(pdf.content[1].ABtable.body[0].length + 1).join('*').split('');
                    pdf.content[1].Otable.widths = Array(pdf.content[1].Otable.body[0].length + 1).join('*').split('');
                    pdf.content[1].Atable.widths = Array(pdf.content[1].Atable.body[0].length + 1).join('*').split('');
                    pdf.content[1].Btable.widths = Array(pdf.content[1].Btable.body[0].length + 1).join('*').split('');

                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

                    pdf['header']=(function() {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: 'စေတနာရှင်လူငယ်အခမဲ့ သွေးလှူအသင်း',
                                    fontSize: 9,
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 7,
                                    text: 'ကန့်ဘလူမြို့'
                                }
                            ],
                            margin: 20
                        }
                    });

                    pdf['footer']=(function(page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Created on: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });

                }
            },

            {
                extend: 'print',
                title: 'စေတနာရှင်လူငယ်အခမဲ့ သွေးလှူအသင်း',
                messageTop: function() {
                    return '\r\n <p style="text-align:center"> ကန့်ဘလူမြို့ </p>' +
                           '\r\n <h2> AB Donation List </h2>'
                },
                messageBottom: 'စေတနာရှင်လူငယ်အခမဲ့ သွေးလှူအသင်း <p> ကန့်ဘလူမြို့ </p>',
                exportOptions: {
                    columns: [ ':visible:not(:last-child)' ]
                },
                customize: function ( print ){

                    $(print.document.body).find('h1').css('text-align', 'center');

                    // $('tfoot tr th').attr('colspan',2);
                    $('row c[r*="10"]', print).attr( 's', '25' );
                }
            },
        ]
    } );

	// READ
    var ABtable = $('#ABlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: getlistABDonors,
        
    });

    var Otable = $('#OlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: getlistODonors,
        
    });

    var Atable = $('#AlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: getlistADonors,
        
    });

    var Btable = $('#BlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: getlistBDonors,
        
    });

    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-outline-primary mr-1');

    $('.buttons-print').find('span').html('<i class="icofont-print"></i> Print ');
    $('.buttons-pdf').find('span').html('<i class="icofont-file-pdf"></i> PDF ');
    $('.buttons-csv').find('span').html('<i class="icofont-file-word"></i> CSV ');
    $('.buttons-excel').find('span').html('<i class="icofont-file-excel"></i> Excel ');


    $('.createBtn').on('click', function(){
        $("#showModal").modal("show");
        
        $("form").attr('id', 'addForm');

    });

    // DETAIL
    $('tbody').on('click', '.detailBtn', function (){
        console.log('a');
        var name = $(this).data('name');
        var blood = $(this).data('blood');
        var dob = $(this).data('dob');
        var lastdate = $(this).data('lastdate');
        var count = $(this).data('count');
        var address = $(this).data('address');
        var dods_str = $(this).data('dods');
        var phone = $(this).data('phone');

        var dods_arr = dods_str.split("|");

        console.log(dods_arr);

        $('#donorDetail').text(name);
        $('#bloodText').text(blood);

        $('#countText').text(count);
        $('#phoneText').text(phone);
        $('#dobText').text(dob);
        $('#lodText').text(lastdate);
        $('#addressText').text(address);

        var html = '';
        $.each(dods_arr,function (i,v) {
            html +=`<div class="list-group-item col-4"> ${v}</div>`;
        })

        $('#dodsText').html(html);

        $("#detailModal").modal("show");

        
        // $('#editModal').modal();
    });

    // CREATE
    $("#showModal").on('submit','#addForm',function(e){
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: storeDonor,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {  
                // jQuery.noConflict();

                $("#showModal").modal("hide");

                Swal.fire({
                    title: 'SUCCESS !',
                    text: 'အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ',
                    icon: 'success',
                    showConfirmButton: false,
                    timer : 1500
                })

                $('#addForm').trigger("reset");
                ABtable.draw();
                Otable.draw();
                Atable.draw();
                Btable.draw();


                $('.err_name').remove();
                $('.err_email').remove();
                $('.err_password').remove();
                $('.err_phone').remove();
                $('.err_blood').remove();
                $('.err_address').remove();

                $('#inputName').removeClass('border border-danger');
                $('#inputEmail').removeClass('border border-danger');
                $('#inputPassword').removeClass('border border-danger');
                $('#inputPhone').removeClass('border border-danger');
                $('#inputAddress').removeClass('border border-danger');

            },
            error: function(error){
                var message=error.responseJSON.message;
                var err=error.responseJSON.errors;

                $.each(err, function( key, value ) {
                    // console.log(key);

                    if (key == "name") 
                    {
                        $('.err_name').html(err[key]);
                        $('#inputName').addClass('border border-danger');
                    }

                    if (key == "email") 
                    {
                        $('.err_email').html(err[key]);
                        $('#inputEmail').addClass('border border-danger');
                    } 

                    if (key == "password") 
                    {
                        $('.err_password').html(err[key]);
                        $('#inputPassword').addClass('border border-danger');
                    } 

                    if (key == "phone") 
                    {
                        $('.err_phone').html(err[key]);
                        $('#inputPhone').addClass('border border-danger');
                    }

                    if (key == "blood") 
                    {
                        $('.err_blood').html(err[key]);
                    }

                    if (key == "address") 
                    {
                        $('.err_address').html(err[key]);
                        $('#inputAddress').addClass('border border-danger');
                    }

                });
                //console.log(error.responseJSON.errors);
                
                
            }
        });
    });

    // EDIT
    $('tbody').on('click', '.editBtn', function (){

        var id = $(this).data('donorid');
        var name = $(this).data('name');
        var dob = $(this).data('dob');
        var address = $(this).data('address');
        var phone = $(this).data('phone');
        var bloodsign = $(this).data('bloodsign');
        var bloodid = $(this).data('bloodid');

        $('.hideDiv').hide();

        $('#inputId').val(id);
        $('#inputName').val(name);
        $('#inputDob').val(dob);
        $('#inputAddress').val(address);
        $('#inputPhone').val(phone);

        $("input[name=blood][value=" + bloodid + "]").attr('checked', 'checked');

        $("form").attr('id', 'editForm');

        $("#showModal").modal("show");
        // $('#editModal').modal();
    });

    // UPDATE
    $("#showModal").on('submit','#editForm',function(e){
        e.preventDefault();
        
        var formData = new FormData(this);

        var id = $('#inputId').val();
        
        var url=editDonor;
        url=url.replace(':id',id);

        $.ajax({
            type:'POST',
            dataType: 'json',
            url: url,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data){

                $("#showModal").modal("hide");
                $('#editForm').trigger("reset");
                ABtable.draw();
                Otable.draw();
                Atable.draw();
                Btable.draw();

                Swal.fire({
                    title: 'SUCCESS !',
                    text: 'အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ',
                    icon: 'success',
                    showConfirmButton: false,
                    timer : 1500
                })

            },
            error: function(error){
                // console.log(error.responseJSON.errors);
            }
        });

        
    });

    // DELETE
    $('tbody').on('click', '.deleteBtn', function () {

        var id = $(this).data("donorid");
        
        var url=deleteDonor;
        url=url.replace(':id',id);

        Swal.fire({
            title: 'ထိုသွေးအလှူရှင်ကို စာရင်းမှပယ်ဖျက်မည်',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#74b72e',
            cancelButtonColor: '#d33',
            confirmButtonText: 'သေချာပါသည်',
            cancelButtonText: 'မသေချာပါ'

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'SUCCESS !',
                        text: 'အောင်မြင်စွာဖျက်သိမ်းပြီးပါပြီ',
                        icon: 'success',
                        showConfirmButton: false,
                        timer : 1500
                    }).then(
                        function()
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: url,
                                type: "DELETE",
                                dataType: 'json',
                                success: function (data){
                                    ABtable.draw();
                                    Otable.draw();
                                    Atable.draw();
                                    Btable.draw();
                                }
                            });
                        }
                    );
                }
            });
    });

});