<div class="nav-result-search" id="nav-result-search">

    @foreach ($products as $product)
        <li class="list-group-item list-search">
            <a href="#" data-toggle="modal" data-target="#perview-product"
            data-name="{{ $product->name }}"
            data-image="{{ $product->image_path }}"
            data-description="{{ $product->description }}"
            data-barcode="{{ $product->barcode }}"
            data-category="{{ $product->category->name }}"
            data-stock="{{ $product->stock }}"
                data-id="{{ $product->id }}"
                data-units="{{ $product->units }}"
                class="view-product-btn product-{{ $product->id }}">
                {{ $product->name }} | {{$product->barcode}}
        </a>
        </li>
    @endforeach

</div>
{{-- <script>
    $('#nav-result-search').loading('stop');
</script> --}}
