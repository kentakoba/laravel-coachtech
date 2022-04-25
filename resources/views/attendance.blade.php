@extends('layouts.app')

@section('content')
<div class="container">
    <div class="table-resposive">
        <table class="table align-middle">
            <thread>
                <tr>
                    <th style="width:20%">名前</th>
                    <!-- <th style="width:5%">勤務日</th> -->
                    <th style="width:20%">勤務開始</th>
                    <th style="width:20%">勤務終了</th>
                    <th style="width:20%">勤務時間</th>
                    <th style="width:20%">休憩時間</th>

                </tr>
            </thread>
            <tbody>
                <!-- <div>
                    <a href="" class="arrow">

                    </a>
                    <p>
                        {{ $dt }}
                    </p>
                    <a href="" class="arrow">

                    </a>
                </div> -->

                <form action="{{ route('changedate')}}" method="POST">
                    @csrf
                    <input type="hidden" id="date" name="date" value="{{ $dt }}" class="date">
                    <input type="hidden" id="before" name="before" value="before" class="before-next">
                    <input type="submit" id="arrow" name="arrow" value="<" class="arrow">
                </form>
                {{ $dt }}
                <form action="{{ route('changedate')}}" method="POST">
                    @csrf
                    <input type="hidden" id="date" name="date" value="{{ $dt }}" class="date">
                    <input type="hidden" id="next" name="next" value="next" class="before-next">
                    <input type="submit" id="arrow" name="arrow" value=">" class="arrow">
                </form>

                @foreach($attendances as $attendance)

                <tr>
                    <!-- 以下単数形 -->
                    <td> {{ $attendance['name']}}</td>
                    <td> {{ $attendance['workstart_time'] }}</td>
                    <td> {{ $attendance['workend_time'] }}</td>
                    <td> {{ $attendance['work_time']}}</td>
                    <td> {{ $attendance['rest_time']}}</td>

                </tr>
                @endforeach

            </tbody>
        </table>
        <!-- ページネーションの変数は複数形 -->
        {{ $attendances->links('pagination::default') }}

    </div>
</div>
@endsection