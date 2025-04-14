@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
    <div class="main-content-table">
        <section class="section">
            <div class="margin-content">
                <div class="container-sm">
                    <div class="section-header">
                        <h1>Tambah Penjualan</h1>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="section-body">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('sales.confirmationStore') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        @forelse ($products as $product)
                                            <div class="col-md-4 d-flex align-items-stretch">
                                                <div class="card mb-3 w-100 d-flex flex-column">
                                                    <div class="d-flex justify-content-center p-3"
                                                        style="height: 150px; overflow: hidden;">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            class="card-img-top" alt="{{ $product->name }}"
                                                            style="object-fit: cover; height: 100%; width: 100%; max-height: 200px;">
                                                    </div>
                                                    <div
                                                        class="card-body d-flex flex-column flex-grow-1 justify-content-between">
                                                        <h5 class="card-title text-center">{{ $product->name }}</h5>
                                                        <p class="card-text text-center">Harga: Rp
                                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                                        <p class="card-text text-center">Stok: {{ $product->quantity }}</p>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary decrement"
                                                                data-id="{{ $product->id }}">-</button>
                                                            <input type="number" name="quantities[{{ $product->id }}]"
                                                                id="quantity-{{ $product->id }}"
                                                                class="form-control text-center mx-2" style="width: 80px;"
                                                                min="0" max="{{ $product->quantity }}"
                                                                value="0">
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary increment"
                                                                data-id="{{ $product->id }}">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12 text-center">
                                                <p>Tidak ada produk yang tersedia.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submitButton = document.querySelector("button[type='submit']");
            const quantityInputs = document.querySelectorAll("input[type='number']");

            function updateSubmitButtonState() {
                let totalQuantity = 0;
                quantityInputs.forEach(input => {
                    totalQuantity += parseInt(input.value) || 0;
                });
                submitButton.disabled = totalQuantity === 0;
            }

            document.querySelectorAll(".increment").forEach(button => {
                button.addEventListener("click", function() {
                    let productId = this.getAttribute("data-id");
                    let input = document.getElementById("quantity-" + productId);
                    let stock = parseInt(input.getAttribute(
                    "max")); // Get the stock from the max attribute
                    if (input && parseInt(input.value) < stock) {
                        input.value = parseInt(input.value) + 1;
                        updateSubmitButtonState();
                    }
                });
            });

            document.querySelectorAll(".decrement").forEach(button => {
                button.addEventListener("click", function() {
                    let productId = this.getAttribute("data-id");
                    let input = document.getElementById("quantity-" + productId);
                    if (input && parseInt(input.value) > 0) {
                        input.value = parseInt(input.value) - 1;
                        updateSubmitButtonState();
                    }
                });
            });

            // Initial check to disable the button if all quantities are zero
            updateSubmitButtonState();
        });
    </script>

@endsection
