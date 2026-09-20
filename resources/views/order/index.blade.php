```blade
@section('navbar-position', 'position-absolute')

<x-layout>

    {{-- HEADER --}}
    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">

                <header class="bg-category d-flex align-items-end">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        I tuoi ordini
                    </h1>
                </header>

            </div>
        </div>
    </div>


    <main class="container pb-5">

        <div class="row">
            <div class="col-12 my-4 my-md-5">

                <div class="accordion" id="accordionIndexOrders">

                    @foreach ($orders as $order)
                        <div class="accordion-item bg-transparent border-0 mb-3 mb-md-4">

                            {{-- HEADER ORDINE --}}
                            <h2 class="accordion-header">

                                <button
                                    class="border-blk rounded-1 border accordion-button bg-wh text-secondary shadow-sm collapsed"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $order->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $order->id }}">

                                    <div class="row w-100 me-2 me-md-3 align-items-center">

                                        {{-- ORDINE --}}
                                        <div class="col-6 col-lg-3">

                                            <span class="d-block d-sm-inline">
                                                Ordine:
                                            </span>

                                            <strong class="text-blk fw-semibold">
                                                #{{ $order->id }}
                                            </strong>

                                        </div>


                                        {{-- DATA --}}
                                        <div class="col-6 col-lg-3 text-end text-lg-start">

                                            {{ $order->created_at->format('d F Y') }}

                                        </div>


                                        {{-- STATO --}}
                                        <div class="col-6 col-lg-3 mt-2 mt-lg-0">

                                            <span class="d-block d-sm-inline">
                                                Stato:
                                            </span>

                                            <span class="order-status status-{{ $order->status }}">

                                                @switch($order->status)
                                                    @case('pending')
                                                        In attesa
                                                    @break

                                                    @case('confirmed')
                                                        Confermato
                                                    @break

                                                    @case('shipped')
                                                        In spedizione
                                                    @break

                                                    @case('delivered')
                                                        Consegnato
                                                    @break

                                                    @case('cancelled')
                                                        Cancellato
                                                    @break

                                                    @default
                                                        {{ $order->status }}
                                                @endswitch

                                            </span>

                                        </div>


                                        {{-- TOTALE --}}
                                        <div class="col-6 col-lg-3 text-end mt-2 mt-lg-0">

                                            <span class="d-block d-sm-inline">
                                                Totale:
                                            </span>

                                            <strong class="text-blk fw-semibold">
                                                {{ number_format($order->total, 2, ',', '.') }} €
                                            </strong>

                                        </div>

                                    </div>

                                </button>

                            </h2>


                            {{-- DETTAGLI ORDINE --}}
                            <div id="collapse{{ $order->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionIndexOrders">

                                <div class="accordion-body px-1 px-sm-2 px-md-3 pt-3 pb-2">

                                    @foreach ($order->order_items as $item)
                                        <div class="border rounded-3 shadow-sm mb-4 p-3 p-md-4">

                                            <div
                                                class="d-flex flex-wrap flex-xl-nowrap align-items-center gap-3 gap-md-4">

                                                {{-- IMMAGINE --}}
                                                <a href="{{ route('article.show', $item->article) }}"
                                                    class="flex-shrink-0 square-100">

                                                    @if ($item->article->images->isNotEmpty())
                                                        <img src="{{ $item->article->images->first()->getUrl(300, 300) }}"
                                                            alt="Immagine di prodotto"
                                                            class="w-100 h-100 object-fit-cover rounded-2">
                                                    @else
                                                        <img src="/media/placeholder-show/1.png"
                                                            alt="Immagine di prodotto"
                                                            class="w-100 h-100 object-fit-cover rounded-2">
                                                    @endif

                                                </a>


                                                {{-- INFO PRODOTTO --}}
                                                <div class="flex-grow-1">

                                                    <h5 class="fw-semibold mb-2">
                                                        {{ $item->article->title }}
                                                    </h5>

                                                    <div class="text-secondary small mb-1">
                                                        Quantità: {{ $item->quantity }}
                                                    </div>

                                                    <div>
                                                        {{ number_format($item->price, 2, ',', '.') }} €

                                                        <span class="text-secondary small">
                                                            / pezzo
                                                        </span>
                                                    </div>

                                                </div>


                                                {{-- SUBTOTALE --}}
                                                <div class="text-end ms-auto w-100 w-lg-auto mt-2 mt-lg-0">

                                                    <span class="text-secondary small d-block mb-1">
                                                        Subtotale
                                                    </span>

                                                    <span class="fw-bold">
                                                        {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                                        €
                                                    </span>

                                                </div>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>

    </main>

</x-layout>
