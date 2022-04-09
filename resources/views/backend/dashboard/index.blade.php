@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        @foreach ($pemeriksaans as $item)
            @if(!$item->waktu_selesai)
            <div class="col-3">
                <div class="small-box bg-info" id="box-{{ $item->id }}">
                    <div class="inner">
                        <h3 id="time-{{ $item->id }}"></h3>
                        <p class="font-weight-bold m-0">{{ $item->penyakit->nama }}</p>
                        <p>{{ $item->pasien->nama }}</p>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
@endsection

@push('script')
    <script>
        
        let pemeriksaan = {};
        
        @foreach ($pemeriksaans as $item)
            @if(!$item->waktu_selesai)

            pemeriksaan = {
                ...pemeriksaan, 
                ...{
                    '{{ $item->id }}' : {
                        'id' : {{ $item->id }},
                        'created_at' : '{{$item->created_at->format('m/d/Y H:i:s')}}'
                    }
                }
            };
            @endif
        @endforeach

        setInterval(setTime, 1000);

        function setTime(){
            $.each(pemeriksaan, function(index, value) {

                let id = value['id'];
                
                //Waktu sekarang
                let currTime = new Date();

                //Waktu mulai
                let pastTime = new Date(value['created_at']);

                //Selisih waktu (dalam miliseconds)
                let diff = currTime - pastTime;

                //Konversi selisih(miliseconds) ke h(jam), m(menit), s(detik)
                let h = Math.floor(diff/(1000 * 60 * 60));
                diff -= h * (1000 * 60 * 60);

                let m = Math.floor(diff/(1000 * 60));
                diff -= m * (1000 * 60);

                let s = Math.floor(diff/1000);

                display(id, h, m, s);
            });
        }

        function display(id, h, m, s) {
            var time = document.getElementById("time-" + id);
            var h = Number(h);
            var m = Number(m);
            var s = Number(s);

            var hDisplay = h > 0 ? (h<10 ? "0" + h + ":" : h + ":") : "00:";
            var mDisplay = m > 0 ? (m<10 ? "0" + m + ":" : m + ":") : "00:";
            var sDisplay = s > 0 ? (s<10 ? "0" + s : s ) : "00";

            time.innerHTML = hDisplay + mDisplay + sDisplay;
        }
        
    </script>
@endpush
