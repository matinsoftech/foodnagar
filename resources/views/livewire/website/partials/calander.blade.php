@extends('livewire.website.layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        .heading {
            font-weight: 600;
            font-size: 24px;
            line-height: 45px;
            text-align: center;
        }
        .session-text {
            font-weight: 300;
            font-size: 18px;
            line-height: 21.09px;
            text-align: center;
        }
        #calendar {
            max-width: 600px;
            margin: auto;
            background: #f5f5f5;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .fc-day-past {
            background-color: #e0e0e0 !important;
            pointer-events: none;
            opacity: 0.5;
        }

        .fc-day-selected,
        .fc-day-today {
            background-color: #ffffff !important;
            color: #000 !important;
            font-weight: bold;
            border-radius: 5px;
        }

        .time-range-container {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }

        .slider-container {
            position: relative;
            width: 100%;
            height: 40px;
        }

        .range-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 5px;
            background: #ddd;
            border-radius: 5px;
            position: absolute;
            pointer-events: none;
            left: 0;
        }

        .slider-track {
            position: absolute;
            height: 5px;
            background: #486B66;
            border-radius: 5px;
            z-index: 1;
        }

        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: #486B66;
            border-radius: 50%;
            cursor: pointer;
            pointer-events: auto;
            position: relative;
            top: -100%;
            z-index: 99;
        }

        .time-slots {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .time-slot {
            padding: 10px 20px;
            border: unset;
            cursor: pointer;
            border-radius: 5px;
            background: #486B66;
            color: #fff;
            transition: 0.3s;
            font-weight: 500;
            font-size: 14px;
            line-height: 14.57px;
            text-align: center;
        }

        .time-slot:hover {
            background-color: #FDD6B9;
        }

        .selected {
            background: #FDD6B9;
            color: #486B66;
        }
    </style>
@endsection

@section('content')
    <main class="container">
        <h1 class="heading mt-5">Calendar</h1>
        <h5 class="session-text mb-5">Sessions are usually 30-45 mins.</h5>
        <div id="calendar"></div>

        <div class="time-range-container">
            <p>Select Time Range:</p>
            <div class="slider-container">
                <div class="slider-track"></div>
                <input type="range" id="start-time" class="range-slider" min="0" max="24" value="12"
                    step="1" oninput="updateTimeDisplay()">
                <input type="range" id="end-time" class="range-slider" min="0" max="24" value="24"
                    step="1" oninput="updateTimeDisplay()">
            </div>
            <p><span id="start-time-display">12 PM</span> - <span id="end-time-display">12 PM</span></p>
        </div>

        <div class="my-5 pb-5">
            <h2 class="heading mb-2">Available Time Slots</h2>
            <div class="time-slots">
                <button class="time-slot">9:00 AM - 10:00 AM</button>
                <button class="time-slot">10:00 AM - 11:00 AM</button>
                <button class="time-slot">11:00 AM - 12:00 PM</button>
                <button class="time-slot">1:00 PM - 2:00 PM</button>
                <button class="time-slot">2:00 PM - 3:00 PM</button>
                <button class="time-slot">3:00 PM - 4:00 PM</button>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.warn("Waiting for <div id='calendar'> to appear...");
                return;
            }

            let today = new Date().toISOString().split("T")[0]; // Get today's date

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                selectMirror: true,
                defaultDate: today, // Automatically select today's date
                select: function(info) {
                    if (info.startStr < today) return;
                },
                dateClick: function(info) {
                    if (info.dateStr < today) return;

                    // Remove previous selection
                    document.querySelectorAll('.fc-day-selected').forEach(day => {
                        day.classList.remove('fc-day-selected');
                    });

                    // Apply selection styling
                    info.dayEl.classList.add('fc-day-selected');
                },
                dayCellDidMount: function(cell) {
                    let cellDate = cell.date.toISOString().split("T")[0];
                    if (cellDate < today) {
                        cell.el.style.pointerEvents = "none";
                        cell.el.style.opacity = "0.5";
                    }
                    if (cellDate === today) {
                        cell.el.classList.add('fc-day-selected'); // Auto select today's date
                    }
                }
            });

            calendar.render();
        });

        // Time Range Selector Logic
        function updateTimeDisplay() {
            let startTime = parseInt(document.getElementById("start-time").value);
            let endTime = parseInt(document.getElementById("end-time").value);

            // Ensure end time is after start time
            if (endTime <= startTime) {
                endTime = startTime + 1;
                document.getElementById("end-time").value = endTime;
            }

            document.getElementById("start-time-display").innerText = formatTime(startTime);
            document.getElementById("end-time-display").innerText = formatTime(endTime);

            updateSliderTrack(startTime, endTime);
        }

        // Convert 24-hour format to 12-hour AM/PM
        function formatTime(hour) {
            if (hour === 0) return "12 AM";
            if (hour < 12) return hour + " AM";
            if (hour === 12) return "12 PM";
            return (hour - 12) + " PM";
        }

        // Highlight the selected range on the slider
        function updateSliderTrack(start, end) {
            let sliderTrack = document.querySelector(".slider-track");
            let startPercent = (start / 24) * 100;
            let endPercent = (end / 24) * 100;
            sliderTrack.style.left = startPercent + "%";
            sliderTrack.style.width = (endPercent - startPercent) + "%";
        }

        updateTimeDisplay(); // Initialize time display

        $(document).ready(function() {
            $(".time-slot").click(function() {
                $(".time-slot").removeClass("selected"); // Remove selection from all
                $(this).addClass("selected"); // Add selection to clicked button
            });
        });
    </script>
@endsection
