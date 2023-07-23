<x-admin-layout>

    @section('content')
      <h3>{{ Auth::user()->name }}</h3>
    @endsection
    
</x-admin-layout>