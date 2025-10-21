<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jadwal Pelajaran - {{ $ruangan->nama }}</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
</head>
<body>

  <section class="slide">
    <div class="logo">
      <img src="{{ asset('assets/pplg.png') }}" alt="logo" />
    </div>
    <h1 id="lab-title">Memuat...</h1>
    <h2 id="current-activity">Memuat...</h2>
    <div class="time" id="clock"></div>
    <div class="date" id="date"></div>
    <div class="duration" id="current-duration">–</div>

    <div class="teacher">
      <img id="teacher-photo" src="" alt="" />
      <div class="overlay">
        <div class="name" id="teacher-name">Memuat...</div>
        <div class="role">Penanggung Jawab Lab</div>
      </div>
    </div>
    <button class="arrow-btn" id="nextBtn"></button>
  </section>

  <section class="schedule">
    <div class="main-content">
      <h1 class="fade-item">Jadwal Pelajaran</h1>
      <div class="day-wrapper">
        <div class="row">
          <div class="day-btn fade-item">Senin</div>
          <div class="day-btn fade-item">Selasa</div>
          <div class="day-btn fade-item">Rabu</div>
        </div>
        <div class="row">
          <div class="day-btn fade-item">Kamis</div>
          <div class="day-btn fade-item">Jum'at</div>
        </div>
      </div>
    </div>
    <div class="footer fade-item">
      <div class="admin-link">
  Anda Admin? <span onclick="window.location='/login'">Masuk disini</span>
</div>
    </div>
  </section>

  <?php
    // --- 1. Siapkan data di PHP murni (AMAN) ---
    $labId = $ruangan->id;
    $labNama = e($ruangan->nama);

    // Penanggung Jawab
    $pj = $ruangan->penanggungJawab;
    $pjNama = $pj ? e($pj->nama) : 'Penanggung Jawab';
    $pjFotoUrl = $pj && $pj->foto 
        ? url('storage/' . $pj->foto) 
        : 'https://ui-avatars.com/api/?name=' . urlencode($pjNama) . '&background=0D8ABC&color=fff';

    // Jadwal per hari
    $allDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $weeklySchedules = [];

    foreach ($allDays as $day) {
        $periods = [];
        $jadwalHariIni = $jadwals->where('hari', $day);
        foreach ($jadwalHariIni as $j) {
            $isIstirahat = ($j->status === 'Istirahat');
            $mapelNama = $isIstirahat ? 'Istirahat' : e($j->mapel?->nama ?? 'Mapel Tidak Ada');
            $guruNama = e($j->guru?->nama ?? '');
            $guruFotoUrl = '';

            if (!$isIstirahat && $j->guru) {
                if ($j->guru->foto) {
                    $guruFotoUrl = url('storage/' . $j->guru->foto);
                } else {
                    $guruFotoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($guruNama) . '&background=0D8ABC&color=fff';
                }
            }

            $periods[] = [
                'name' => $mapelNama,
                'time' => \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i'),
                'teacher' => $guruNama,
                'photo' => $guruFotoUrl
            ];
        }
        $weeklySchedules[$day] = $periods;
    }
  ?>

  <script>
    window.CURRENT_LAB = {{ $labId }};
    window.ScheduleData = {
      labConfig: {
        {{ $labId }}: {
          name: "{{ $labNama }}",
          penanggungJawab: {
            name: "{{ $pjNama }}",
            photo: "{{ $pjFotoUrl }}"
          }
        }
      },
      weeklySchedules: {
        {{ $labId }}: {
          @foreach($allDays as $day)
            "{{ $day }}": 
            {
              periods: {!! json_encode($weeklySchedules[$day]) !!}
            },
          @endforeach
        }
      },
      getCurrentDayName: function() {
        const days = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
        return days[new Date().getDay()];
      }
    };

    // Tambahkan method getPeriodAt
    const sched = window.ScheduleData.weeklySchedules[{{ $labId }}];
    for (let day in sched) {
      sched[day].getPeriodAt = function(minutes) {
        for (let p of this.periods) {
          const [start, end] = p.time.split(' - ');
          const [sH, sM] = start.split(':').map(Number);
          const [eH, eM] = end.split(':').map(Number);
          if (minutes >= sH * 60 + sM && minutes < eH * 60 + eM) {
            return p;
          }
        }
        return null;
      };
    }
  </script>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>