@extends('layouts.app')
@section('content')
    <main class="container mt-5">
        <div class="row">

            <div class="col-lg-3">
                <h2 class="mb-3">Categorías</h2>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Categoría 1</a></li>
                    <li class="list-group-item"><a href="#">Categoría 2</a></li>
                    <li class="list-group-item"><a href="#">Categoría 3</a></li>
                </ul>
            </div>

            <div class="col-lg-9">
                <h2 class="mb-3">Productos</h2>
                <div class="row row-cols-3">
                    @forelse ($products  as $product)
                        <div class="col"> {{-- Each product gets a column --}}
                            <div class="card mb-3">
                                <img src="https://www.toysrus.es/medias/?context=bWFzdGVyfHByb2R1Y3RfaW1hZ2VzfDM3MTA5fGltYWdlL2pwZWd8YUdVeEwyaGtOeTh4TVRjd01ESTFOekE1TlRjeE1BfDE1NzE4NDQ2ZWQ2NDZlYTRlMWI3YTIzMTYyZmQ2OWI0YjEzZjE2MDY4YTAxNzRiMGZjNzdmZTlmODUwY2RmN2M"
                                    class="card-img-top" alt="{{ $product->name }}"> {{-- Dynamic alt text --}}
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5> {{-- Dynamic product name --}}
                                    <p class="card-text">Precio: ${{ number_format($product->price, 2) }}</p>
                                    {{-- Formatted price --}}
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-primary me-1"><i class="fas fa-heart"></i>
                                            Favorito</a>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <button type="submit" class="btn btn-danger">Añadir al Carrito</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"> {{-- Span full width if no products --}}
                            <p>No se encontraron productos</p>
                        </div>
                    @endforelse
                </div>
                {{ $products->links() }} {{-- Pagination links --}}
            </div>

        </div>
    </main>
@endsection
