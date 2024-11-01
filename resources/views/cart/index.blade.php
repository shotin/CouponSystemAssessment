@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Shopping Cart</h1>

    <div id="cart-items" class="list-group mb-4">
        @foreach ($cartItems as $item)
        <div class="list-group-item d-flex justify-content-between align-items-center text-center">
            <span>{{ $item->name }}</span>
            <span>${{ $item->price }} x {{ $item->quantity }}</span>
        </div>
        @endforeach
    </div>

    <h3 class="text-center mb-3">Total: $<span id="total">{{ $total }}</span></h3>

    <div class="input-group mb-3 mx-auto" style="width: 50%;">
        <input type="text" class="form-control" id="coupon_code" placeholder="Enter coupon code">
        <button class="btn btn-primary" onclick="applyCoupon()">Apply Coupon</button>
    </div>

    <div class="text-center">
        <p id="discount" class="alert" role="alert" style="display: inline-block; width: auto;"></p>
    </div>
</div>

<script>
    function applyCoupon() {
        let couponCode = document.getElementById('coupon_code').value;
        let discountMessage = document.getElementById('discount');

        discountMessage.className = 'alert';

        if (!couponCode) {
            discountMessage.classList.add('alert-warning');
            discountMessage.innerText = 'Please enter a coupon code.';
            return;
        }

        discountMessage.classList.add('alert-info');
        discountMessage.innerText = 'Applying coupon...';

        fetch('{{ route("cart.apply-coupon") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    coupon_code: couponCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('total').innerText = data.new_total_price;
                    discountMessage.className = 'alert alert-success';
                    discountMessage.innerText = `Discount Applied: $${data.discount}`;
                } else {
                    discountMessage.className = 'alert alert-danger';
                    discountMessage.innerText = data.message;
                }
            });
    }
</script>
@endsection