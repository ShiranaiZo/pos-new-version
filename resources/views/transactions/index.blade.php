@extends('layout')

@section('title', 'Transactions')

@section('css')
    <style>
        .scroll-vertical{
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <section class="section row col-md-12">
        <div class="col-md-8">
            <div class="card scroll-vertical">
                <div class="card-header">
                    <div class="input-group me-3">
                        <input type="text" class="form-control" name="search" placeholder="Search Product..." value="{{ old('search') }}" aria-label="Search Product..." aria-describedby="button-addon2">

                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body col-12">
                    @forelse ($products as $key_product => $product)
                        <div class="card col-md-4 border border-secondary" role="button">
                            <div class="card-body p-3">
                                <div class="stock">
                                    <p>Stocks: {{ $product->stock }}</p>
                                </div>

                                <div class="detail text-center">
                                    <img src="{{ asset($product->image ?? 'assets/images/samples/banana.jpg') }}" alt="" class="rounded-circle mx-auto d-block" width="75px" height="75px">
                                    <p>{{ $product->title }}</p>
                                    <p>{{ $product->description }}</p>
                                </div>

                                <div class="price text-center">
                                    {{ $product->price }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <p>Empty Products</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Order</h3>
                </div>

                <div class="card-body">
                    <div class="products-cart scroll-vertical" style="height: 200px">
                        <p class="text-center" style="line-height: 200px">Nothing Order</p>
                    </div>
                    <hr>
                    <div class="confirm-cart">
                        <div class="wrap-subtotal justify-content-between d-flex">
                            <p class="col-6">Price Sub Total</p>
                            <h4 class="col-6 text-end">Rp. 0</h4>
                        </div>

                        <div class="button-cart justify-content-between d-flex mt-2">
                            <button class="btn btn-outline-primary col-6 me-3">
                                Reset
                            </button>

                            <button class="btn btn-primary col-6">
                                Pay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Remove--}}
        <div class="modal fade text-left" id="modal_remove" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">Confirmation</h5>

                        <button type="button" class="close" data-bs-dismiss="modal"aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure want to remove this data?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">No</span>
                        </button>

                        <form action="" method="post" id="form_delete_user">
                            @method("DELETE")
                            @csrf

                            <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Yes</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- Modal Remove --}}
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // Init Datatable
            // $("#table_users").DataTable();
		});

        // Init Tooltip
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('#table_users .tooltip-class'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }, false);
    </script>
@endsection
