@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $user['name'] }}さんお疲れ様でした！！！
                </div>

                <div>
                    @if(isset($attendance))

                    <p>
                        <button type="" class=" btn btn-light btn-outline-first">勤務開始</button>
                    </p>


                    @else

                    <form action="{{ route('attendancestart' )}}" method="get">
                        <button type="submit" class=" btn btn-light btn-outline-secondary">勤務開始</button>


                    </form>

                    @endif
                </div>

                <div>

                    @if(isset($endattendance))

                    <p>
                        <button type="" class=" btn btn-light btn-outline-first">勤務終了</button>
                    </p>


                    @else



                    <form action="{{ route('attendanceend' )}}" method="get">
                        <button type="submit" class="btn btn-light  btn-outline-secondary">勤務終了</button>
                    </form>

                    @endif
                </div>





                <!-- <form action="{{ route('attendancestart' )}}" method="get">
                    <button type="submit">勤務開始</button>
                </form>

                <form action="{{ route('attendanceend' )}}" method="get">
                    <button type="submit">勤務終了</button>
                </form>
 -->


                <form action="{{ route('startrest')}}" method="get">
                    <button type="submit">休憩開始</button>
                </form>

                <form action="{{ route('endrest')}}" method="get">
                    <button type="submit">休憩終了</button>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection
