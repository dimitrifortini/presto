@section('navbar-position', 'position-absolute')

<x-layout>

    <div class="container-fluid p-0">
        <div class="row mx-0">
            <div class="col-12 p-0">
                <header class="bg-category d-flex align-items-end">
                    <h1 class="fw-bold text-wh category-title pb-2 ps-4 display-4">
                        {{ __('ui.admin_dashboard') }}
                    </h1>
                </header>
            </div>
        </div>
    </div>

    <main class="container my-5">
        <div class="row">
            <div class="col-12 border border-blk rounded-1 p-0 shadow">

                {{-- DESKTOP --}}
                <div class="d-none d-xl-block">
                    <div class="table-responsive">
                        <table class="table align-middle admin-orders-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ui.order') }}</th>
                                    <th scope="col">{{ __('ui.customer') }}</th>
                                    <th scope="col">{{ __('ui.date') }}</th>
                                    <th scope="col">{{ __('ui.status') }}</th>
                                    <th scope="col">{{ __('ui.total') }}</th>
                                    <th scope="col">
                                        <span class="visually-hidden">{{ __('ui.details') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-blk">
                                @foreach ($orders as $order)
                                    <tr class="order-main">
                                        <td class="fw-semibold">#{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            <time datetime="{{ $order->created_at->toISOString() }}">
                                                {{ $order->created_at->format('d/m/Y') }}
                                            </time>
                                        </td>
                                        <td>
                                            <span class="order-status status-{{ $order->status }}">
                                                @switch($order->status)
                                                    @case('pending')
                                                        {{ __('ui.pending') }}
                                                    @break

                                                    @case('confirmed')
                                                        {{ __('ui.confirmed') }}
                                                    @break

                                                    @case('shipped')
                                                        {{ __('ui.shipped') }}
                                                    @break

                                                    @case('delivered')
                                                        {{ __('ui.delivered') }}
                                                    @break

                                                    @case('cancelled')
                                                        {{ __('ui.cancelled') }}
                                                    @break

                                                    @default
                                                        {{ $order->status }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="fw-semibold">
                                            {{ number_format($order->total, 2, ',', '.') }} €
                                        </td>
                                        <td class="text-end">
                                            <button class="order-details-btn" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#desktopOrder{{ $order->id }}" aria-expanded="false"
                                                aria-controls="desktopOrder{{ $order->id }}">
                                                <span class="details-open">{{ __('ui.details') }}</span>
                                                <span class="details-close">{{ __('ui.close') }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="order-detail-row">
                                        <td colspan="6" class="p-0 border-0">
                                            <div class="collapse" id="desktopOrder{{ $order->id }}">
                                                @include('admin.partials.order-detail', [
                                                    'order' => $order,
                                                ])
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TABLET --}}
                <div class="admin-tablet d-none d-md-block d-xl-none">
                    <div class="table-responsive">
                        <table class="table align-middle admin-orders-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ui.order') }}</th>
                                    <th scope="col">{{ __('ui.customer') }}</th>
                                    <th scope="col">{{ __('ui.status') }}</th>
                                    <th scope="col">{{ __('ui.total') }}</th>
                                    <th scope="col">
                                        <span class="visually-hidden">{{ __('ui.details') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-blk">
                                @foreach ($orders as $order)
                                    <tr class="order-main">
                                        <td class="fw-semibold">#{{ $order->id }}</td>
                                        <td>
                                            {{ $order->user->name }}
                                            <small class="d-block text-secondary">
                                                <time datetime="{{ $order->created_at->toISOString() }}">
                                                    {{ $order->created_at->format('d/m/Y') }}
                                                </time>
                                            </small>
                                        </td>
                                        <td>
                                            <span class="order-status status-{{ $order->status }}">
                                                @switch($order->status)
                                                    @case('pending')
                                                        {{ __('ui.pending') }}
                                                    @break

                                                    @case('confirmed')
                                                        {{ __('ui.confirmed') }}
                                                    @break

                                                    @case('shipped')
                                                        {{ __('ui.shipped') }}
                                                    @break

                                                    @case('delivered')
                                                        {{ __('ui.delivered') }}
                                                    @break

                                                    @case('cancelled')
                                                        {{ __('ui.cancelled') }}
                                                    @break

                                                    @default
                                                        {{ $order->status }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="fw-semibold">
                                            {{ number_format($order->total, 2, ',', '.') }} €
                                        </td>
                                        <td class="text-end">
                                            <button class="order-details-btn" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#tabletOrder{{ $order->id }}" aria-expanded="false"
                                                aria-controls="tabletOrder{{ $order->id }}">
                                                <span class="details-open">{{ __('ui.details') }}</span>
                                                <span class="details-close">{{ __('ui.close') }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="order-detail-row">
                                        <td colspan="5" class="p-0 border-0">
                                            <div class="collapse" id="tabletOrder{{ $order->id }}">
                                                @include('admin.partials.order-detail', [
                                                    'order' => $order,
                                                ])
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- SMARTPHONE --}}
                <div class="admin-mobile d-md-none">
                    @foreach ($orders as $order)
                        <article class="admin-order-card">
                            <div class="admin-order-card-header">
                                <div>
                                    <div class="fw-semibold">#{{ $order->id }}</div>
                                    <div class="text-secondary small">{{ $order->user->name }}</div>
                                </div>
                                <span class="order-status status-{{ $order->status }}">
                                    @switch($order->status)
                                        @case('pending')
                                            {{ __('ui.pending') }}
                                        @break

                                        @case('confirmed')
                                            {{ __('ui.confirmed') }}
                                        @break

                                        @case('shipped')
                                            {{ __('ui.shipped') }}
                                        @break

                                        @case('delivered')
                                            {{ __('ui.delivered') }}
                                        @break

                                        @case('cancelled')
                                            {{ __('ui.cancelled') }}
                                        @break

                                        @default
                                            {{ $order->status }}
                                    @endswitch
                                </span>
                            </div>
                            <div class="admin-order-card-info">
                                <div>
                                    <span class="text-secondary small d-block">{{ __('ui.date') }}</span>
                                    <span>
                                        <time datetime="{{ $order->created_at->toISOString() }}">
                                            {{ $order->created_at->format('d/m/Y') }}
                                        </time>
                                    </span>
                                </div>
                                <div class="text-end">
                                    <span class="text-secondary small d-block">{{ __('ui.total') }}</span>
                                    <span class="fw-semibold">{{ number_format($order->total, 2, ',', '.') }} €</span>
                                </div>
                            </div>
                            <button class="order-details-btn w-100 mt-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mobileOrder{{ $order->id }}" aria-expanded="false"
                                aria-controls="mobileOrder{{ $order->id }}">
                                <span class="details-open mt-3">{{ __('ui.details') }}</span>
                                <span class="details-close mt-3">{{ __('ui.close') }}</span>
                            </button>
                            <div class="collapse" id="mobileOrder{{ $order->id }}">
                                @include('admin.partials.order-detail', ['order' => $order])
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </div>
    </main>
</x-layout>
