@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <tr>
                    @foreach($attendance as $attendance)

                    <td> {{ $attendance['user_id'] }}</td>
                    <td> {{ $attendance['workstart_time'] }}</td>
                    <td> {{ $attendance['workend_time'] }}</td>

                    @endforeach
                </tr>

            </div>

        </div>
    </div>
</div>
@endsection