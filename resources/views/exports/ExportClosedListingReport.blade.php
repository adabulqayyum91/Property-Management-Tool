<table>
    <thead>
    <tr>
        {{--@foreach($data[0] as $key => $value)--}}
            {{--<th>{{ ucfirst($key) }}</th>--}}
        {{--@endforeach--}}
        <th>Listing ID</th>
        <th>Seller Member ID</th>
        <th>Seller Member First Name</th>
        <th>Seller Member Last Name</th>
        <th>Venture ID</th>
        <th>Seller Ownership Sequence</th>
        <th>Ownership %</th>
        <th>Buyer Member ID</th>
        <th>Buyer Member First Name</th>
        <th>Buyer Member Last Name</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $list)
        <tr>

            <td>{{ $list->list_automated_id }}</td>
            <td>{{ !is_null($list->users()->first()) ? $list->users()->first()->member_automated_id : 'N/A'}}</td>
            <td>{{ !is_null($list->users()->first()) ? $list->users()->first()->first_name : 'N/A'}}</td>
            <td>{{ !is_null($list->users()->first()) ? $list->users()->first()->last_name : 'N/A'}}</td>
            <td>{{ !is_null($list->venture()->first()) ? $list->venture()->first()->venture_automated_id : 'N/A' }}</td>
            @php
                $percentage = $list->percentage_of_ownership;
                $total = !is_null($list->venture()->first()) ? $list->venture()->first()->target_amount : 0;

                $newTotal = ($percentage / 100) * $total;

                $buyerUser = $list->BuyNow()->first();
            @endphp
            <td>{{ !is_null($list->venture()->first()) ? $list->venture()->first()->venture_automated_id : ''}}:0001:{{ $newTotal }}</td>
            <td>{{ $list->percentage_of_ownership }}</td>
            <td>{{ !is_null($buyerUser)&& !is_null($buyerUser->user) ? $buyerUser->user->member_automated_id : 'N/A'}}</td>
            <td>{{ !is_null($buyerUser)&& !is_null($buyerUser->user) ? $buyerUser->user->first_name : 'N/A'}}</td>
            <td>{{ !is_null($buyerUser)&& !is_null($buyerUser->user) ? $buyerUser->user->last_name : 'N/A'}}</td>
            <td>{{ $newTotal }}</td>
        </tr>
    @endforeach
    </tbody>
</table>