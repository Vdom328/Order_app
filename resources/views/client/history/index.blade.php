@extends('client.layouts.master')

@section('css')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .order-card {
        border-radius: 8px;
        margin-bottom: 15px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, border-color 0.3s ease, color 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .order-card:hover {
        background-color: #f0f5f9;
        transform: translateY(-5px);
        border-color: #3498db;
        color: #3498db;
    }

    .order-card.active {
        background-color: #3498db;
        color: #fff;
        border-color: #3498db;
    }

    .order-card h3 {
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .order-details {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        color: #555;
    }

    .order-items {
        display: none;
        margin-top: 10px;
        padding-left: 20px;
        border-left: 2px solid #3498db;
    }

    .order-items li {
        list-style-type: none;
        margin-bottom: 5px;
        color: #333;
    }

    .order-card.active .order-items {
        display: block;
    }

    @media screen and (max-width: 600px) {
        .container {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="col-12 mt-3">
    <h2 class="mb-3">Order History</h2>
    @foreach ($historyByUser as $item)
        <div class="order-card" onclick="toggleOrderItems(this)">
            <h3>Order #1</h3>
            <div class="order-details">
                <span>Items: Item 1, Item 2</span>
                <span>Total: $25.99</span>
            </div>
            <div class="order-details">
                <span>Date: 2023-11-12 14:30:00</span>
            </div>
            <ul class="order-items">
                <li>Item 1</li>
                <li>Item 2</li>
            </ul>
        </div>
    @endforeach

</div>
@endsection

@section('js')
<script>
    function toggleOrderItems(orderCard) {
        orderCard.classList.toggle('active');
    }
</script>
@endsection
