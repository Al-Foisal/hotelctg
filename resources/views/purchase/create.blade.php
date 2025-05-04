@extends('layouts.master')
@section('title','Purchase')
@section('css')
<style>
    .input-group-text-monetary {
        font-size: .8125rem;
        /* background-color: #9ba7ca;
        border: 1px solid #9ba7ca; */
        color: white;
        width: 15%;
        padding: 7px 0 0px 7px;
        font-weight: bolder;
        border-radius: 5px;
    }

    /*preloader css */
    .xloader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid blue;
        border-right: 16px solid green;
        border-bottom: 16px solid red;
        border-left: 16px solid pink;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endsection
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Purchase</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item">Purchase</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="alert alert-danger" id="em" style="display: none;">
        <span id="displayErrorMessage"></span>
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <b>Supplier Information</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="row">
                
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Supplier</label>
                    <select id="rBookingType" class="select2">
                        <option value="">select option</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }} - 
                                {{ $supplier->phone }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="invoiceNumber">Invoice Number</label>
                    <input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber" placeholder="Enter Invoice Number">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="invoiceFile">Upload Invoice File</label>
                    <input type="file" class="form-control" id="invoiceFile" name="invoiceFile" accept=".pdf,.jpg,.png">
                </div>
            </div>
        </div><!--end card-body-->
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <b>Room/Apartment Details</b>
            </div>
        </div><!--end card-header-->
        <div class="card-body" id="multipleSelectedAreaRoom">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Product</label>
                    <select class="select2 product" style="width: 100%;" onchange="getProductDetails(this)" data-url="{{route('getProductDetails')}}">
                        <option value="">select option</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} ({{ $product->productCategory->name??'' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Adult</label>
                    <input type="number" class="form-control rAdult" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Child</label>
                    <input type="number" class="form-control rChild" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Belonging Days</label>
                    <input type="number" class="form-control rBelongingDays" placeholder="0" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control rPrice" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="btn btn-info" onclick="addAnotherRoom(this)" style="margin-top: 1.7rem;">+</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row m-3">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="" style="background: #9ba7ca;">
                    <h3 class="text-center text-white fw-bolder">Monetary Calculation Area (BDT)</h3>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-primary" id="basic-addon1">
                            Total Amount
                        </span>
                        <input type="number" class="form-control" id="totalBillingAmount" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-secondary" id="basic-addon1">
                            Vat (%)
                        </span>
                        <input type="number" class="form-control" id="totalBillingVat" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-secondary" id="basic-addon1">
                            Discount
                        </span>
                        <input type="number" class="form-control" id="totalBillingDiscount" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                        <select id="totalBillingDiscountType" class="bg-warning" onchange="calculateTotalBillingAmount()">
                            <option value="Flat">Flat</option>
                            <option value="Percentage">Percentage</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-info" id="basic-addon1">
                            Subtotal
                        </span>
                        <input type="number" class="form-control" id="totalBillingSubtotal" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-success" id="basic-addon1">
                            Paid Amount
                        </span>
                        <input type="number" class="form-control" id="totalBillingPaidAmount" aria-describedby="basic-addon1" onkeyup="calculateTotalBillingAmount()">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-danger" id="basic-addon1">
                            Due
                        </span>
                        <input type="number" class="form-control" id="totalBillingDue" readonly aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text-monetary bg-warning" id="basic-addon1">
                            Changes
                        </span>
                        <input type="number" class="form-control" id="totalBillingChanges" readonly aria-describedby="basic-addon1">
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="m-3">
            <button type="button" class="btn btn-primary" style="float: right;" onclick="submitRoomReservation(this)" data-url="{{route('roomReservation.store')}}" id="submitBill" data-bs-toggle="modal" data-bs-target="#billFullScreenModal">Submit</button>
        </div>
    </div>
</div> <!-- end row -->
<!-- create new modal -->
@endsection

@section('js')
<script>
    var aaRoom = 1;

    function addAnotherRoom() {

        aaRoom++;
        var newRow = "";
        var cols = "";

        cols += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Type</label>
                    <select class="select2 rRoomOrApartmentType" style="width: 100%;" onchange="getROAByType(this)" data-url="{{route('roomReservation.getROAByType')}}">
                        <option value="">select option</option>
                        <option value="Room">Room</option>
                        <option value="Apartment">Apartment</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Room/Apartment Number</label>
                    <select class="select2 rRoomOrApartmentNumber" style="width: 100%;" onchange="getSingleRoomDetails(this)" data-url="{{route('roomReservation.getSingleRoomDetails')}}">
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Adult</label>
                    <input type="number" class="form-control rAdult" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Child</label>
                    <input type="number" class="form-control rChild" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Belonging Days</label>
                    <input type="number" class="form-control rBelongingDays" placeholder="0" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control rPrice" placeholder="0">
                </div>
                <div class="col-md-1 mb-3">
                    <button type="button" class="ibtnDel btn btn-danger del" style="margin-top: 1.8rem;">X</button>
                </div>
            </div>
        `;
        // newRow.append(cols);
        $("#multipleSelectedAreaRoom").append(cols);
        $(".select2").select2();
    }
    $("#multipleSelectedAreaRoom").on("click", ".ibtnDel", function(event) {
        $(this).closest(".row").remove();
    });

    function getROAByType(e) {

        var url = $(e).data('url');
        var type = $(e).val();

        var checkIn = $("#rCheckIn").val();
        var checkOut = $("#rCheckOut").val();


        $.ajax({
            url: url,
            type: "POST",
            data: {
                type: type,
                checkIn: checkIn,
                checkOut: checkOut,
            },
            dataType: "json",
            success: function(data) {
                $(e).parent().parent().find(".rRoomOrApartmentNumber").empty();
                var result = '<option value="">=select option=</option>';

                $.each(data, function(index, value) {
                    result += '<option value="' + value.id + '">' + 'R: ' + value.room_number + ' = ' + value.price + 'TK = ' + '(' + value.room_category.name + ')' + '</option>';
                })
                console.log($(e).parent().parent().find(".rRoomOrApartmentNumber"));

                $(e).parent().parent().find(".rRoomOrApartmentNumber").html(result);
            },
        });
    };

    function getSingleRoomDetails(e) {

        var url = $(e).data('url');
        var roomId = $(e).val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                roomId: roomId,
            },
            dataType: "json",
            success: function(data) {
                //days calculation

                let date1 = new Date($("#rCheckIn").val());
                let date2 = new Date($("#rCheckOut").val());

                let diffTime = Math.abs(date2 - date1);
                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                form_total = Math.ceil(diffDays * data.price);

                $(e).parent().parent().find(".rAdult").val(data.adult ?? 0);
                $(e).parent().parent().find(".rChild").val(data.child ?? 0);
                $(e).parent().parent().find(".rBelongingDays").val(diffDays ?? 0);
                $(e).parent().parent().find(".rPrice").val(form_total ?? 0);

                updateTotal();
            },
        });
    };


    function updateTotal() {
        let total = 0;
        $('.rPrice').each(function() {
            let price = parseFloat($(this).val());
            if (!isNaN(price)) {
                total += price;
            }
        });
        $('#total').text(total.toFixed(2));
        monetaryCalculation(total)
    }

    var totalBillingAmount = 0;
    var totalBillingVat = 0;
    var totalBillingVatAmount = 0;
    var totalBillingDiscount = 0;
    var totalBillingDiscountType = 'Flat';
    var totalBillingDiscountAmount = 0;
    var totalBillingSubtotal = 0;
    var totalBillingPaidAmount = 0;
    var totalBillingDue = 0;
    var totalBillingChanges = 0;

    function calculateTotalBillingAmount() {

        updateTotal();

    }

    function monetaryCalculation(total) {
        totalBillingAmount = Number(total);

        //vat calculation
        totalBillingVat = Number($("#totalBillingVat").val()) ?? 0;
        totalBillingVatAmount = Math.ceil((totalBillingAmount * totalBillingVat) / 100);

        //discount calculation
        totalBillingDiscount = Number($("#totalBillingDiscount").val()) ?? 0;
        totalBillingDiscountType = $("#totalBillingDiscountType").val() ?? 'Flat';
        if (totalBillingDiscount > 0 && totalBillingDiscountType === 'Flat') {
            totalBillingDiscountAmount = totalBillingDiscount;
        } else {
            totalBillingDiscountAmount = Math.ceil((totalBillingAmount * totalBillingDiscount) / 100);
        }


        totalBillingPaidAmount = Number($("#totalBillingPaidAmount").val()) ?? 0;

        totalBillingSubtotal = totalBillingAmount + Number(totalBillingVatAmount) - Number(totalBillingDiscountAmount);
        totalBillingDue = (totalBillingSubtotal - totalBillingPaidAmount) > 0 || totalBillingPaidAmount == 0 ? totalBillingSubtotal - totalBillingPaidAmount : 0;
        totalBillingChanges = (totalBillingPaidAmount - totalBillingSubtotal) > 0 ? totalBillingPaidAmount - totalBillingSubtotal : 0;

        $("#totalBillingAmount").val(totalBillingAmount);
        $("#totalBillingSubtotal").val(totalBillingSubtotal);
        $("#totalBillingDue").val(totalBillingDue);
        $("#totalBillingChanges").val(totalBillingChanges);
    }

    function submitRoomReservation(e) {

        var url = $(e).data('url');

        //reservation details
        var rCheckIn = $("#rCheckIn").val();
        var rCheckOut = $("#rCheckOut").val();
        var rArivalFrom = $("#rArivalFrom").val();
        var rBookingType = $("#rBookingType").val();
        var rBookingReference = $("#rBookingReference").val();
        var rBookingReferenceNumber = $("#rBookingReferenceNumber").val();
        var rPurposeOfVisit = $("#rPurposeOfVisit").val();
        var rRemarks = $("#rRemarks").val();

        //room or apartment details
        var rRoomOrApartmentType = [];
        var rRoomOrApartmentNumber = [];
        var rAdult = [];
        var rChild = [];
        var rBelongingDays = [];
        var rPrice = [];

        $(".rRoomOrApartmentType").each(function() {
            if ($(this).val() !== null && $(this).val() !== '') {
                rRoomOrApartmentType.push($(this).val());
            }
        });
        $(".rRoomOrApartmentNumber").each(function() {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rRoomOrApartmentNumber.push($(this).val());
            }
        });
        $(".rAdult").each(function() {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rAdult.push($(this).val());
            }
        });
        $(".rChild").each(function() {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rChild.push($(this).val());
            }
        });
        $(".rBelongingDays").each(function() {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rBelongingDays.push($(this).val());
            }
        });
        $(".rPrice").each(function() {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rPrice.push($(this).val());
            }
        });

        //customer info
        var rcName = $("#rcName").val();
        var rcEmail = $("#rcEmail").val();
        var rcPhone = $("#rcPhone").val();
        var rcCountry = $("#rcCountry").val();
        var rcState = $("#rcState").val();
        var rcCity = $("#rcCity").val();
        var rcGender = $("#rcGender").val();
        var rcAge = $("#rcAge").val();
        var rcAddress = $("#rcAddress").val();
        var rcTypeID = $("#rcTypeID").val();
        var rcIDNumber = $("#rcIDNumber").val();

        //other person information
        var rOPName = [];
        var rOPGender = [];
        var rOPAge = [];
        var rOPAddress = [];
        var rOPTypeID = [];
        var rOPIDNumber = [];

        $(".rOPName").each(function(typeIndex) {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rOPName.push($(this).val());
            }
        });
        $(".rOPGender").each(function(typeIndex) {
            if ($(this).val() != null && $(this).val().trim() != '') {
                rOPGender.push($(this).val());
            }
        });
        $(".rOPAge").each(function(typeIndex) {
            rOPAge.push($(this).val());
        });
        $(".rOPAddress").each(function(typeIndex) {
            rOPAddress.push($(this).val());
        });
        $(".rOPTypeID").each(function(typeIndex) {
            rOPTypeID.push($(this).val());
        });
        $(".rOPIDNumber").each(function(typeIndex) {
            rOPIDNumber.push($(this).val());
        });


        $.ajax({
            url: url,
            type: "POST",
            data: {
                rCheckIn: rCheckIn,
                rCheckOut: rCheckOut,
                rArivalFrom: rArivalFrom,
                rBookingType: rBookingType,
                rBookingReference: rBookingReference,
                rBookingReferenceNumber: rBookingReferenceNumber,
                rPurposeOfVisit: rPurposeOfVisit,
                rRemarks: rRemarks,

                total: totalBillingAmount,
                vat: totalBillingVat,
                vat_amount: totalBillingVatAmount,
                discount: totalBillingDiscount,
                discount_type: totalBillingDiscountType,
                discount_amount: totalBillingDiscountAmount,
                subtotal: totalBillingSubtotal,
                paid_amount: totalBillingPaidAmount,
                due: totalBillingDue,

                rRoomOrApartmentType: rRoomOrApartmentType,
                rRoomOrApartmentNumber: rRoomOrApartmentNumber,
                rAdult: rAdult,
                rChild: rChild,
                rBelongingDays: rBelongingDays,
                rPrice: rPrice,

                rcName: rcName,
                rcEmail: rcEmail,
                rcPhone: rcPhone,
                rcCountry: rcCountry,
                rcState: rcState,
                rcCity: rcCity,
                rcGender: rcGender,
                rcAge: rcAge,
                rcAddress: rcAddress,
                rcTypeID: rcTypeID,
                rcIDNumber: rcIDNumber,

                rOPName: rOPName,
                rOPGender: rOPGender,
                rOPAge: rOPAge,
                rOPAddress: rOPAddress,
                rOPTypeID: rOPTypeID,
                rOPIDNumber: rOPIDNumber,
            },
            dataType: "json",
            beforeSend: function(xhr) {
                $("#xbillingInvoice").html(`
                <div style="position: relative;left: 43%;">
                    <div class="xloader"></div>
                </div>`);
            },
            success: function(data) {
                if (data.status == true) {
                    alert(data.message);
                    location.reload();
                } else {
                    $("#em").show();
                    $("#displayErrorMessage").text(data.message);
                }
            },
        });
    };
</script>
@endsection