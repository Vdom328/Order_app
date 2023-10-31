<footer>
    <div class="model-buy">
        <a href="" class="route_home model-buy1 text-decoration-none d-flex flex-column lign-items-center justify-content-center">
            <span class="fa fa-home "></span>
            <span class="model-cs">Home</span>
        </a>
        <a href="" class="route_table model-buy1 text-decoration-none d-flex flex-column lign-items-center justify-content-center">
            <span class="fa fa-table"></span>
            <span class="model-cs">Table</span>
        </a>
        <a href="{{ route('client.getListCart') }}" class="model-buy-2 text-decoration-none" >
            <div class="cart-number">
                <span class=" fa fa-shopping-cart"></span>
                <span id="number-cart" class="number-cart"></span>
            </div>
            <span class="price-product">0$</span>
            <button class="sk-fill-button button-odder">Order</button>
        </a>
    </div>
</footer>
