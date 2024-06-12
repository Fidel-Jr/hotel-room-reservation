<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js"></script>

</head>
<body>

    <div id='calendar'></div>
    

    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: eventsData
        })
        calendar.render()
        })
        var eventsData = data.map(event => ({
            id: 1,
            title: "Reserved",
            start: "2024-05-30 12:00:00", // Start date and time
            end: "2024-05-31 14:00:00"// End date and time (optional)
        }));
    </script>

</body>
</html>