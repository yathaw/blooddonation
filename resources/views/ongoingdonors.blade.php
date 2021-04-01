<x-template>
	<!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pb-6">

            <div class="container">
                <div class="row flex-center">
                    <div class="col-12">
                        <h1 class="text-center beautiuni"> ယခုလှူနိုင်သူများ </h1>

                        <div class="table-responsive my-5">
                            <table class="table table-hover align-middle data-table " id="ongoingdonationsTable">
                                <thead class="text-center mmfont bg-soft-danger">
                                    <tr>
                                        <th class="py-3"> နံပါတ် </th>
                                        <th class="py-3"> အမည် </th>
                                        <th class="py-3"> သွေးအမျိုးအစား </th>
                                        <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                        <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                        <th class="py-3"> Action </th>

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

@section('script_content')
	<script type="text/javascript">
		
		$(document).ready(function() {

            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });


        	var table = $('#ongoingdonationsTable').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: {
				    url: "getOngoingdonations",
				    type: "GET"
				},
				columns: [
		            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
		            {data: 'name', name: 'name'},
		            {data: 'blood', name: 'blood'},
		            {data: 'lastdate', name: 'lastdate'},
		            {data: 'frequency', name: 'frequency'},
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


		    // DELETE
		    $('tbody').on('click', '.donateBtn', function () {

		        var id = $(this).data("id");
		        
		        var url="{{ route('ongoingdonors.donatenow', ':id') }}";
		        url=url.replace(':id',id);

		        Swal.fire({
		            title: 'ထိုသွေးအလှူရှင်သည်ယနေ့သွေးလှူဒါန်းပါမည်။',
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
		                        text: 'အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီs',
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
		                                type: "POST",
		                                dataType: 'json',
		                                success: function (data){
		                    				location.reload();
		                                    
		                                    
		                                }
		                            });
		                        }
		                    );

		                }
		            });
		    });

        });
        	
	</script>
@stop

</x-template>