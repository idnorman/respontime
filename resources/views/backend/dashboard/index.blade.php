@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        @foreach ($pemeriksaans as $item)
            <div class="col-3">
                <div class="small-box bg-info" id="box-{{ $item->id }}">
                    <div class="inner">
                        <h3 id="time-{{ $item->id }}"></h3>
                        <p class="font-weight-bold m-0">{{ $item->penyakit->nama }}</p>
                        <p>{{ $item->pasien->nama }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('script')
    <script>
        let idBox = [];

        @foreach ($pemeriksaans as $item)
            idBox.push('{{ $item->id }}')
        @endforeach

        for (let i = 0; i < idBox.length; i++) {
            var time = document.getElementById("time-" + idBox[i]);

            console.log(time);

            var totalSeconds = 0;
            setInterval(setTime, 1000);

            function setTime() {
                ++totalSeconds;
                let minute = pad(parseInt(totalSeconds / 60));
                let second = pad(totalSeconds % 60);
                time.innerHTML = minute + ':' + second;
            }

            function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                    return "0" + valString;
                } else {
                    return valString;
                }
            }
        }
    </script>
@endpush
