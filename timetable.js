const scheduleData = [
  { day: "Monday", startHour: 8, endHour: 9, title: "Mathematics", room: "Room 101", color: "#18BC9C" },
  { day: "Tuesday", startHour: 8, endHour: 9, title: "Physics", room: "Room 102", color: "#3498DB" },
  { day: "Monday", startHour: 9, endHour: 10, title: "English", room: "Room 201", color: "#E67E22" },
  { day: "Thursday", startHour: 9, endHour: 10, title: "Chemistry", room: "Room 103", color: "#9B59B6" }
];

const weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
const startHour = 8;
const endHour = 17;

function renderWeeklyCalendar() {
  const calendarContainer = document.querySelector("#weekly .calendar-grid");
  if (!calendarContainer) return;
  calendarContainer.innerHTML = "";
  let headerHtml = `<div class="grid-header">Time</div>`;
  weekdays.forEach(day => {
    headerHtml += `<div class="grid-header">${day}</div>`;
  });
  calendarContainer.innerHTML += headerHtml;
  for (let hour = startHour; hour < endHour; hour++) {
    const timeLabel = formatHour(hour);
    calendarContainer.innerHTML += `<div class="time-label">${timeLabel}</div>`;
    weekdays.forEach(day => {
      calendarContainer.innerHTML += `<div class="time-slot" data-day="${day}" data-hour="${hour}"></div>`;
    });
  }
  scheduleData.forEach(event => {
    const cellSelector = `.time-slot[data-day="${event.day}"][data-hour="${event.startHour}"]`;
    const cell = calendarContainer.querySelector(cellSelector);
    if (cell) {
      const eventBlock = document.createElement("div");
      eventBlock.classList.add("class-block");
      eventBlock.style.backgroundColor = event.color;
      eventBlock.title = `${event.title} - ${event.room} (${formatHour(event.startHour)} - ${formatHour(event.endHour)})`;
      eventBlock.innerText = event.title;
      cell.appendChild(eventBlock);
    }
  });
}

function formatHour(hour) {
  const period = hour >= 12 ? "PM" : "AM";
  const formattedHour = ((hour + 11) % 12 + 1);
  return `${formattedHour}:00 ${period}`;
}

function initializeTabSwitching() {
  const tabLinks = document.querySelectorAll("#timetable-nav ul li a");
  tabLinks.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const view = link.getAttribute("data-view");
      tabLinks.forEach(tab => tab.classList.remove("active"));
      const timetableViews = document.querySelectorAll(".timetable-view");
      timetableViews.forEach(viewDiv => viewDiv.classList.remove("active"));
      link.classList.add("active");
      const activeView = document.getElementById(view);
      if (activeView) activeView.classList.add("active");
    });
  });
}

function updateCountdown() {
  const now = new Date();
  const currentHour = now.getHours();
  const currentMinutes = now.getMinutes();
  const currentSeconds = now.getSeconds();
  let nextEvent = null;
  for (let event of scheduleData) {
    const todayWeekday = weekdays[now.getDay() - 1];
    if (event.day === todayWeekday && event.startHour > currentHour) {
      nextEvent = event;
      break;
    }
  }
  const countdownElement = document.getElementById("countdownTimer");
  if (!nextEvent || !countdownElement) {
    countdownElement.textContent = "No upcoming classes";
    return;
  }
  const eventTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), nextEvent.startHour, 0, 0);
  const diffMs = eventTime - now;
  if (diffMs <= 0) {
    countdownElement.textContent = "Class is starting...";
    return;
  }
  const diffSec = Math.floor(diffMs / 1000);
  const hours = Math.floor(diffSec / 3600);
  const minutes = Math.floor((diffSec % 3600) / 60);
  const seconds = diffSec % 60;
  countdownElement.textContent = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
}

function padZero(num) {
  return num < 10 ? "0" + num : num.toString();
}

function initializeRoomFinder() {
  const roomSearchForm = document.getElementById("roomSearchForm");
  roomSearchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const input = document.getElementById("roomSearchInput").value.trim().toLowerCase();
    const roomResults = document.getElementById("roomResults");
    const rooms = [
      { room: "Room 101", status: "Available" },
      { room: "Room 102", status: "Occupied" },
      { room: "Room 201", status: "Available" },
      { room: "Room 103", status: "Maintenance" }
    ];
    const filteredRooms = rooms.filter(r => r.room.toLowerCase().includes(input));
    let resultsHtml = "";
    if (filteredRooms.length > 0) {
      filteredRooms.forEach(r => {
        resultsHtml += `<p>${r.room} - ${r.status}</p>`;
      });
    } else {
      resultsHtml = "<p>No matching rooms found.</p>";
    }
    roomResults.innerHTML = resultsHtml;
  });
}

function startCountdown() {
  updateCountdown();
  setInterval(updateCountdown, 1000);
}

function initializeTimetableView() {
  initializeTabSwitching();
  renderWeeklyCalendar();
  initializeRoomFinder();
  startCountdown();
}

document.addEventListener("DOMContentLoaded", initializeTimetableView);
