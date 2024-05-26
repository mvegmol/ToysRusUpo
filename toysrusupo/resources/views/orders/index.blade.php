@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl bg-white p-6 rounded-lg shadow-lg">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-tertiary sm:text-2xl">My orders</h2>

                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <form method="GET" action="{{ route('orders.index') }}"
                            class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                            <div>
                                <label for="order-type"
                                    class="sr-only mb-2 block text-sm font-medium text-tertiary">{{ __('Select order type') }}</label>
                                <select id="order-type" name="order_type" onchange="this.form.submit()"
                                    class="block w-full min-w-[8rem] rounded-lg border border-tertiary bg-primary p-2.5 text-sm text-white focus:border-primary focus:ring-primary">
                                    <option value="all" {{ request('order_type', 'all') == 'all' ? 'selected' : '' }}>
                                        {{ __('All orders') }}</option>
                                    <option value="pending" {{ request('order_type') == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}</option>
                                    <option value="accepted" {{ request('order_type') == 'accepted' ? 'selected' : '' }}>
                                        {{ __('Accepted') }}</option>
                                    <option value="inprogress"
                                        {{ request('order_type') == 'inprogress' ? 'selected' : '' }}>
                                        {{ __('In progress') }}</option>
                                    <option value="delivered" {{ request('order_type') == 'delivered' ? 'selected' : '' }}>
                                        {{ __('Delivered') }}</option>
                                    <option value="cancelled" {{ request('order_type') == 'cancelled' ? 'selected' : '' }}>
                                        {{ __('Cancelled') }}</option>
                                </select>
                            </div>

                            <span class="inline-block text-tertiary">{{ __('from') }}</span>

                            <div>
                                <label for="duration"
                                    class="sr-only mb-2 block text-sm font-medium text-tertiary">{{ __('Select duration') }}</label>
                                <select id="duration" name="duration" onchange="this.form.submit()"
                                    class="block w-full min-w-[8rem] rounded-lg border border-tertiary bg-primary p-2.5 text-sm text-white focus:border-primary focus:ring-primary">
                                    <option value="this_week"
                                        {{ request('duration', 'this_week') == 'this_week' ? 'selected' : '' }}>
                                        {{ __('this week') }}</option>
                                    <option value="this_month" {{ request('duration') == 'this_month' ? 'selected' : '' }}>
                                        {{ __('this month') }}</option>
                                    <option value="last_3_months"
                                        {{ request('duration') == 'last_3_months' ? 'selected' : '' }}>
                                        {{ __('the last 3 months') }}</option>
                                    <option value="last_6_months"
                                        {{ request('duration') == 'last_6_months' ? 'selected' : '' }}>
                                        {{ __('the last 6 months') }}</option>
                                    <option value="this_year" {{ request('duration') == 'this_year' ? 'selected' : '' }}>
                                        {{ __('this year') }}</option>
                                </select>
                            </div>

                            <button type="submit" class="hidden">Filter</button>
                        </form>
                    </div>
                </div>

                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Order ID:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-tertiary">
                                        <a href="#" class="hover:underline">#{{ $order->id }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Date:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-tertiary">
                                        {{ $order->created_at->format('d.m.Y') }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Price:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-tertiary">
                                        ${{ number_format($order->total_price, 2) }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-tertiary">
                                        {{ ucfirst($order->status) }}
                                    </dd>
                                </dl>

                                <div
                                    class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <button type="button"
                                        class="w-full rounded-lg border bg-red-600 text-white border-red-600 px-3 py-2 text-center text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 lg:w-auto">
                                        Cancel order
                                    </button>
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="w-full inline-flex justify-center rounded-lg border border-primary bg-white px-3 py-2 text-sm font-medium text-primary hover:bg-primary hover:text-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary lg:w-auto">
                                        View details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection