<a name="payments-tab"></a>
<table class="table table-striped">
    <thead>
    <tr>
        <th colspan="6" class="btn-quirk">Payments</th>
    </tr>
    <tr>
        <td>ID</td>
        <td>Amount</td>
        <td>Status</td>
        <td>Payment Date</td>
        <td>Created At</td>
    </tr>
    </thead>
    <tbody>
    @forelse($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->payment_date }}</td>
            <td>{{ $payment->created_at->toDateString() }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No payments found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

@section('scaffold.js')
    <script>
        $(function() {
            if ('#payments' === location.hash) {
                setTimeout(function() {
                    var offset = $('a[name=offers-tab]').offset();
                    window.scrollTo(0, offset.top);
                }, 0);
            }
        });
    </script>
@append