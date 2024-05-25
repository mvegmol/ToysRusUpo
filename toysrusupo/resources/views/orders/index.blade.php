@extends('layouts.app')

@section('content')
    <section class="bg-white py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">My orders</h2>

                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <div>
                            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select order
                                type</label>
                            <select id="order-type"
                                class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-primary p-2.5 text-sm text-gray-900 focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary dark:focus:ring-primary">
                                <option selected>All orders</option>
                                <option value="pre-order">Pre-order</option>
                                <option value="transit">In transit</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <span class="inline-block text-secondary"> from </span>

                        <div>
                            <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select
                                duration</label>
                            <select id="duration"
                                class="block w-full rounded-lg border border-gray-300 bg-secundary p-2.5 text-sm text-gray-900 focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary dark:focus:ring-primary">
                                <option selected>this week</option>
                                <option value="this month">this month</option>
                                <option value="last 3 months">the last 3 months</option>
                                <option value="lats 6 months">the last 6 months</option>
                                <option value="this year">this year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Order ID:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        <a href="#" class="hover:underline">#{{ $order->id }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Date:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        {{ $order->created_at->format('d.m.Y') }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Price:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                        ${{ number_format($order->total_price, 2) }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                                    <dd
                                        class="me-2 mt-1.5 inline-flex items-center rounded bg-tertiary-100 px-2.5 py-0.5 text-xs font-medium text-tertiary-800">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <!-- Icono para el estado del pedido -->
                                        </svg>
                                        {{ ucfirst($order->status) }}
                                    </dd>
                                </dl>

                                <div
                                    class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <button type="button"
                                        class="w-full rounded-lg border border-secondary-700 px-3 py-2 text-center text-sm font-medium text-secondary-700 hover:bg-secondary-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-secondary-300 lg:w-auto">Cancel
                                        order</button>
                                    <a href="#"
                                        class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 lg:w-auto">View
                                        details</a>
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
