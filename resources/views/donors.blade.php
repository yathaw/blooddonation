<x-template>
	<!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="pb-6">

            <div class="container">
                <div class="row flex-center">
                    <div class="col-12">
                        <h1 class="text-center beautiuni"> အလှူရှင်များ </h1>

                        <button class="mmfont btn btn-lg btn-danger hover-top btn-glow float-end createBtn" >
                            <i class="icofont-plus"></i> အလှူရှင်အသစ်
                        </button>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active mmfont" id="nav-AB-tab" data-bs-toggle="tab" data-bs-target="#nav-AB" type="button" role="tab" aria-controls="nav-AB" aria-selected="true"> AB သွေး </button>
                                <button class="nav-link mmfont" id="nav-O-tab" data-bs-toggle="tab" data-bs-target="#nav-O" type="button" role="tab" aria-controls="nav-O" aria-selected="false"> O သွေး </button>
                                <button class="nav-link mmfont" id="nav-A-tab" data-bs-toggle="tab" data-bs-target="#nav-A" type="button" role="tab" aria-controls="nav-A" aria-selected="false"> A သွေး </button>

                                <button class="nav-link mmfont" id="nav-B-tab" data-bs-toggle="tab" data-bs-target="#nav-B" type="button" role="tab" aria-controls="nav-B" aria-selected="false"> B သွေး </button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-AB" role="tabpanel" aria-labelledby="nav-AB-tab">
                                <div class="table-responsive my-5">
                                    <table class="table table-hover align-middle data-table" id="ABlistTable" style="width: 100%">
                                        <thead class="text-center mmfont bg-soft-danger">
                                            <tr>
                                                <th class="py-3"> နံပါတ် </th>
                                                <th class="py-3"> အမည် </th>
                                                <th class="py-3"> သွေးအမျိုးအစား </th>
                                                <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                                <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                                <th class="py-3"> Created By </th>
                                                <th class="py-3"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-O" role="tabpanel" aria-labelledby="nav-O-tab">
                                <div class="table-responsive my-5">
                                    <table class="table table-hover align-middle data-table" id="OlistTable" style="width: 100%">
                                        <thead class="text-center mmfont bg-soft-danger">
                                            <tr>
                                                <th class="py-3"> နံပါတ် </th>
                                                <th class="py-3"> အမည် </th>
                                                <th class="py-3"> သွေးအမျိုးအစား </th>
                                                <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                                <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                                <th class="py-3"> Created By </th>
                                                <th class="py-3"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-A" role="tabpanel" aria-labelledby="nav-A-tab">
                                <div class="table-responsive my-5">
                                    <table class="table table-hover align-middle data-table" id="AlistTable" style="width: 100%">
                                        <thead class="text-center mmfont bg-soft-danger">
                                            <tr>
                                                <th class="py-3"> နံပါတ် </th>
                                                <th class="py-3"> အမည် </th>
                                                <th class="py-3"> သွေးအမျိုးအစား </th>
                                                <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                                <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                                <th class="py-3"> Created By </th>
                                                <th class="py-3"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-B" role="tabpanel" aria-labelledby="nav-B-tab">
                                <div class="table-responsive my-5">
                                    <table class="table table-hover align-middle data-table" id="BlistTable" style="width: 100%">
                                        <thead class="text-center mmfont bg-soft-danger">
                                            <tr>
                                                <th class="py-3"> နံပါတ် </th>
                                                <th class="py-3"> အမည် </th>
                                                <th class="py-3"> သွေးအမျိုးအစား </th>
                                                <th class="py-3"> နောက်ဆုံးလှူခဲ့သည့်ရက်ဆွဲ </th>
                                                <th class="py-3"> လှူဒါန်းခဲ့သည့်အကြိမ်ရေ </th>
                                                <th class="py-3"> Created By </th>
                                                <th class="py-3"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                    
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->

