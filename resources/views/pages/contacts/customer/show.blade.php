@extends('layouts.app') @section('title', 'Show Customer ') @section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-widget widget-user-2">
            @include('pages.contacts.customer.partials.make-transaction')
            @include('pages.contacts.customer.partials.customer-detailes')
            @include('pages.contacts.customer.partials.phone.phone')
        </div>
    </div>

    <div class="col-md-12">
        <div class="nav-tabs-custom" style="min-height:360px;">
            @include('pages.contacts.customer.partials.tabes')

            <div class="tab-content">
                @include('pages.contacts.customer.partials.account-table')
            </div>
            <form action="" id="delete_form" method="POST">
                @csrf
                @method('DELETE')
            </form>

        </div>
        @include('pages.contacts.customer.partials.clear-amount-modal')


</div>
@endsection

@section('script')
<script src="{{ asset('js/customer.js') }}"></script>
<script src="{{ asset('js/phone.js') }}"></script>


@endsection
