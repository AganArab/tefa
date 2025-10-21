<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jadwal Pelajaran - {{ $hari }}</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  <script>
    window.CURRENT_LAB = {{ $ruangan->id }};
  </script>
</head>
<body class="schedule-page">

  <div class="schedule-logo">
    <img src="{{ asset('assets/pplg.png') }}" alt="logo" onerror="this.style.display='none'" />
  </div>
  <h1 class="schedule-header" id="lab-title">{{ $ruangan->nama }}</h1>

  <div class="schedule-container">
    <h2 class="day-title">{{ $hari }}</h2>
    <div class="schedule-grid" id="schedule-grid"></div>
  </div>

  <button class="btn-back" onclick="history.back()">❮ Kembali</button>

  <script>
    class SubjectBox {
      constructor(period) {
        this.period = period;
      }
      createElement() {
        const box = document.createElement('div');
        box.className = 'subject-box';
        box.innerHTML = `
          <div class="subject-name">${this.period.name}</div>
          <div class="subject-time">${this.period.time}</div>
        `;
        return box;
      }
    }

    const schedules = {
      {{ $ruangan->id }}: {
        periods: [
          @foreach($jadwals as $j)
          {
            name: "{{ $j->status === 'Istirahat' ? 'Istirahat' : ($j->mapel?->nama ?? 'Mapel Tidak Ada') }}",
            time: "{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}"
          },
          @endforeach
        ]
      }
    };

    document.addEventListener('DOMContentLoaded', () => {
      const labKey = window.CURRENT_LAB;
      const labConfig = window.ScheduleData?.labConfig?.[labKey] || { name: "{{ $ruangan->nama }}" };
      const todaySchedule = schedules[labKey];

      document.getElementById("lab-title").textContent = labConfig.name;

      if (todaySchedule) {
        todaySchedule.periods.forEach(period => {
          document.getElementById("schedule-grid").appendChild(new SubjectBox(period).createElement());
        });
      }
    });
  </script>
</body>
</html>