<!-- Add Modal -->
<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="staticBackdropLabel">သွေးအလှူရှင်အသစ် </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" g-3">
            	<input type="hidden" name="id" id="inputId">
	            <div class="modal-body mmfont row">
	                    <div class="form-floating col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-2">
	                        <input type="text" class="form-control mmfont" id="inputName" name="name">
	                        <label for="inputName" class="mmfont"> အမည် </label>

                            <small class="err_name error text-danger mmfont">  </small>

	                    </div>


	                    <div class="form-floating col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-2">
	                        <input type="date" class="form-control mmfont" id="inputDob" name="dob">
	                        <label for="inputDob" class="mmfont"> မွေးသက္ကရာဇ် </label>

                            <small class="err_dob error text-danger mmfont">  </small>

	                    </div>

	                    <div class="form-floating col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-2 hideDiv">
	                        <input type="email" class="form-control mmfont" id="inputEmail" name="email">
	                        <label for="inputEmail" class="mmfont"> အီးမေးလ် </label>

                            <small class="err_email error text-danger mmfont">  </small>

	                    </div>

	                    <div class="form-floating col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 my-2 hideDiv">
	                        <input type="password" class="form-control mmfont" id="inputPassword" name="password">
	                        <label for="inputPassword" class="mmfont"> စကားဝှက် </label>

                            <small class="err_password error text-danger mmfont">  </small>

	                    </div>

	                    <div class="form-floating col-12 my-2">
	                        <input type="number" class="form-control mmfont" id="inputPhone" name="phone">
	                        <label for="inputPhone" class="mmfont"> ဖုန်းနံပါတ် </label>

                            <small class="err_phone error text-danger mmfont">  </small>

	                    </div>


	                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-5 my-2">
	                        <p class="mmfont"> Positive  သွေးများ</p>
	                        @foreach($positivebloods as $positiveblood)
		                        <div class="form-check">
		                            <input class="form-check-input" type="radio" name="blood" id="{{ $positiveblood->id }}_p" value="{{ $positiveblood->id }}">
		                            <label class="form-check-label" for="{{ $positiveblood->id }}_p">
		                                {{ $positiveblood->type }}
		                            </label>
		                        </div>
	                        @endforeach

	                    </div>

	                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ps-5 my-2">
	                        <p class="mmfont"> Negative  သွေးများ</p>
	                        @foreach($negativebloods as $negativeblood)
		                        <div class="form-check">
		                            <input class="form-check-input" type="radio" name="blood" id="{{ $negativeblood->id }}_p" value="{{ $negativeblood->id }}">
		                            <label class="form-check-label" for="{{ $negativeblood->id }}_p">
		                                - {{ $negativeblood->type }}
		                            </label>
		                        </div>
	                        @endforeach

	                    </div>

	                    <div class="col-12">
                            <small class="err_blood error text-danger mmfont">  </small>
	                    </div>

	                    <div class="form-floating col-12 my-2">
	                        <textarea class="form-control" name="address" id="inputAddress" style="height: 70px"></textarea>
	                        <label for="inputAddress" class="mmfont">နေရပ်လိပ်စာ</label>

                            <small class="err_address error text-danger mmfont">  </small>

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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="donorDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="donorDetail"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mmfont">
                <nav class="mb-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active mmfont" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"> ကိုယ်ရေးအချက်အလက် </button>
                        <button class="nav-link mmfont" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> လှူဒါန်းခဲ့သည့်အကြိမ်  
                            <span class="badge rounded-pill bg-danger" id="countText"></span> 
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row g-5">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="border-xl-end d-flex justify-content-md-start">
                                    <div class="mx-2 mx-md-0 me-md-5">
                                        <div class="badge badge-circle bg-soft-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 290.75 290.75" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                                <path xmlns="http://www.w3.org/2000/svg" d="M145.375,0c0,0-104.75,117.481-104.75,186c0,57.852,46.898,104.75,104.75,104.75s104.75-46.898,104.75-104.75  C250.125,117.481,145.375,0,145.375,0z M166.301,254.189c27.903-11.675,47.805-42.119,47.805-77.85  c0-26.682-17.666-62.727-35.617-92.483c17.973,26.116,45.549,71.13,45.549,101.516C224.037,222.3,198.439,252.441,166.301,254.189z" fill="#f53838" data-original="#000000" style="" class=""/>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-bolder text-1000 mb-0" id="bloodText"> </p>
                                        <p class="mb-0 mmfont text-muted">  သွေးအမျိုးအစား </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="d-flex justify-content-md-center">
                                    <div class="mx-2 mx-md-0 me-md-5">
                                        <div class="badge badge-circle bg-soft-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 387.2 387.2" style="enable-background:new 0 0 512 512" xml:space="preserve"><g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <path d="M304.8,10.84l0-0.04C297.927,3.891,288.585,0.004,278.84,0H108.32C88.067,0.066,71.666,16.467,71.6,36.72v313.72    c0.004,9.745,3.891,19.087,10.8,25.96c6.863,6.899,16.189,10.785,25.92,10.8h170.56c9.731-0.015,19.057-3.901,25.92-10.8    c6.899-6.863,10.785-16.189,10.8-25.92V36.76C315.585,27.029,311.699,17.703,304.8,10.84z M193.6,362.28L193.6,362.28    c-5.479,0-9.92-4.441-9.92-9.92c0-5.479,4.441-9.92,9.92-9.92c5.479,0,9.92,4.441,9.92,9.92    C203.52,357.839,199.079,362.28,193.6,362.28z M286.44,300c0,13.255-10.745,24-24,24H124.72c-13.255,0-24-10.745-24-24V66.2    c0-13.255,10.745-24,24-24h137.76c13.255,0,24,10.745,24,24L286.44,300z" fill="#f53838" data-original="#000000" style=""/>
                                                    </g>
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                </g>
                                                </g>
                                            </svg>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-bolder text-1000 mb-0" id="phoneText"> </p>
                                        <p class="mb-0 mmfont text-muted">  ဆက်သွယ်ရန်ဖုန်းနံပါတ် </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="border-xl-end d-flex justify-content-md-start">
                                    <div class="mx-2 mx-md-0 me-md-5">
                                        <div class="badge badge-circle bg-soft-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg" id="XMLID_897_"><path id="XMLID_991_" d="m405 30v60h-30v-60h-60v60h-30v-60h-60v60h-30v-60h-60v60h-30v-60h-105v90h510v-90z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1005_" d="m105 0h30v30h-30z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1006_" d="m195 0h30v30h-30z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1007_" d="m285 0h30v30h-30z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1008_" d="m375 0h30v30h-30z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1009_" d="m255 269.033c8.262 0 14.984-6.713 15-14.971-.256-3.647-6.817-12.172-15.004-20.121-8.263 7.997-14.754 16.446-14.997 20.135.001 8.228 6.73 14.957 15.001 14.957z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1010_" d="m165 344.033h180v30h-180z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1019_" d="m0 510h510v-360h-510zm105-135.967h30v-60h105v-17.58c-17.459-6.192-30-22.865-30-42.42 0-25.21 32.99-49.193 45-59.033 6.689 5.48 45 31.941 45 59.033 0 19.555-12.541 36.228-30 42.42v17.58h105v60h30v90h-300z" fill="#f53838" data-original="#000000" style=""/><path id="XMLID_1020_" d="m135 404.033h240v30h-240z" fill="#f53838" data-original="#000000" style=""/></g></g>
                                            </svg>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-bolder text-1000 mb-0" id="dobText"></p>
                                        <p class="mb-0 mmfont text-muted">  မွေးသက္ကရာဇ် </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="d-flex justify-content-md-center">
                                    <div class="mx-2 mx-md-0 me-md-5">
                                        <div class="badge badge-circle bg-soft-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg" id="XMLID_1518_"><path id="XMLID_1524_" d="m405 30v60h-30v-60h-60v60h-30v-60h-60v60h-30v-60h-60v60h-30v-60h-105v90h510v-90z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1665_" d="m105 0h30v30h-30z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1667_" d="m195 0h30v30h-30z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1672_" d="m285 0h30v30h-30z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1673_" d="m375 0h30v30h-30z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1676_" d="m255 434.188c46.869 0 85-38.131 85-85 0-35.945-57.116-91.321-84.997-115.419-27.736 23.978-85.003 79.517-85.003 115.419 0 46.869 38.131 85 85 85zm-45-90h30v-30h30v30h30v30h-30v30h-30v-30h-30z" fill="#f53838" data-original="#000000" style="" class=""/><path id="XMLID_1679_" d="m0 510h510v-360h-510zm255-315c.091.101 115 87.298 115 154.188 0 63.412-51.589 115-115 115s-115-51.588-115-115c0-66.89 114.909-154.087 115-154.188z" fill="#f53838" data-original="#000000" style="" class=""/></g></g></svg>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-bolder text-1000 mb-0" id="lodText"> </p>
                                        <p class="mb-0 mmfont text-muted">  နောက်ဆုံးလှူခဲ့သည့်ရက် </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-md-start">
                                    <div class="mx-2 mx-md-0 me-md-5">
                                        <div class="badge badge-circle bg-soft-danger">
                                            <svg class="bi bi-geo-alt-fill" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#F53838" viewBox="0 0 16 16">
                                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"></path>
                                            </svg>

                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-bolder text-1000 mb-0 mmfont" id="addressText"> </p>
                                        <p class="mb-0 mmfont text-muted">  နေရပ်လိပ်စာ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-12 " >
                                <div class="list-group list-group-horizontal" id="dodsText"></div>
                                    
                            </div>
                        </div>

                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark mmfont" data-bs-dismiss="modal"> ပိတ်မည် </button>
            </div>
        </div>
    </div>
</div>

@section('script_content')
	<script type="text/javascript">
		var getlistABDonors;
		var getlistODonors;
		var getlistADonors;
		var getlistBDonors;

		var storeDonor;
		var editDonor;
		var deleteDonor;


		$(document).ready(function() {

            getlistABDonors = "{{ route('getlistABDonors') }}";
            storeDonor = "{{ route('donors.store') }}";
            editDonor = "{{route('donors.update',':id')}}";
            deleteDonor = "{{route('donors.destroy',':id')}}";

            getlistODonors ="{{ route('getlistODonors') }}";
            getlistADonors ="{{ route('getlistADonors') }}";
            getlistBDonors ="{{ route('getlistBDonors') }}";


        });
        	
	</script>
	<script type="text/javascript" src="{{ asset('assets/js/donors.js') }}"></script>
@stop

</x-template>