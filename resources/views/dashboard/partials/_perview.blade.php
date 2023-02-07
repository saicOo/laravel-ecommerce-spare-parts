<div class="modal fade" id="perview-product">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">نظرة عامة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none" ></h3>
                        <div class="col-12">
                            <img id="modal-image" src="{{ asset('uploads/default.png') }}"
                                class="product-image img-thumbnail" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3" id="modal-name-product"></h3>
                        <p><i class="fa fa-barcode" aria-hidden="true"></i> <b id="modal-barcode"></b></p>
                        <p id="modal-description"></p>
                        <hr>
                        <h4>@lang('site.category')</h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center" id="modal-category">

                            </label>
                        </div>

                        <h4 class="mt-3">@lang('site.stock')</small></h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="stock-all">

                        </div>

                        <div class="mt-4">

                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
