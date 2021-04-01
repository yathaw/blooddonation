<x-template>

	<!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pb-6">

        <div class="container">
            <div class="row flex-center">
                <div class="col-12">
                    <h1 class="text-center beautiuni"> လှူဒါန်းမှုမှတ်တမ်း </h1>

                    <button class="mmfont btn btn-lg btn-danger hover-top btn-glow float-end createBtn">
                        <i class="icofont-plus"></i> အလှူရှင်အသစ်
                    </button>
                </div>
                <div class="col-10 justify-content-center">
                        
                    <div class="input-group my-4">
                        <input type="date" class="form-control form-control-lg" placeholder="Start Date" id="sdate">
                        <input type="date" class="form-control form-control-lg" placeholder="End Date" id="edate">
                        <button class="btn btn-dark searchBtn" type="button"><i class="icofont-search-2 pe-2"></i> ရှာဖွေမည်  </button>

                    </div>

                </div>

                <div class="col-12" id="donationsearchDiv">
                	<h5 id="searchTitle">  </h5>
                	<div class="table-responsive my-5">
                            <table class="table table-hover align-middle data-table" id="donationsTable">
                                <thead class="text-center mmfont bg-soft-danger">
                                    <tr>
                                        <th class="py-3"> နံပါတ် </th>
                                        <th class="py-3"> အမည် </th>
                                        <th class="py-3"> သွေးအမျိုးအစား </th>
                                        <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                        <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                </div>
                
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

<!-- Add Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="staticBackdropLabel"> သွေးလှူဒါန်းမှုအသစ် </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
	            <div class="modal-body mmfont row g-3">
                    <div class="form-floating col-12">
                        <select class="form-select select2 form-control-lg mmfont" id="inputDonor" aria-label="Floating label select example" name="donor">
                            <option></option>
                        </select>

                        <small class="err_donor error text-danger mmfont">  </small>

                    </div>

                    <div class="form-floating col-12">
                        <input type="date" class="form-control mmfont" id="inputDod" placeholder="" name="dod">
                        <label for="inputDod" class="mmfont"> လှူဒါန်းသည့်ရက်ဆွဲ </label>

                        <small class="err_dod error text-danger mmfont">  </small>

                    </div>

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-dark mmfont" data-bs-dismiss="modal"> ပိတ်မည် </button>
	                <button type="submit" class="btn btn-primary mmfont"> သိမ်းမည် </button>
	            </div>
            </form>

        </div>
    </div>
</div>
@section('script_content')
	<script type="text/javascript">
		
		$(document).ready(function() {

            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

            $('.select2').select2({
                width: '100%',
                placeholder: 'လှူဒါန်းသူ အမည်',
                ajax: {
                    url: '/getDonors',
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {
                        console.log(response);
                        return {
                            results: $.map(response, function (item) {
                                return {
                                    text: item.user.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('.createBtn').on('click', function(){
		        $("#addModal").modal("show");
		        
		        $("form").attr('id', 'addForm');


		    });

            // CREATE
		    $("#addModal").on('submit','#addForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        $.ajax({
		            type:'POST',
		            url: "{{ route('donations.store') }}",
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: (data) => {  
		                // jQuery.noConflict();

		                $("#addModal").modal("hide");

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


		                $('.err_donor').remove();
		                $('.err_dod').remove();

		                $('#inputDonor').removeClass('border border-danger');
		                $('#inputDod').removeClass('border border-danger');

		            },
		            error: function(error){
		                var message=error.responseJSON.message;
		                var err=error.responseJSON.errors;

		                $.each(err, function( key, value ) {
		                    // console.log(key);

		                    if (key == "donor") 
		                    {
		                        $('.err_donor').html(err[key]);
		                        $('#inputDonor').addClass('border border-danger');
		                    }

		                    if (key == "dod") 
		                    {
		                        $('.err_dod').html(err[key]);
		                        $('#inputDod').addClass('border border-danger');
		                    } 

		                    

		                });
		                //console.log(error.responseJSON.errors);
		                
		                
		            }
		        });
		    });


		    $('.searchBtn').on('click', function(){
		        var sdate = $("#sdate").val();
		        var edate = $("#edate").val();

		        $('#donationsearchDiv').show();



		        $title = `${dateFormat(sdate)} မှ ${dateFormat(edate)} အတွင်း သွေးလှူဒါန်းထားသူများ`;
		        $('#searchTitle').html($title);

            	var table = $('#donationsTable').DataTable({
			        processing: true,
			        serverSide: true,
			        ajax: {
					    url: "getDonations_bydate",
					    type: "POST",
					    data: {
			                sdate: sdate,
			                edate: edate,
			            }
					},
					columns: [
			            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
			            {data: 'name', name: 'name'},
			            {data: 'blood', name: 'blood'},
			            {data: 'lastdate', name: 'lastdate'},
			            {data: 'frequency', name: 'frequency'},
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
			                columns: [0, 1, 2,3,4],

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

			                    pdf.content[1].table.widths = Array(pdf.content[1].table.body[0].length + 1).join('*').split('');
			                    

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
			        
			    });

				$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-outline-primary mr-1');

			    $('.buttons-print').find('span').html('<i class="icofont-print"></i> Print ');
			    $('.buttons-pdf').find('span').html('<i class="icofont-file-pdf"></i> PDF ');
			    $('.buttons-csv').find('span').html('<i class="icofont-file-word"></i> CSV ');
			    $('.buttons-excel').find('span').html('<i class="icofont-file-excel"></i> Excel ');


		    });

			function dateFormat(date){

				return new Date(date).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit'}); // 08/19/2020 (month and day with two digits)

			}
        });
        	
	</script>
@stop



</x-template>