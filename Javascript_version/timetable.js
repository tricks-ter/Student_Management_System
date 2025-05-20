const timetable = document.getElementById("gridView");
const listView = document.getElementById("listView");

const days = ["Time", "Mon", "Tue", "Wed", "Thu", "Fri"];
const slots = [
  { time: "9:00–10:00", Mon: ["Math", "A101"], Tue: ["Physics", "B201"], Wed: ["Math", "A101"], Thu: ["Chemistry", "C102"], Fri: ["English", "D301"] },
  { time: "10:00–11:00", Mon: ["English", "D301"], Tue: ["Biology", "C110"], Wed: ["Chemistry", "C102"], Thu: ["Math", "A101"], Fri: ["Physics", "B201"] },
  { time: "11:00–12:00", Mon: ["Physics", "B201"], Tue: ["English", "D301"], Wed: ["Free", ""], Thu: ["Free", ""], Fri: ["Chemistry", "C102"] },
  { time: "1:00–2:00", Mon: ["Biology", "C110"], Tue: ["Math", "A101"], Wed: ["English", "D301"], Thu: ["Physics", "B201"], Fri: ["Free", ""] },
  { time: "2:00–3:00", Mon: ["Free", ""], Tue: ["Chemistry", "C102"], Wed: ["Biology", "C110"], Thu: ["English", "D301"], Fri: ["Math", "A101"] }
];


days.forEach(day => {
  const div = document.createElement("div");
  div.className = "header";
  div.textContent = day;
  timetable.appendChild(div);
});

slots.forEach(slot => {
  days.forEach(day => {
    const div = document.createElement("div");
    if (day === "Time") {
      div.className = "header";
      div.textContent = slot.time;
    } else {
      const [subject, room] = slot[day];
      const subClass = subject.toLowerCase();
      div.className = `subject ${subClass}`;
      div.innerHTML = subject !== "Free"
        ? `${subject}<br><small>Room: ${room}</small>`
        : "Free";
    }
    timetable.appendChild(div);
  });
});

slots.forEach(slot => {
  const wrapper = document.createElement("div");
  wrapper.className = "list-slot";

  const time = document.createElement("strong");
  time.textContent = slot.time;
  wrapper.appendChild(time);

  const ul = document.createElement("ul");
  days.slice(1).forEach(day => {
    const [subject, room] = slot[day];
    const li = document.createElement("li");
    li.textContent = `${day}: ${subject}` + (room ? ` (Room: ${room})` : "");
    ul.appendChild(li);
  });

  wrapper.appendChild(ul);
  listView.appendChild(wrapper);
});


function toggleView() {
  timetable.style.display = timetable.style.display === "none" ? "grid" : "none";
  listView.style.display = listView.style.display === "none" ? "block" : "none";
}


setInterval(() => {
  const now = new Date();
  const min = 9 - (now.getMinutes() % 10);
  const sec = 59 - now.getSeconds();
  const timer = document.getElementById("nextClass");
  timer.textContent = `Next class in ${String(min).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
}, 1000);
