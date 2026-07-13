<div>
    @foreach($registrations as $reg)
        <h2>{{ $reg->groupName }}</h2>
        <p>{{ $reg->sport->name }}</p>
        @foreach ($reg->name as $member)
            <ul>
                <li>{{ $member }}</li>
            </ul>
        @endforeach
        <button wire:click="updateStatus('approved', {{ $reg }})">Approve</button>
        <button wire:click="updateStatus('rejected', {{ $reg }})">Reject</button>
    @endforeach
</div>