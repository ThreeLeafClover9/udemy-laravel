<x-layout>
    @section('content')
        <h1>Contact Page</h1>
        @if(count($people))
            <ul>
                @foreach($people as $person)
                    <li>{{ $person }}</li>
                @endforeach
            </ul>
        @endif
    @endsection

    @section('footer')
{{--        <script>alert('Hello visitor')</script>--}}
        <x-alert :message="'Hello visitor'"/>
    @endsection
</x-layout>
