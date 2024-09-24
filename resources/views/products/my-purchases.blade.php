<x-app-layout>
    <div class="container my-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#all" data-toggle="tab">All</a>
            </li>
            {{-- <li class="nav-item">
                    <a class="nav-link" href="#to-receive" data-toggle="tab">To Receive</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#completed" data-toggle="tab">Completed</a>
                </li> --}}
        </ul>

        <div class="tab-content">
            <!-- All Orders Tab -->
            <div class="tab-pane active" id="all">
                @foreach ($orders as $order)
                    <div class="order-item">
                        @if ($order->item)
                            <img src="{{ asset($order->item->photo) }}" alt="Item image" width="100">
                            <p>{{ $order->item->name }}</p>
                        @else
                            <p>Item details not available</p>
                        @endif
                        <p>RM {{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach

            </div>

            {{-- <!-- To Receive Tab -->
            <div class="tab-pane" id="to-receive">
                @foreach ($toReceive as $order)
                    <div class="order-item">
                        <img src="{{ asset($order->item->photo) }}" alt="Item image" width="100">
                        <p>{{ $order->item->name }}</p>
                        <p>RM {{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Completed Tab -->
            <div class="tab-pane" id="completed">
                @foreach ($completed as $order)
                    <div class="order-item">
                        <img src="{{ asset($order->item->photo) }}" alt="Item image" width="100">
                        <p>{{ $order->item->name }}</p>
                        <p>RM {{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>

</x-app-layout>
