// ============= 1. Jam & Tanggal =============
function updateClock() {
  const now = new Date();
  const options = { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' };
  const hours = now.getHours().toString().padStart(2, "0");
  const minutes = now.getMinutes().toString().padStart(2, "0");
  document.getElementById("clock").textContent = `${hours}:${minutes} WIB`;
  const dateStr = now.toLocaleDateString("id-ID", options);
  document.getElementById("date").textContent = dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
}
updateClock();
setInterval(updateClock, 1000);

// ============= 2. Update Aktivitas Saat Ini =============
function updateCurrentActivity() {
  const labKey = window.CURRENT_LAB;
  const labData = window.ScheduleData.labConfig[labKey];
  const schedules = window.ScheduleData.weeklySchedules[labKey];

  if (!labData || !schedules) {
    console.error("Ruangan tidak ditemukan:", labKey);
    return;
  }

  const pj = labData.penanggungJawab;
  const fallbackTeacher = pj.name;
  const fallbackPhoto = pj.photo;

  document.getElementById("lab-title").textContent = labData.name;

  const now = new Date();
  const currentMinutes = now.getHours() * 60 + now.getMinutes();
  const todayName = window.ScheduleData.getCurrentDayName();

  const activityEl = document.getElementById("current-activity");
  const durationEl = document.getElementById("current-duration");
  const teacherNameEl = document.getElementById("teacher-name");
  const teacherPhotoEl = document.getElementById("teacher-photo");

  // Set default ke penanggung jawab (dari database)
  teacherNameEl.textContent = fallbackTeacher;
  teacherPhotoEl.src = fallbackPhoto;
  teacherPhotoEl.alt = fallbackTeacher;

  const todaySchedule = schedules[todayName];
  if (!todaySchedule) {
    activityEl.textContent = "Akhir Pekan";
    durationEl.textContent = "–";
    return;
  }

  const currentPeriod = todaySchedule.getPeriodAt(currentMinutes);
  if (currentPeriod) {
    activityEl.textContent = currentPeriod.name;
    durationEl.textContent = currentPeriod.time;

    const isBreak = /istirahat|upacara|sholat jumat|ekstrakurikuler|libur/i.test(currentPeriod.name.toLowerCase());

    if (currentPeriod.teacher && currentPeriod.photo && !isBreak) {
      teacherNameEl.textContent = currentPeriod.teacher;
      teacherPhotoEl.src = currentPeriod.photo;
      teacherPhotoEl.alt = currentPeriod.teacher;

      // Fallback jika foto gagal dimuat
      teacherPhotoEl.onerror = function() {
        this.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(fallbackTeacher)}&background=0D8ABC&color=fff`;
        teacherNameEl.textContent = fallbackTeacher;
        this.alt = fallbackTeacher;
      };
    }
  } else {
    activityEl.textContent = "Tidak ada jadwal";
    durationEl.textContent = "06:30 - 15:00";
  }
}

updateCurrentActivity();
setInterval(updateCurrentActivity, 60000);

// ============= 3. Navigasi & Animasi =============
const nextBtn = document.getElementById("nextBtn");
const scheduleSection = document.querySelector(".schedule");
if (nextBtn && scheduleSection) {
  nextBtn.addEventListener("click", () => {
    scheduleSection.scrollIntoView({ behavior: "smooth" });
  });
}

const fadeItems = document.querySelectorAll(".fade-item");
if (fadeItems.length > 0) {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  fadeItems.forEach(item => observer.observe(item));
}

// ✅ Navigasi ke route Laravel (tanpa file statis)
const dayButtons = document.querySelectorAll(".day-btn");
const hariMap = {
  "Senin": "/hari/Senin",
  "Selasa": "/hari/Selasa",
  "Rabu": "/hari/Rabu",
  "Kamis": "/hari/Kamis",
  "Jum'at": "/hari/Jumat"
};
dayButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    const hari = btn.textContent.trim();
    const targetPage = hariMap[hari];
    if (targetPage) window.location.href = targetPage;
  });
});