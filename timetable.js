/**
 * Sample schedule data for the weekly calendar.
 * Each event includes the day (matching one of the weekdays), startHour, endHour,
 * title, room, and a color for visual styling.
 */
const scheduleData = [
    { day: "Monday", startHour: 8, endHour: 9, title: "Mathematics", room: "Room 101", color: "#18BC9C" },
    { day: "Tuesday", startHour: 8, endHour: 9, title: "Physics", room: "Room 102", color: "#3498DB" },
    { day: "Monday", startHour: 9, endHour: 10, title: "English", room: "Room 201", color: "#E67E22" },
    { day: "Thursday", startHour: 9, endHour: 10, title: "Chemistry", room: "Room 103", color: "#9B59B6" }
  ];
  
  // Define timetable settings
  const weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
  const startHour = 8;   // starting time (e.g., 8 AM)
  const endHour = 17;    // ending time (e.g., 5 PM)
  
  /**
   * Renders the weekly calendar dynamically.
   * It creates a grid with a header row (Time + weekdays) and rows for each hour from startHour to endHour.
   * Then, it inserts schedule events into the appropriate cells.
   */
  function renderWeeklyCalendar() {
    const calendarContainer = document.querySelector("#weekly .calendar-grid");
    if (!calendarContainer) return;
  
    // Clear previous content (if any)
    calendarContainer.innerHTML = "";
  
    // Build the header: first cell is "Time", then each weekday.
    let headerHtml = `<div class="grid-header">Time</div>`;
    weekdays.forEach(day => {
      headerHtml += `<div class="grid-header">${day}</div>`;
    });
    calendarContainer.innerHTML += headerHtml;
  
    // Build rows for each hour slot
    for (let hour = startHour; hour < endHour; hour++) {
      // First cell with time label (formatting as "8:00 AM", etc.)
      const timeLabel = formatHour(hour);
      calendarContainer.innerHTML += `<div class="time-label">${timeLabel}</div>`;
  
      // Add empty cells for each weekday (they will later host any events)
      weekdays.forEach(day => {
        calendarContainer.innerHTML += `<div class="time-slot" data-day="${day}" data-hour="${hour}"></div>`;
      });
    }
  
    // Insert events into the grid.
    scheduleData.forEach(event => {
      // Identify the target cell by matching day and the startHour.
      const cellSelector = `.time-slot[data-day="${event.day}"][data-hour="${event.startHour}"]`;
      const cell = calendarContainer.querySelector(cellSelector);
      if (cell) {
        // Create an event block element with title and room; 
        // additional info can be displayed on hover (via the title attribute).
        const eventBlock = document.createElement("div");
        eventBlock.classList.add("class-block");
        eventBlock.style.backgroundColor = event.color;
        eventBlock.title = `${event.title} - ${event.room} (${formatHour(event.startHour)} - ${formatHour(event.endHour)})`;
        eventBlock.innerText = event.title;
        // Append the event block to the cell
        cell.appendChild(eventBlock);
      }
    });
  }
  
  /**
   * Formats a given hour in 24-hour format as a string in 12-hour AM/PM format.
   * @param {number} hour - Hour in 24-hour format.
   * @returns {string} Formatted time string.
   */
  function formatHour(hour) {
    const period = hour >= 12 ? "PM" : "AM";
    const formattedHour = ((hour + 11) % 12 + 1);
    return `${formattedHour}:00 ${period}`;
  }
  
  /**
   * Initializes tab switching for timetable views.
   * When a tab is clicked, it shows the associated timetable view and updates active styling.
   */
  function initializeTabSwitching() {
    const tabLinks = document.querySelectorAll("#timetable-nav ul li a");
    tabLinks.forEach(link => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        const view = link.getAttribute("data-view");
  
        // Remove 'active' class from all tabs and views.
        tabLinks.forEach(tab => tab.classList.remove("active"));
        const timetableViews = document.querySelectorAll(".timetable-view");
        timetableViews.forEach(viewDiv => viewDiv.classList.remove("active"));
  
        // Set active class for clicked tab and corresponding view.
        link.classList.add("active");
        const activeView = document.getElementById(view);
        if (activeView) activeView.classList.add("active");
      });
    });
  }
  
  /**
   * Updates the next class countdown timer dynamically.
   * It finds the next scheduled event for today based on the current time and displays the remaining time.
   */
  function updateCountdown() {
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinutes = now.getMinutes();
    const currentSeconds = now.getSeconds();
  
    // For simplicity, find the next event today. In a production system, you would handle edge cases and multiple events.
    let nextEvent = null;
    for (let event of scheduleData) {
      // Check if event is today (matching one of the weekdays) and the startHour is later than the current hour.
      // This demo assumes the schedule applies to the current day if it matches a weekday.
      const todayWeekday = weekdays[now.getDay() - 1]; // now.getDay() returns 0 for Sunday so assume Monday is index 0.
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
  
    // Calculate remaining time until the next event starts.
    const eventTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), nextEvent.startHour, 0, 0);
    const diffMs = eventTime - now;
    if (diffMs <= 0) {
      countdownElement.textContent = "Class is starting...";
      return;
    }
  
    // Convert remaining time from milliseconds to hours, minutes, seconds.
    const diffSec = Math.floor(diffMs / 1000);
    const hours = Math.floor(diffSec / 3600);
    const minutes = Math.floor((diffSec % 3600) / 60);
    const seconds = diffSec % 60;
  
    // Update countdown display with formatted time.
    countdownElement.textContent = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
  }
  
  /**
   * Pads a single-digit number with a leading zero.
   * @param {number} num - The number to pad.
   * @returns {string} Padded string.
   */
  function padZero(num) {
    return num < 10 ? "0" + num : num.toString();
  }
  
  /**
   * Initializes the Room Finder functionality.
   * For demonstration, this function filters a static room list by a simple substring match.
   */
  function initializeRoomFinder() {
    const roomSearchForm = document.getElementById("roomSearchForm");
    roomSearchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const input = document.getElementById("roomSearchInput").value.trim().toLowerCase();
      const roomResults = document.getElementById("roomResults");
      
      // Sample room data for demonstration.
      const rooms = [
        { room: "Room 101", status: "Available" },
        { room: "Room 102", status: "Occupied" },
        { room: "Room 201", status: "Available" },
        { room: "Room 103", status: "Maintenance" }
      ];
      
      // Filter rooms that match the search query.
      const filteredRooms = rooms.filter(r => r.room.toLowerCase().includes(input));
      
      // Build the results output.
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
  
  /**
   * Starts the repeating update for the next class countdown.
   */
  function startCountdown() {
    updateCountdown(); // Initial update
    setInterval(updateCountdown, 1000); // Update every second
  }
  
  /**
   * Initializes the entire timetable view page by setting up tab switching, the weekly calendar,
   * room finder, and the countdown timer.
   */
  function initializeTimetableView() {
    initializeTabSwitching();
    renderWeeklyCalendar();
    initializeRoomFinder();
    startCountdown();
  }
  
  // Initialize once the DOM content is fully loaded.
  document.addEventListener("DOMContentLoaded", initializeTimetableView);
  